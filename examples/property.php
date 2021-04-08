<?php
require_once __DIR__ . '../../vendor/autoload.php';

use ForwardForce\Estated\Estated;
use GuzzleHttp\Exception\GuzzleException;

//assumes token is in env var, or you can pass directly
$token = getenv('ESTATED_API_KEY');

//instance of the Estated client
$estated = new Estated($token);

try {
    $property = $estated->property('151 Battle Green Dr', 'Rochester', 'NY', '14624');
    var_dump($property);
} catch (GuzzleException $e) {
    var_dump($e->getMessage());
}
