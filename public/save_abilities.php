<?php
require '../config/database.php';
$db = getDBConnection();
$action = $_POST['action'];
$champion_name = $_POST['champion_name'];
$ability_name = $_POST['ability_name'];
$edit_ability_name = $_POST['edit_ability_name'];
$cooldown = $_POST['cooldown'];
$key = $_POST['key'];
$description = $_POST['description'];
$url = $_POST['image_url'];

if ($action === 'edit') {
    // You may use $ability_name as old ability name, because the name was selected from the dropdown
    $old_ability_name = $ability_name;
    $query = $db->prepare('UPDATE AbilityOwned SET ability_name = :ability_name, cooldown = :cooldown, key = :key, description = :description WHERE ability_name = :old_ability_name AND champion_name = :champion_name');
    $query->execute([
        ':ability_name' => $edit_ability_name, 
        ':cooldown' => $cooldown,
        ':key' => $key,
        ':description' => $description,
        ':old_ability_name' => $old_ability_name,
        ':champion_name' => $champion_name
    ]);

      // Update the image URL in the EntityImages table
    $query = $db->prepare('UPDATE EntityImages SET image_url = :image_url WHERE entity_name = :ability_name AND entity_type = "Ability"');
    $query->execute([
        ':image_url' => $image_url,
        ':entity_type' => 'Ability',
        ':ability_name' => $ability_name
    ]);
} else { // add
    $query = $db->prepare('INSERT INTO AbilityOwned (ability_name, cooldown, key, description, champion_name) VALUES (:ability_name, :cooldown, :key, :description, :champion_name)');
    $query->execute([
        ':ability_name' => $edit_ability_name,
        ':cooldown' => $cooldown,
        ':key' => $key,
        ':description' => $description,
        ':champion_name' => $champion_name
    ]);

    // Update the image URL in the EntityImages table
    $query = $db->prepare('UPDATE EntityImages SET image_url = :image_url WHERE entity_name = :ability_name AND entity_type = "Ability"');
    $query->execute([
        ':image_url' => $image_url,
        ':entity_type' => 'Ability',
        ':ability_name' => $ability_name
    ]);
}

header('Location: champion.php?name=' . urlencode($champion_name));
exit;

?>
