<?php
namespace MyApp;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class Pusher implements WampServerInterface {

  protected $subscribedTopics = array();

  public function onSubscribe(ConnectionInterface $conn, $topic) {
      $this->subscribedTopics[$topic->getId()] = $topic;
  }

  /**
   * @param string JSON'ified string we'll receive from ZeroMQ
   */

  public function onDataReceived($entry) {

    $entryData = json_decode($entry, true);

    //Sent to anyone listening to port 5556
    $context = new \ZMQContext();
    $socket = $context->getSocket(\ZMQ::SOCKET_PUB, 'my pusher');
    $socket->bind("tcp://127.0.0.1:5556");
    $socket->send($entryData['category'] , 1);
    $socket->send(json_encode($entryData));

    // If the lookup topic object isn't set there is no one to publish to
    if (!array_key_exists($entryData['category'], $this->subscribedTopics)) {
        return;
    }

    // Data to client
    $topic = $this->subscribedTopics[$entryData['category']];

    // re-send the data to all the clients subscribed to that category

    $topic->broadcast($entryData);
  }


  public function onUnSubscribe(ConnectionInterface $conn, $topic) {

  }

  public function onOpen(ConnectionInterface $conn) {

  }

  public function onClose(ConnectionInterface $conn) {

  }

  public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
      // In this application if clients send data it's because the user hacked around in console
      $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
  }

  public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
      // In this application if clients send data it's because the user hacked around in console
      echo $topic . "\n";
      // $conn->close();
  }

  public function onError(ConnectionInterface $conn, \Exception $e) {

  }

}
