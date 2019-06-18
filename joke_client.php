<?php

require dirname(__FILE__).'/vendor/autoload.php';

$options = getopt('i:');

echo "Bad joke coming up... \n\n";

$instrument = isset($options['i']) ? $options['i'] : '';

$DOCKER_HOST = $_ENV['DOCKER_HOST'];

$client = new Jokes\JokesClient("server1:50051", [
    'credentials' => Grpc\ChannelCredentials::createInsecure()
]);

$joke = new Jokes\JokesRequest();
$joke->setKeyword($instrument);

list($res, $status) = $client->GetJoke($joke)->wait();

if ($status->code !== 0) {
    echo "Problem finding joke\n";
    return;
}

echo "\n";
echo $res->getJoke();
echo "\n";



