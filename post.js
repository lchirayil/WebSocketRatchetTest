var zmq = require('zeromq')
  , sock = zmq.socket('push');

sock.connect('tcp://127.0.0.1:5555');

data = {'category': 'Programming', 'title': 'This is JavaScript.'};
sock.send(JSON.stringify(data));
console.log('Producer bound to port 5555');
sock.disconnect('tcp://127.0.0.1:5555');
