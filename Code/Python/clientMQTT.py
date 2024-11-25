import paho.mqtt.client as mqtt
import configparser
import json
import os

from datetime import datetime
from genericpath import exists
from pathlib import Path

config = configparser.ConfigParser()
config.read("config.ini")

BROKER_ADDRESS = config["MQTT"]["broker_address"]
PORT = int(config["MQTT"]["port"])
TOPICS = config["MQTT"]["topics"].split(", ")
AM107_ROOMS = config["MQTT"]["AM107_rooms"].split(", ")
AM107_INFO_TYPES = config["MQTT"]["AM107_info_types"].split(", ")
SOLAREDGE_INFO_TYPES = config["MQTT"]["solaredge_info_types"].split(", ")
BASE_PATH = config["MQTT"]["base_path"]
SEUIL_ALERT = config["MQTT"]["seuil_alert"].split(", ")
PERIOD = int(config["MQTT"]["period"])

def on_connect(client, userdata, flags, rc):
    if rc == 0:
        print("Connecté au broker MQTT avec succès\n")
        for topic in TOPICS:
            client.subscribe(f"{topic}/#")
            print(f"Abonné au topic : {topic}")
        print("")
    else:
        print(f"Échec de connexion, code de retour : {rc}")

def on_message(client, userdata, msg):
    topic = msg.topic
    payload = msg.payload.decode("utf-8")
    parties = topic.split("/")
    flux_mqtt = parties[0]

    try:
        data = json.loads(payload)
    except json.JSONDecodeError:
        data = payload

    if flux_mqtt == "solaredge":
        if exists(BASE_PATH+flux_mqtt):
            repertoire = Path(BASE_PATH+"solaredge/")
            liste_fichiers = [f for f in repertoire.iterdir() if f.is_file()]
            liste_fichiers_tries = sorted(liste_fichiers, key=lambda f: f.stat().st_mtime)
            dernier_fichier = liste_fichiers_tries[-1] if liste_fichiers_tries else None
            nom_dernier_fichier = dernier_fichier.name
            if gestion_periode(nom_dernier_fichier) == False:
                return        
        if SOLAREDGE_INFO_TYPES[0] == "all" :
            message = f"{data}"
        else:
            message = "{"
            nb_info = len(SOLAREDGE_INFO_TYPES)
            i=0
            for info in SOLAREDGE_INFO_TYPES:
                donnees = data[info]
                message = message + f"'{info}': {donnees}"
                i=i+1
                if(i<=nb_info-1):
                    message = message + ", "
            message = message + "}"
        print(message)
        enregistrer_donnees(message,topic)

    if flux_mqtt == "AM107":
        salle = parties[2] if len(parties) > 2 else "inconnue"
        if salle in AM107_ROOMS or AM107_ROOMS[0] == "all":
            if exists(BASE_PATH+flux_mqtt+"/"+salle):
                chemin=BASE_PATH+flux_mqtt+"/"+salle+"/"
                repertoire = Path(chemin)
                liste_fichiers = [f for f in repertoire.iterdir() if f.is_file()]
                liste_fichiers_tries = sorted(liste_fichiers, key=lambda f: f.stat().st_mtime)
                dernier_fichier = liste_fichiers_tries[-1] if liste_fichiers_tries else None
                nom_dernier_fichier = dernier_fichier.name
                if gestion_periode(nom_dernier_fichier) == False:
                    return            
            if AM107_INFO_TYPES[0] == "all":
                message = f"{data}"
            else:
                message = "{"
                nb_info = len(AM107_INFO_TYPES)
                i=0
                for info in AM107_INFO_TYPES:
                    donnees = data[0][info]
                    seuil_alert = SEUIL_ALERT[i]
                    if(donnees>=int(seuil_alert)):
                        print("ALERTE (Seuil "+info+" dépassé : "+seuil_alert+") en "+salle+" : "+f"{donnees}")
                    message = message + f"'{info}': {donnees}"
                    i=i+1
                    if(i<=nb_info-1):
                        message = message + ", "
                message = message + "}"
            print(message)
            enregistrer_donnees(message,topic)

def enregistrer_donnees(data,topic):
    date=datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
    parties = topic.split("/")
    flux_mqtt = parties[0]
    if not exists(BASE_PATH+flux_mqtt):
            os.makedirs(BASE_PATH+flux_mqtt)
    if flux_mqtt == "solaredge":
        with open(BASE_PATH+flux_mqtt+"/"+date, "a") as f:
            f.write(data + "\n")
    else:
        salle=parties[2]
        if not exists(BASE_PATH+flux_mqtt+"/"+salle):
            os.mkdir(BASE_PATH+flux_mqtt+"/"+salle)
        with open(BASE_PATH+flux_mqtt+"/"+salle+"/"+date, "a") as f:
            f.write(data + "\n")

def gestion_periode(date_sans_seuil):
    tab_str=date_sans_seuil.split('_')[0].split('-')+date_sans_seuil.split('_')[1].split('-')
    tab_int=[]
    for i in range(len(tab_str)):
        val=int(tab_str[i])
        tab_int.append(val)
    tab_int[4]=tab_int[4]+PERIOD
    while tab_int[4]>60:
        tab_int[4]=tab_int[4]-60
        tab_int[3]=tab_int[3]+1
    while tab_int[3]>24:
        tab_int[3]=tab_int[3]-24
        tab_int[2]=tab_int[2]+1
    mois_pas_ok=True
    while mois_pas_ok==True:
        mois_pas_ok=False
        if tab_int[1]==2:
            if tab_int[2]>29:
                mois_pas_ok=True
                tab_int[2]=tab_int[2]-29
                tab_int[1]=tab_int[1]+1
        elif tab_int[1] in [1, 3, 5, 7, 8, 10, 12]:
            if tab_int[2]>31:
                mois_pas_ok=True
                tab_int[2]=tab_int[2]-31
                tab_int[1]=tab_int[1]+1
        elif tab_int[1] in [4, 6, 9, 11]:
            if tab_int[2]>30:
                mois_pas_ok=True
                tab_int[2]=tab_int[2]-30
                tab_int[1]=tab_int[1]+1
        while tab_int[1]>12:
            tab_int[1]=tab_int[1]-12
            tab_int[0]=tab_int[0]+1

    date_avec_seuil=""
    for i in range(len(tab_int)):
        elt=tab_int[i]
        if i in [1,2,4,5]:
            date_avec_seuil=date_avec_seuil+'-'
        elif i==3:
            date_avec_seuil=date_avec_seuil+'_'
        if elt in [1, 2, 3, 4, 5, 6, 7, 8, 9]:
            nb='0'+str(elt)
        else:
            nb=str(elt)
        date_avec_seuil=date_avec_seuil+nb

    date_actuelle=datetime.now().strftime("%Y-%m-%d_%H-%M-%S")

    if date_avec_seuil<date_actuelle:
        return True
    else:
        return False

client = mqtt.Client()

client.on_connect = on_connect
client.on_message = on_message

client.connect(BROKER_ADDRESS, PORT, keepalive=60)

try:
    client.loop_forever()
except KeyboardInterrupt:
    print("\nDéconnexion...")
    client.disconnect()
