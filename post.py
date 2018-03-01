import time
import zmq
import random

def post():
    context = zmq.Context()

    post_sender = context.socket(zmq.PUSH)
    post_sender.connect("tcp://127.0.0.1:5555")

    result = {'category' : 'Programming', 'title': 'This is Python.'}
    post_sender.send_json(result)

post()
