# Importation de toutes les librairies nécessaires
import paho.mqtt.client as mqtt
import configparser
import json
import os

from datetime import datetime
from genericpath import exists
from pathlib import Path

# Récupération des données contenues dans le fichier config.ini
config = configparser.ConfigParser()
config.read("Code/Python/config.ini")

BROKER_ADDRESS = config["MQTT"]["broker_address"]
PORT = int(config["MQTT"]["port"])
TOPICS = config["MQTT"]["topics"].split(", ")
AM107_ROOMS = config["MQTT"]["AM107_rooms"].split(", ")
AM107_INFO_TYPES = config["MQTT"]["AM107_info_types"].split(", ")
SOLAREDGE_INFO_TYPES = config["MQTT"]["solaredge_info_types"].split(", ")
BASE_PATH = config["MQTT"]["base_path"]
SEUIL_ALERT = config["MQTT"]["seuil_alert"].split(", ")
PERIOD = int(config["MQTT"]["period"])

# Procédure qui s'exécute lors de la connexion au client MQTT
def on_connect(client, userdata, flags, rc):
    # On vérifie que la connexion fonctionne
    if rc == 0:
        print("Connecté au broker MQTT avec succès\n")
        # On s'abonne aux différents topics indiqués dans le fichier config.ini
        for topic in TOPICS:
            client.subscribe(f"{topic}/#")
            print(f"Abonné au topic : {topic}")
        print("")
    else:
        print(f"Échec de connexion, code de retour : {rc}")

# Procédure qui s'exécute à chaque réception de message du client MQTT
def on_message(client, userdata, msg):
    # Récupération des données conernant le topic
    topic = msg.topic
    payload = msg.payload.decode("utf-8")
    parties = topic.split("/")
    flux_mqtt = parties[0]

    # Récupération des données envoyées par les capteurs via le client MQTT
    try:
        data = json.loads(payload)
    except json.JSONDecodeError:
        data = payload

    # Traitement des 2 cas : solaredge et AM107
    # Cas 1 : solaredge
    if flux_mqtt == "solaredge":
        # Vérification de l'existence du répertoire de stockage
        if exists(BASE_PATH+flux_mqtt):
            # Récupération du dernier fichier du répertoire
            repertoire = Path(BASE_PATH+"solaredge/")
            liste_fichiers = [f for f in repertoire.iterdir() if f.is_file()]
            liste_fichiers_tries = sorted(liste_fichiers, key=lambda f: f.stat().st_mtime)
            dernier_fichier = liste_fichiers_tries[-1] if liste_fichiers_tries else None
            nom_dernier_fichier = dernier_fichier.name
            # Vérification du respect de la période
            if gestion_periode(nom_dernier_fichier) == False:
                # Fin de la procédure si le dernier fichier enregistré est trop récent par rapport à la période
                return
        # Sélection des informations à récupérer en provenance des panneaux solaires
        if SOLAREDGE_INFO_TYPES[0] == "all" :
            # Cas où on récupère toutes les données
            message = f"{data}"
        else:
            # Cas où on récupère certaines données sélectionnées
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
        # Affichage dans un terminal
        print(message)
        # Enregistrement des données dans des fichiers
        enregistrer_donnees(message,topic)

    # Cas 2 : AM107
    if flux_mqtt == "AM107":
        # Vérification des contraintes concernants les salles sélectionnées
        salle = parties[2] if len(parties) > 2 else "inconnue"
        if salle in AM107_ROOMS or AM107_ROOMS[0] == "all":
            # Vérification de l'existence du répertoire de stockage
            if exists(BASE_PATH+flux_mqtt+"/"+salle):
                # Récupération du dernier fichier du répertoire
                chemin=BASE_PATH+flux_mqtt+"/"+salle+"/"
                repertoire = Path(chemin)
                liste_fichiers = [f for f in repertoire.iterdir() if f.is_file()]
                liste_fichiers_tries = sorted(liste_fichiers, key=lambda f: f.stat().st_mtime)
                dernier_fichier = liste_fichiers_tries[-1] if liste_fichiers_tries else None
                nom_dernier_fichier = dernier_fichier.name
                # Vérification du respect de la période
                if gestion_periode(nom_dernier_fichier) == False:
                    # Fin de la procédure si le dernier fichier enregistré est trop récent par rapport à la période
                    return
            # Sélection des informations à récupérer en provenance des salles
            if AM107_INFO_TYPES[0] == "all":
                # Cas où on récupère toutes les données
                message = f"{data}"
            else:
                # Cas où on récupère certaines données sélectionnées
                message = "{"
                nb_info = len(AM107_INFO_TYPES)
                i=0
                for info in AM107_INFO_TYPES:
                    donnees = data[0][info]
                    seuil_alert = SEUIL_ALERT[i]
                    if(donnees>=int(seuil_alert)):
                        message_alerte = "{"+f"'salle': {salle}, 'seuil_{info}': {seuil_alert}, '{info}': {donnees}"+"}"
                        print("ALERTE (Seuil "+info+" dépassé : "+seuil_alert+") en "+salle+" : "+f"{donnees}")
                        enregistrer_alerte(message_alerte,topic)
                    message = message + f"'{info}': {donnees}"
                    i=i+1
                    if(i<=nb_info-1):
                        message = message + ", "
                message = message + "}"
            # Affichage dans un terminal
            print(message)
            # Enregistrement des données dans des fichiers
            enregistrer_donnees(message,topic)

