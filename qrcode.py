#!/usr/bin/python3

import I2C_LCD_driver
import cv2
import pyzbar.pyzbar as qr
import time
import requests
import sys
import RPi.GPIO as GPIO
from player import Player
import json
import requests
from requests.structures import CaseInsensitiveDict

URL = "http://127.0.0.1:8000/api/data"
HEADER = CaseInsensitiveDict()
HEADER["Content-Type"] = "application/json"
PLACE_ID = 33000114

cap = cv2.VideoCapture(0)
font = cv2.FONT_HERSHEY_PLAIN

mylcd = I2C_LCD_driver.lcd()
mylcd.backlight(0)

old_uuid = None
scan_time = None

players= []

player_1 = None
player_2 = None
game = None

def capteur():
    #GPIO Mode (BOARD / BCM)
    GPIO.setmode(GPIO.BCM)

    GPIO_TRIGGER = 23
    GPIO_ECHO = 25
    GPIO_TRIGGER_D = 18
    GPIO_ECHO_D = 24

    GPIO.setup(GPIO_TRIGGER, GPIO.OUT)
    GPIO.setup(GPIO_ECHO, GPIO.IN)
    GPIO.setup(GPIO_TRIGGER_D, GPIO.OUT)
    GPIO.setup(GPIO_ECHO_D, GPIO.IN)

def distance_g():
    GPIO.output(GPIO_TRIGGER, True)
    time.sleep(0.00001)
    GPIO.output(GPIO_TRIGGER, False)
    StartTime = time.time()
    StopTime = time.time()
    while GPIO.input(GPIO_ECHO) == 0:
        StartTime = time.time()
    while GPIO.input(GPIO_ECHO) == 1:
        StopTime = time.time()
    TimeElapsed = StopTime - StartTime
    distance = (TimeElapsed * 34300) / 2

    return distance
def distance_d():
    GPIO.output(GPIO_TRIGGER_D, True)
    time.sleep(0.00001)
    GPIO.output(GPIO_TRIGGER_D, False)
    StartTime = time.time()
    StopTime = time.time()
    while GPIO.input(GPIO_ECHO_D) == 0:
        StartTime = time.time()
    while GPIO.input(GPIO_ECHO_D) == 1:
        StopTime = time.time()
    TimeElapsed = StopTime - StartTime
    distance = (TimeElapsed * 34300) / 2

    return distance

def display( message = ""):
    mylcd.lcd_clear()
    mylcd.lcd_display_string(message, 1)

def buzzer():
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(14, GPIO.OUT)
    GPIO.output(14, 1)
    time.sleep(0.1)
    GPIO.cleanup()

def scan(joueurs = 0, old_uuid = None):
    time.sleep(0.25)
    nmbrjoueurs = joueurs
    ret, frame = cap.read()
    frame1 = cv2.resize(frame, (640, 480))
    qrdetect = qr.decode(frame1)
    if not qrdetect:
        time.sleep(2)
        return scan(nmbrjoueurs, old_uuid)
    else:
        data = qrdetect[0].data.decode()
        idjoueur = requests.get(data).text

        if idjoueur == old_uuid:
            time.sleep(2)
            return scan(nmbrjoueurs, old_uuid)

        nmbrjoueurs += 1

        display("Joueur "+str(nmbrjoueurs)+" OK")
        buzzer()

        time.sleep(5)
        cap.read()

        players.append(idjoueur)
        print(players)
        if (nmbrjoueurs == 2):
            start()
        return scan(nmbrjoueurs, idjoueur)
    return

class Player:

    def __init__(self, uuid, total_goals = 0):
        self.uuid = uuid
        self.goals = []
        self.total_goals = total_goals

    def goal(self, time):
        self.total_goals += 1
        self.goals.append(time)

class Game:
    def __init__(self, player_1, player_2, place_id, player_3 = None, player_4 = None):
        self.player_1 = player_1
        self.player_2 = player_2
        self.place_id = place_id
        self.start_at = time.time()

    def end(self):
        self.playtime = round(time.time() - self.start_at, 0)

    def __dict__(self):
        return {'player_1': self.player_1.__dict__, 'player_2': self.player_2.__dict__, 'place_id': self.place_id, 'playtime': self.playtime}

    def goal(self, id):
        if id == 1:
            self.player_1.goal(time.time() - self.start_at)
        elif id == 2:
            self.player_2.goal(time.time() - self.start_at)

def main():
    mylcd.lcd_display_string("SCANNEZ VOTRE", 1)
    mylcd.lcd_display_string("QR CODE ->", 2)
    scan()

if __name__ == '__main__':
    main()

def start():
    for uuid in players:
        player_1 = Player(uuid)
        player_2 = Player(uuid)
    game = Game(player_1, player_2, PLACE_ID)
    mylcd.lcd_display_string("JOUEUR 1 > 0", 1)
    mylcd.lcd_display_string("JOUEUR 2 > 0", 2)
    score1 = 0
    score2 = 0
    old_dist_d = 0
    old_dist_g = 0
    old_time = 0
    while score1 < 11 or score2 < 11:
        dist_d = distance_d()
        dist_g = distance_g()
        tmp = time.time()
        if old_dist != 0 and old_time - tmp > 5:
            if dist_d >= old_dist_d+1 or dist_d <= old_dist_d-1:
                game.goal(2)
                score2 += 1
                mylcd.lcd_display_string("JOUEUR 2 > "+score2, 2)
                old_time = tmp
            if dist_g >= old_dist_g+1 or dist_g <= old_dist_g-1:
                game.goal(1)
                score1 += 1
                mylcd.lcd_display_string("JOUEUR 1 > "+score1, 1)
                old_time = tmp
        old_dist_d = dist_d
        time.sleep(0.025)

def push(game):
    data = json.dumps(game.__dict__())
    request = requests.post(URL, headers=HEADER, data=data)
