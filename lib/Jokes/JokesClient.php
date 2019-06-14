<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Jokes;

/**
 */
class JokesClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Jokes\JokesRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetJoke(\Jokes\JokesRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Jokes.Jokes/GetJoke',
        $argument,
        ['\Jokes\JokesResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Jokes\AddJokeRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function AddJoke(\Jokes\AddJokeRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Jokes.Jokes/AddJoke',
        $argument,
        ['\Jokes\AddJokeResponse', 'decode'],
        $metadata, $options);
    }

}
