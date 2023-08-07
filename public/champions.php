<?php
require '../config/database.php';

// Query the ChampionBCNF table to get all champions
$db = getDBConnection();
$query = $db->prepare('SELECT * FROM ChampionBCNF');
$query->execute();

$champions = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Champions List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px;
            border: 1px solid #ccc;
            margin: 8px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        a {
            text-decoration: none;
            color: #0066cc;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Champions List</h1>
    <ul>
        <?php foreach ($champions as $champion): ?>
            <li>
                <a href="champion.php?name=<?= urlencode($champion['name']) ?>"><?= htmlspecialchars($champion['name']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
