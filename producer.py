import time
import zmq

def producer():
    context = zmq.Context()
    zmq_socket = context.socket(zmq.PUSH)

    zmq_socket.connect("tcp://127.0.0.1:5556")
    # Start your result manager and workers before you start your producers

    result = {'category' : 'Programming', 'title': 'This is Python.'}
    zmq_socket.send_json(result)


producer()
