<?php
require '../config/database.php';

// Query the ChampionBCNF table to get all champions
$db = getDBConnection();
$query = $db->prepare('SELECT * FROM ChampionBCNF');
$query->execute();

$champions = $query->fetchAll(PDO::FETCH_ASSOC);

// Display all champions and link to their individual detail pages
echo "<h1>Champions List</h1>";
echo "<ul>";
foreach ($champions as $champion) {
    echo "<li>";
    echo "<a href='champions.php?name=" . urlencode($champion['name']) . "'>" . htmlspecialchars($champion['name']) . "</a>";
    echo "</li>";
}
echo "</ul>";
?>

