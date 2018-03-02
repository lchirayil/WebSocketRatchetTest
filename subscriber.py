import time
import zmq
import random
import json

def consumer():

    context = zmq.Context()
    # recieve work
    consumer_receiver = context.socket(zmq.SUB)
    consumer_receiver.connect("tcp://127.0.0.1:5556")
    consumer_receiver.setsockopt(zmq.SUBSCRIBE, '')


    zmq_socket = context.socket(zmq.PUSH)

    zmq_socket.connect("tcp://127.0.0.1:5555")
    zmq_socket.send("")

    print "Connected and listening..."

    while True:
        data = consumer_receiver.recv_multipart()
        print(data)

consumer()
