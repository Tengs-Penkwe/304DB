<?php
require '../config/database.php';

// Query the ChampionBCNF table to get all champions
$db = getDBConnection();
$query = $db->prepare('SELECT * FROM ChampionBCNF');
$query->execute();

$champions = $query->fetchAll(PDO::FETCH_ASSOC);

// Define tables related to champions
$tables = [
    'ChampionBCNF', 'AbilityOwned', 'Play', 'Owns', 'SkinDecorateBCNF', 'Sell1'
];

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

   if (isset($_POST['table']) && isset($_POST['field']) && isset($_POST['condition']) && isset($_POST['value'])) {
        $table = $_POST['table'];
        $field = $_POST['field'];
        $condition = $_POST['condition'];
        $value = $_POST['value'];

        $query_string = "SELECT * FROM $table WHERE $field $condition :value";
        $query = $db->prepare($query_string);
        $query->execute(['value' => $value]);

        $user_defined_results = $query->fetchAll(PDO::FETCH_ASSOC);
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

        <div class="container">
            <form action="" method="post">
                <h1>Find Information</h1>
                <div style="margin-bottom: 20px;">
                    <label>Select Table:</label><br>
                    <select name="table" id="table" onchange="loadFields()" style="width:100%; padding: 10px; font-size: 18px;">
                        <?php foreach ($tables as $table): ?>
                            <option value="<?= $table ?>"><?= $table ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label>Select Field:</label><br>
                    <select name="field" id="field" style="width:100%; padding: 10px; font-size: 18px;"></select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label>Select Condition:</label><br>
                    <select name="condition" style="width:100%; padding: 10px; font-size: 18px;">
                        <option value="=">=</option>
                        <option value=">">></option>
                        <option value="<"><</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label>Enter Value:</label><br>
                    <input type="text" name="value" required style="width:100%; padding: 10px; font-size: 18px;">
                </div>

                <button type="submit" style="padding: 15px; font-size: 18px; cursor: pointer; background-color: #0066cc; color: white; border: none; border-radius: 5px; width: 100%;">Execute Query</button>
            </form>
            <?php if (isset($user_defined_results) && count($user_defined_results) > 0): ?>
                <h2>User Defined Query Results</h2>
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <thead>
                        <tr>
                            <?php foreach ($user_defined_results[0] as $key => $value): ?>
                                <th style="padding: 10px; border: 1px solid #ccc; text-align: left;"><?= htmlspecialchars($key) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_defined_results as $row): ?>
                            <tr>
                                <?php foreach ($row as $cell): ?>
                                    <td style="padding: 10px; border: 1px solid #ccc;"><?= htmlspecialchars($cell) ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function loadFields() {
            var table = document.getElementById('table').value;
            var fieldsDropdown = document.getElementById('field');
            fieldsDropdown.options.length = 0; // Clear existing options
            
            // Define fields based on the selected table
            var fields = {
                'ChampionBCNF': ['name', 'cost', 'epithet', 'region'],
                'AbilityOwned': ['ability_name', 'cooldown', 'key', 'description', 'champion_name'],
                'Play': ['id', 'name'],
                'Owns': ['id', 'skin_name'],
                'SkinDecorateBCNF': ['skin_name', 'type', 'champion_name'],
                'Sell1': ['name', 'storeID']
            };
            
            var selectedFields = fields[table];
            selectedFields.forEach(function(field) {
                var option = document.createElement('option');
                option.value = field;
                option.text = field;
                fieldsDropdown.add(option);
            });
        }
    </script>
</body>
</html>