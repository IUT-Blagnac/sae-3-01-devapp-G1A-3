import paho.mqtt.client as mqtt
import configparser
import json
import os

from datetime import datetime
from genericpath import exists

config = configparser.ConfigParser()
config.read("config.ini")

BROKER_ADDRESS = config["MQTT"]["broker_address"]
PORT = int(config["MQTT"]["port"])
TOPICS = config["MQTT"]["topics"].split(", ")
AM107_ROOMS = config["MQTT"]["AM107_rooms"].split(", ")
AM107_INFO_TYPES = config["MQTT"]["AM107_info_types"].split(", ")
SOLAREDGE_INFO_TYPES = config["MQTT"]["solaredge_info_types"].split(", ")
SEUIL_ALERT = int(config["MQTT"]["seuil_alert"])
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

    try:
        data = json.loads(payload)
    except json.JSONDecodeError:
        data = payload

    parties = topic.split("/")
    flux_mqtt = parties[0]

    if flux_mqtt=="solaredge":
        if SOLAREDGE_INFO_TYPES[0] == "all" :
            message = f"{data}"
        else:
            message = "{"
            for info in SOLAREDGE_INFO_TYPES:
                message = message + f"{data[info]}"
            message = message + "}"
        print(message)
        enregistrer_donnees(message,topic)

    if flux_mqtt=="AM107":
        salle = parties[2] if len(parties) > 2 else "inconnue"
        if salle in AM107_ROOMS or AM107_ROOMS == "all":
            if AM107_INFO_TYPES[0] == "all":
                message = f"{data}"
            else:
                message = "{"
                for info in AM107_INFO_TYPES:
                    message = message + f"{data[0][info]}"
                message = message + "}"
            print(message)
            enregistrer_donnees(message,topic)

def enregistrer_donnees(data,topic):
    date=datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
    parties = topic.split("/")
    flux_mqtt = parties[0]
    if not exists(flux_mqtt):
            os.mkdir(flux_mqtt)
    if flux_mqtt == "solaredge":
        with open(flux_mqtt+"/"+date, "a") as f:
            f.write(data + "\n")
    else:
        salle=parties[2]
        if not exists(flux_mqtt+"/"+salle):
            os.mkdir(flux_mqtt+"/"+salle)
        with open(flux_mqtt+"/"+salle+"/"+date, "a") as f:
            f.write(data + "\n")

client = mqtt.Client()

client.on_connect = on_connect
client.on_message = on_message

client.connect(BROKER_ADDRESS, PORT, keepalive=60)

try:
    client.loop_forever()
except KeyboardInterrupt:
    print("\nDéconnexion...")
    client.disconnect()