# Procédure d'enregistrement des données
def enregistrer_donnees(data,topic):
    # Récupération de la date (on utilise la date pour nommer les fichiers)
    date=datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
    parties = topic.split("/")
    flux_mqtt = parties[0]
    # Vérification de l'existence de l'arborescence des fichiers de stockage
    if not exists(BASE_PATH+flux_mqtt):
        # Création de tous les fichiers de l'arborescence des fichiers de stockage (si elle n'existe pas déjà)
        os.makedirs(BASE_PATH+flux_mqtt)
    # Traitement des 2 cas : solaredge et AM107
    # Cas 1 : solaredge 
    if flux_mqtt == "solaredge":
        # Création du fichier et écriture des données
        with open(BASE_PATH+flux_mqtt+"/"+date, "a") as f:
            f.write(data + "\n")
    # Cas 2 : AM107
    else:
        salle=parties[2]
        # Vérification de l'existence du répertoire correspondant à la salle dont les données doivent être stockées
        if not exists(BASE_PATH+flux_mqtt+"/"+salle):
            # Création du répertoire s'il n'existe pas déjà
            os.mkdir(BASE_PATH+flux_mqtt+"/"+salle)
        # Création du fichier et écriture des données
        with open(BASE_PATH+flux_mqtt+"/"+salle+"/"+date, "a") as f:
            f.write(data + "\n")

# Enregistrement des alertes
def enregistrer_alerte(data,topic):
    # Récupération de la date (on utilise la date pour nommer les fichiers)
    date=datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
    parties = topic.split("/")
    # Création de l'arborescence pour stocker les alertes
    if not exists(BASE_PATH+"alerte"):
        os.makedirs(BASE_PATH+"alerte")
    salle=parties[2]
    # Création du répertoire de la salle d'on provient l'alerte s'il n'existe pas déjà
    if not exists(BASE_PATH+"alerte/"+salle):
        os.mkdir(BASE_PATH+"alerte/"+salle)
    # Enregistrement de l'alerte
    with open(BASE_PATH+"alerte/"+salle+"/"+date, "a") as f:
        f.write(data + "\n") 

# Procédure de gestion des périodes
def gestion_periode(date_sans_seuil):
    # Séparation de la date en 2 parties
    tab_str=date_sans_seuil.split('_')[0].split('-')+date_sans_seuil.split('_')[1].split('-')
    tab_int=[]
    # Calcul de la date d'enregistrement du fichier + le seuil 
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

    # Retranscription de la date au bon format pour effectuer une comparaison
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

    # Récupération de la date actuelle
    date_actuelle=datetime.now().strftime("%Y-%m-%d_%H-%M-%S")

    # Comparaison entre la date avec le seuil et la date actuelle
    if date_avec_seuil<date_actuelle:
        return True
    else:
        return False

# Initialisation du client MQTT
client = mqtt.Client()

client.on_connect = on_connect
client.on_message = on_message

client.connect(BROKER_ADDRESS, PORT, keepalive=60)

# Boucle qui se répète jusqu'à une interruption (ex : Ctrl+C)
try:
    client.loop_forever()
except KeyboardInterrupt:
    print("\nDéconnexion...")
    client.disconnect()
