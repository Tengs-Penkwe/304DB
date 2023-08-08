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

// Query to fetch the image URL
$query = $db->prepare('SELECT image_url FROM EntityImages WHERE entity_type = :type AND entity_name = :name');
$query->execute([':type' => 'Champion', ':name' => $champion_name]);
$image = $query->fetch(PDO::FETCH_ASSOC);

// Query to fetch the abilities of champions
$query = $db->prepare('SELECT ability_name, cooldown, key, description FROM AbilityOwned WHERE champion_name = :name');
$query->execute([':name' => $champion_name]);
$abilities = $query->fetchAll(PDO::FETCH_ASSOC);

// Query to fetch the abilities
$query_abilities = $db->prepare('
    SELECT a.*, i.image_url 
    FROM AbilityOwned a 
    LEFT JOIN EntityImages i
    ON a.ability_name = i.entity_name 
    WHERE champion_name = :name
');
$query_abilities->execute([':name' => $champion_name]);
$abilities = $query_abilities->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Volkorn:wght@400;700;900&display=swap" rel="stylesheet">
    <title><?= htmlspecialchars($champion['name']) ?></title>
    <style>
        .body {
            font-family: 'Tangerine', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 32px;
            margin: 2%;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1200px;
        }
        .centered-title {
            font-family: 'Cinzel Decorative', serif;
            text-align: center;
            font-size: 36;
            font-weight: 600;
        }
        .ability-name {
            display: block;
            font-family: 'Raleway', sans-serif;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }
        .ability-description {
            text-indent: 2em;
            font-family: 'Volkorn';
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        h2 {
            color: #333;
        }
        .abilities-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .ability-card {
            flex: 1 1 200px; /* Adjust the value based on the desired minimum width of your cards */
            max-width: calc(100% / 3 - 10px); /* You can change 3 to any number of cards you want per row */
            margin: 5px;
            position: relative;
            background: linear-gradient(to right, #f2f2f2, #ffffff);
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 250px;
            transition: transform .2s ease;
        }
        .ability-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 15px 0px rgba(0, 0, 0, 0.1);
        }
        .ability-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .ability-card h2 {
            font-size: 1.2em;
            margin: 10px 0;
            color: #333;
        }
        .ability-card p {
            font-size: 0.9em;
            color: #666;
            text-align: justify;
            margin: 10px;
        }
        .key-container {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            padding: 5px;
        }
        .key {
            background-color: #333;
            border-radius: 50%;
            color: #fff;
            padding: 5px 8px;
            font-size: 1.2em;
            font-weight: bold;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 800px) {
          .ability-card {
              max-width: calc(100% - 10px); /* Makes it one card per row in small screens */
          }
        }
        .cooldown {
          position: absolute;
          top: 2px; /* Adjust as needed */
          left: 2px; /* Adjust as needed */
          background-color: rgba(0, 0, 0, 0); /* A semi-transparent dark background */
          padding: 2px 5px;
          border-radius: 2px; /* Softens the corners */
          color: #f4f4f4; /* A light grey text */
          font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="centered-title"><?= htmlspecialchars($champion['name']) ?></h1>
        <?php if ($image): ?>
            <img src="<?= $image['image_url'] ?>" alt="<?= htmlspecialchars($champion['name']) ?>" class="img-fluid mb-3">
        <?php endif; ?>
        <p><strong>Cost:</strong> <?= $champion['cost'] ?></p>
        <p><strong>Region:</strong> <?= $champion['region'] ?></p>
        <h2 class="centered-title"><?= $champion['epithet'] ?></h2>
        <p class="body"><?= htmlspecialchars($champion['background_story']) ?></p>
        <div class="abilities-container">
            <?php foreach ($abilities as $ability): ?>
                <div class="ability-card">
                    <img src="<?= $ability['image_url'] ?>" alt="<?= htmlspecialchars($ability['ability_name']) ?>">
                    <span class="ability-name"><?= htmlspecialchars($ability['ability_name']) ?></span>
                    <div class="key-container">
                        <span class="key"><?= htmlspecialchars($ability['key']) ?></span>
                    </div>
                    <p class="cooldown"> <?= $ability['cooldown'] ?> s</p>
                    <p class="ability-description"><?= htmlspecialchars($ability['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="btn btn-primary mt-3" href="champions.php">Back to Champions List</a>
        
      <h2 class="centered-title">Manage Abilities:</h2>
        <form action="save_abilities.php" method="post" id="manage-ability-form">
            <input type="hidden" name="champion_name" value="<?= htmlspecialchars($champion_name) ?>">
            <label>
                <input type="radio" name="action" value="edit" checked onchange="toggleAbilitySelection(true); prepareEditAbility();">
                Edit Ability
            </label>
            <label>
                <input type="radio" name="action" value="add" onchange="toggleAbilitySelection(false); prepareAddAbility();">
                Add New Ability
            </label>
            
            <div id="ability-selection">
                <label for="ability_name">Select Ability to Edit:</label>
                <select id="ability_name" name="ability_name" required onchange="loadAbilityInfo(this.value);">
                    <?php foreach ($abilities as $ability): ?>
                        <option value="<?= htmlspecialchars($ability['ability_name']) ?>"><?= htmlspecialchars($ability['ability_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Edit or Add Ability Fields --> <br>
            <label for="edit_ability_name">Ability Name:</label>
            <input type="text" id="edit_ability_name" name="edit_ability_name" required><br>
            <label for="cooldown">Cooldown:</label>
            <input type="number" id="cooldown" name="cooldown" required><br>
            <label for="key">Key:</label>
            <input type="text" id="key" name="key" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" cols="50" rows="10" required></textarea><br>
            <label for="image_url">Image URL:</label>
            <input type="text" id="image_url" name="image_url" required><br>
            <button type="submit" id="submit-button">Save Changes</button>
        </form>

        <script>
            var abilities = <?= json_encode($abilities) ?>; // Convert PHP abilities array to JavaScript object

            function toggleAbilitySelection(show) {
                document.getElementById('ability-selection').style.display = show ? 'block' : 'none';
                document.getElementById('submit-button').innerText = show ? 'Save Changes' : 'Add Ability';
                if (show) {
                    prepareEditAbility();
                } else {
                    prepareAddAbility();
                }
            }

            function prepareEditAbility() {
                var selectedAbility = document.getElementById('ability_name').value;
                loadAbilityInfo(selectedAbility);
            }

            function prepareAddAbility() {
                document.getElementById('edit_ability_name').value = '';
                document.getElementById('cooldown').value = '';
                document.getElementById('key').value = '';
                document.getElementById('description').value = '';
                document.getElementById('image_url').value = ''; 
            }

            function loadAbilityInfo(abilityName) {
                var ability = abilities.find(function(ability) { return ability.ability_name === abilityName; });
                if (ability) {
                    document.getElementById('edit_ability_name').value = ability.ability_name;
                    document.getElementById('cooldown').value = ability.cooldown;
                    document.getElementById('key').value = ability.key;
                    document.getElementById('description').value = ability.description;
                    document.getElementById('image_url').value = ability.image_url; 
                }
            }

            prepareEditAbility(); // Initialize the form with the selected ability
        </script>

</body>
</html>
