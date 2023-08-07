<?php
require '../config/database.php';

$champion_name = $_GET['name'] ?? ''; // Retrieve the champion name from the GET parameter

// Query the ChampionBCNF table to get details of the champion
$db = getDBConnection();
$query = $db->prepare('SELECT * FROM ChampionBCNF WHERE name = :name');
$query->execute([':name' => $champion_name]);

$champion = $query->fetch(PDO::FETCH_ASSOC);
if (!$champion) {
    echo 'Champion not found!';
    exit;
}

// Display the champion details
echo "<h1>{$champion['name']}</h1>";
echo "<p>Cost: {$champion['cost']}</p>";
echo "<p>Region: {$champion['region']}</p>";
echo "<p>Epithet: {$champion['epithet']}</p>";

// You can add more details such as abilities, skins, and other related information using additional queries.
?>

