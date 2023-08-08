<?php
require '../config/database.php';

$champion_name = $_GET['champion_name'] ?? '';
$action = $_GET['action'] ?? 'add';
$selected_ability_name = $_GET['ability_name'] ?? '';

$db = getDBConnection();
$ability = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'];
    $ability_name = $_POST['ability_name'];
    $cooldown = $_POST['cooldown'];
    $key = $_POST['key'];
    $description = $_POST['description'];

    if ($action === 'edit') {
        $old_ability_name = $_POST['old_ability_name'];
        $query = $db->prepare('UPDATE AbilityOwned SET ability_name = :ability_name, cooldown = :cooldown, key = :key, description = :description WHERE ability_name = :old_ability_name AND champion_name = :champion_name');
        $query->execute([
            ':ability_name' => $ability_name,
            ':cooldown' => $cooldown,
            ':key' => $key,
            ':description' => $description,
            ':old_ability_name' => $old_ability_name,
            ':champion_name' => $champion_name
        ]);
    } else { // add
        $query = $db->prepare('INSERT INTO AbilityOwned (ability_name, cooldown, key, description, champion_name) VALUES (:ability_name, :cooldown, :key, :description, :champion_name)');
        $query->execute([
            ':ability_name' => $ability_name,
            ':cooldown' => $cooldown,
            ':key' => $key,
            ':description' => $description,
            ':champion_name' => $champion_name
        ]);
    }

    header('Location: champion.php?name=' . urlencode($champion_name));
    exit;
}

//Prepare the form data
if ($action === 'edit' && $selected_ability_name) {
    $query = $db->prepare('SELECT * FROM AbilityOwned WHERE champion_name = :champion_name AND ability_name = :ability_name');
    $query->execute([':champion_name' => $champion_name, ':ability_name' => $selected_ability_name]);
    $ability = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Ability</title>
</head>
<body>
    <h1><?= $action === 'edit' ? 'Edit' : 'Add' ?> Ability</h1>
    <form action="manage_ability.php" method="put">
        <input type="hidden" name="action" value="<?= $action ?>">
        <input type="hidden" name="champion_name" value="<?= htmlspecialchars($champion_name) ?>">
        <?php if ($action === 'edit'): ?>
            <input type="hidden" name="old_ability_name" value="<?= htmlspecialchars($ability_name) ?>">
        <?php endif; ?>
        <label for="ability_name">Ability Name:</label>
        <input type="text" id="ability_name" name="ability_name" value="<?= $ability['ability_name'] ?? '' ?>" required><br>
        <label for="cooldown">Cooldown:</label>
        <input type="number" id="cooldown" name="cooldown" value="<?= $ability['cooldown'] ?? '' ?>" required><br>
        <label for="key">Key:</label>
        <input type="text" id="key" name="key" value="<?= $ability['key'] ?? '' ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= $ability['description'] ?? '' ?></textarea><br>
        <button type="submit"><?= $action === 'edit' ? 'Save Changes' : 'Add Ability' ?></button>
    </form>
</body>
</html>
