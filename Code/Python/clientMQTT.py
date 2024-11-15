import paho.mqtt.client as mqtt
import configparser
import json
import os

from datetime import datetime
from time import strftime
from genericpath import exists

config = configparser.ConfigParser()
config.read("config.ini")

BROKER_ADDRESS = config["MQTT"]["broker_address"]
PORT = int(config["MQTT"]["port"])
TOPICS = config["MQTT"]["topics"].split(", ")

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

    if flux_mqtt == "solaredge":
        message = f"{data}"
    else:
        salle = parties[2] if len(parties) > 2 else "inconnue"
        message = (
            f"Données du capteur {salle} : \n"
            f"- Température : {data[0]['temperature']}°C\n"
            f"- Humidité : {data[0]['humidity']}%\n"
            f"- CO2 : {data[0]['co2']} ppm\n"
        )

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