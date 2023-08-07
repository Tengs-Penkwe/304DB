<?php
require '../config/database.php';

$champion_name = $_GET['name'] ?? '';
$db = getDBConnection();
$query = $db->prepare('
    SELECT c.*, e.background_story 
    FROM ChampionBCNF c 
    LEFT JOIN EpithetBackground e 
    ON c.epithet = e.epithet 
    WHERE name = :name
');
$query->execute([':name' => $champion_name]);

$champion = $query->fetch(PDO::FETCH_ASSOC);

if (!$champion) {
    echo 'Champion not found!';
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($champion['name']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
            margin: 10px 0;
        }
        .back-link {
            display: block;
            margin: 20px 0;
            text-decoration: none;
            color: #0066cc;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($champion['name']) ?></h1>
        <p>Cost: <?= $champion['cost'] ?></p>
        <p>Region: <?= $champion['region'] ?></p>
        <p>Epithet: <?= $champion['epithet'] ?></p>
        <h2>Background Story:</h2>
        <p><?= htmlspecialchars($champion['background_story']) ?></p>
        <!-- Add more details such as abilities, skins, and other related information using additional queries here -->
        <a class="back-link" href="champions.php">Back to Champions List</a>
    </div>
</body>
</html>
