<?php

require 'vendor/autoload.php';
// Create seed data
$seedData = array(
    array(
        'decade' => '1970s',
        'artist' => 'Earth, Wind, And Fire',
        'song' => 'Dancing in September',
        'weeksAtOne' => 10
    ),
    array(
        'decade' => '1980s',
        'artist' => 'Olivia Newton-John',
        'song' => 'Physical',
        'weeksAtOne' => 10
    ),
    array(
        'decade' => '1990s',
        'artist' => 'Mariah Carey',
        'song' => 'One Sweet Day',
        'weeksAtOne' => 16
    ),
);


$uri = "mongodb://mandut:sparta300@localhost:8080/db";
$client = new MongoDB\Client($uri);


$songs = $client->db->songs;

$songs->insertMany($seedData);

$songs->updateOne(
    array('artist' => 'Mariah Carey'),
    array('$set' => array('artist' => 'Mariah Carey ft. Boyz II Men'))
);

$query = array('weeksAtOne' => array('$gte' => 10));
$options = array(
    "sort" => array('decade' => 1),
);
$cursor = $songs->find($query,$options);
foreach($cursor as $doc) {
    echo 'In the ' .$doc['decade'];
    echo ', ' .$doc['song'];
    echo ' by ' .$doc['artist'];
    echo ' topped the charts for ' .$doc['weeksAtOne'];
    echo ' straight weeks.', "\n";
}

$songs->drop();
?>
