<?php
require '../config/database.php';

// Query the ChampionBCNF table to get all champions
$db = getDBConnection();
$query = $db->prepare('SELECT * FROM ChampionBCNF');
$query->execute();

$champions = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['minAbilities'])) {
        $minAbilities = $_POST['minAbilities'];
        $query = $db->prepare('SELECT champion_name, COUNT(*) as ability_count FROM AbilityOwned GROUP BY champion_name HAVING COUNT(*) > :minAbilities');
        $query->bindParam(':minAbilities', $minAbilities, PDO::PARAM_INT);
        $query->execute();
        $champions_with_abilities = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // DIVISION query
    if (isset($_POST['key'])) {
        $key = $_POST['key'];
        $query = $db->prepare("SELECT champion_name FROM AbilityOwned WHERE key = :key GROUP BY champion_name");
        $query->execute(['key' => $key]);
        $champions_with_ability = $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
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
        <form action="" method="post">
            <label for="key">Ability Key:</label>
            <input type="text" id="key" name="key" required>
            <button type="submit">Find Champions</button>
        </form>
        <?php if (isset($champions_with_ability)): ?>
            <h2>Champions with ability key <?= htmlspecialchars($key) ?>:</h2>
            <ul>
                <?php foreach ($champions_with_ability as $champion_with_ability): ?>
                    <li><?= htmlspecialchars($champion_with_ability['champion_name']) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <h2>All Champions:</h2>
        <ul>
            <?php foreach ($champions as $champion): ?>
                <li>
                    <a href="champion.php?name=<?= urlencode($champion['name']) ?>"><?= htmlspecialchars($champion['name']) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <h2>Find Champions with Specific Number of Abilities</h2>
        <form action="" method="post">
            <label for="minAbilities">Minimum Number of Abilities:</label>
            <input type="number" id="minAbilities" name="minAbilities" required>
            <button type="submit">Find Champions</button>
        </form> 
        <?php if (isset($champions_with_abilities)): ?>
        <h3>Champions with More Than Specified Abilities</h3>
        <table border="1">
            <tr>
                <th>Champion Name</th>
                <th>Number of Abilities</th>
            </tr>
            <?php foreach ($champions_with_abilities as $champion): ?>
                <tr>
                    <td><?= htmlspecialchars($champion['champion_name']) ?></td>
                    <td><?= htmlspecialchars($champion['ability_count']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</body>
</html>

