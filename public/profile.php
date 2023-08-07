<?php
// Connect to the SQLite database
require_once('../config/database.php');
$db = getDBConnection();
$id =  $_GET['id'];
// Query the Summoner table
// Query the Summoner table, including the images
$query = $db->prepare("
    SELECT Summoner.id, level, rank, money, GROUP_CONCAT(distinct skin_name) AS skins, GROUP_CONCAT(distinct ChampionBCNF.name) AS champions, EntityImages.image_url
    FROM Summoner 
    LEFT JOIN Play ON Summoner.id = Play.id 
    LEFT JOIN ChampionBCNF ON Play.name = ChampionBCNF.name 
    LEFT JOIN EntityImages ON Summoner.id = EntityImages.entity_name AND EntityImages.entity_type = 'Summoner'
    LEFT JOIN Owns on Summoner.id = Owns.id
    where Summoner.id = ?
    GROUP BY Summoner.id
");
$query->execute([$id]);
$summoners = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 18px;
        }
        h1 {
            font-size: 36px;
            color: #333;
            margin-top: 30px;
        }
        .champion-link {
            display: inline-block;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .champion-link:hover {
            background-color: #f2f2f2;
        }
        img {
            border-radius: 5px;
        }
    </style>
    <title>Summoners Profiles | League of Legends Game Platform</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Summoners Profiles</h1>
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>ID</th>
                    <th>Level</th>
                    <th>Rank</th>
                    <th>Money</th>
                    <th>Champions</th>
                    <th>Skins</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summoners as $summoner): 
                    $champions = explode(',', $summoner['champions']);
                    $skins = explode(',', $summoner['skins']);
                ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($summoner['image_url']) ?>" alt="Image of <?= htmlspecialchars($summoner['id']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($summoner['id']) ?></td>
                        <td><?= htmlspecialchars($summoner['level']) ?></td>
                        <td><?= htmlspecialchars($summoner['rank']) ?></td>
                        <td><?= htmlspecialchars($summoner['money']) ?></td>
                        <td>
                            <?php foreach ($champions as $champion): ?>
                                <a class="champion-link" href="champion.php?name=<?= urlencode($champion) ?>"><?= htmlspecialchars($champion) ?></a><br>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach ($skins as $skin): ?>
                                <a class="champion-link" href="skin.php?name=<?= urlencode($skin) ?>"><?= htmlspecialchars($skin) ?></a><br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

