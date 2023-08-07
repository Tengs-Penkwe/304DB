<?php
// Connect to the SQLite database
require_once('../config/database.php');
$db = getDBConnection();

// Query the Summoner table
$query = $db->query("SELECT Summoner.id, level, rank, money, GROUP_CONCAT(ChampionBCNF.name) AS champions FROM Summoner LEFT JOIN Play ON Summoner.id = Play.id LEFT JOIN ChampionBCNF ON Play.name = ChampionBCNF.name GROUP BY Summoner.id");
$summoners = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>Summoners Profiles | League of Legends Game Platform</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Summoners Profiles</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>ID</th>
                    <th>Level</th>
                    <th>Rank</th>
                    <th>Money</th>
                    <th>Champions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summoners as $summoner): 
                    $champions = explode(',', $summoner['champions']);
                ?>
                    <tr>
                        <td><img src="../images/<?= htmlspecialchars($summoner['id']) ?>.jpg" alt="Image of <?= htmlspecialchars($summoner['id']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($summoner['id']) ?></td>
                        <td><?= htmlspecialchars($summoner['level']) ?></td>
                        <td><?= htmlspecialchars($summoner['rank']) ?></td>
                        <td><?= htmlspecialchars($summoner['money']) ?></td>
                        <td>
                            <?php foreach ($champions as $champion): ?>
                                <a href="champion.php?name=<?= urlencode($champion) ?>"><?= htmlspecialchars($champion) ?></a><br>
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

