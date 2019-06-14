<?php

require dirname(__FILE__).'/vendor/autoload.php';

$options = getopt('i:');

echo "Adding a joke...? \n\n";

$client = new Jokes\JokesClient('localhost:50051', [
    'credentials' => Grpc\ChannelCredentials::createInsecure()
]);

$joke = new Jokes\AddJokeRequest();
$joke->setKeyword('guitar');
$joke->setQuestion('How do you get a guitar player to play softer?');
$joke->setPunchline('Give them a sheet of music!');

list($res, $status) = $client->AddJoke($joke)->wait();

if ($status->code !== 0) {
    echo "Problem adding joke\n";
    return;
}

echo "\n";
echo $res->getMessage();
echo "\n";



