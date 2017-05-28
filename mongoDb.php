<?php

$m = new MongoClient();

$db = $m->languages;

$collection = $db->countries;

// add a record
$document = array( "name" => "India", "capital" => "New Delhi" );
$collection->insert($document);

// add another record, with a different set of params
$document = array( "name" => "Narnia", "language" => "Aslanish", "ruler" => "Aslan" );
$collection->insert($document);

// find everything in the collection
$cursor = $collection->find();

// iterate through the results
foreach ($cursor as $document) {
    echo $document["name"] . "\n";
}

?>
