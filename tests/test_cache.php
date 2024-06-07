<?php
require_once '../includes/init.php';
require_once '../cache/cache_db.php';

// Testdaten zum Cachen
$testKey = 'test_key';
$testData = array('name' => 'MiniGreX CMS', 'version' => '1.0', 'author' => 'Volkan Kücükbudak');

// Daten cachen
$cache = new Cache();
$cache->set($testKey, $testData);
echo "Daten wurden zwischengespeichert.<br>";

// Daten aus dem Cache abrufen
$cachedData = $cache->get($testKey);

if ($cachedData) {
    echo "Zwischengespeicherte Daten:<br>";
    echo "<pre>";
    print_r($cachedData);
    echo "</pre>";
} else {
    echo "Keine zwischengespeicherten Daten gefunden.";
}
?>
