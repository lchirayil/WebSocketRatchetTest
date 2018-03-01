import time
import zmq
import random
import json

def consumer():

    context = zmq.Context()
    # recieve work
    consumer_receiver = context.socket(zmq.SUB)
    consumer_receiver.connect("tcp://127.0.0.1:5556")
    consumer_receiver.setsockopt(zmq.SUBSCRIBE, 'Programming')

    print "Connected and listening..."

    while True:
        data = consumer_receiver.recv()
        print(data)

consumer()
