import time
import zmq
import random

def consumer():

    context = zmq.Context()

    consumer_receiver = context.socket(zmq.PULL)
    consumer_receiver.connect("tcp://127.0.0.0:5555")

    while True:
        work = consumer_receiver.recv_json()
        print(work)

    # post_sender = context.socket(zmq.PUSH)
    # post_sender.connect("tcp://127.0.0.1:5555")
    #
    # result = {'category' : 'Programming', 'title': 'This is Python.'}
    # post_sender.send_json(result)

consumer()
