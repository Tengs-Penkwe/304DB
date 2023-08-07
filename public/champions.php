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
            background-color: #f4f4f4;
            font-size: 20px;
            margin: 40px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        h1 {
            color: #333;
            font-size: 36px;
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 15px;
            border: 1px solid #ccc;
            margin: 8px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
            border-radius: 5px;
        }
        li:hover {
            background-color: #e6e6e6;
            transform: scale(1.02);
        }
        a {
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Champions List</h1>
        <ul>
            <?php foreach ($champions as $champion): ?>
                <li>
                    <a href="champion.php?name=<?= urlencode($champion['name']) ?>"><?= htmlspecialchars($champion['name']) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>

