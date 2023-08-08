<?php
// Connect to the SQLite database
require '../config/database.php';
$db = getDBConnection();
$name = $_GET['name'];
$id = $_GET['id'];
$store = $_GET['store'];
$type = $_GET['type'];
// Query the Summoner table
$image = $db->prepare("SELECT image_url FROM EntityImages where entity_type = ? and entity_name = ?");
$image->execute([$type, $name]);
$result = $image->fetchAll(PDO::FETCH_ASSOC);

$money = $db->prepare("SELECT money FROM Summoner where id = ?");
$money->execute([$id]);
$money = $money->fetchAll(PDO::FETCH_ASSOC);

$cost = $_GET['cost'];
if ($cost < $money[0]['money']) {
    if ($type == 'Champion') {
        $query = $db->prepare("DELETE FROM Sell1 WHERE storeID = ? and name = ?");
        $query->execute([$store, $name]);

        $add = $db->prepare("insert into play values (?, ?)");
        $add->execute([$id, $name]);
    } else {
        $but_skin = $db->prepare("DELETE FROM Sell2 WHERE storeID = ? and name = ?");
        $but_skin->execute([$store, $name]);

        $add_skin = $db->prepare("insert into Owns values (?, ?)");
        $add_skin->execute([$id, $name]);
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>League of Legends Game Platform</title>
    <style>
        body { background-color: #f5f5f5; }
        .navbar { background-color: #ffcc00; }
        .jumbotron { background-image: url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/ec6b653d-20ae-41d7-8e78-5a2ec054db72/d7nzyi4-717deda0-3474-46d1-83d5-4f064cd966ad.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2VjNmI2NTNkLTIwYWUtNDFkNy04ZTc4LTVhMmVjMDU0ZGI3MlwvZDduenlpNC03MTdkZWRhMC0zNDc0LTQ2ZDEtODNkNS00ZjA2NGNkOTY2YWQuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.W39a-Uy9Isacf1cePghCwVuwqU3Qe2R44yLdJ3ZqWXw'); background-size: cover; color: white; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php?id=<?php echo $id?>">LOL Platform</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="profile.php?id=<?php echo $id?>">Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="ingame.php?id=<?php echo $id?>">In Game Info</a></li>
            <li class="nav-item"><a class="nav-link" href="champions.php">Champions</a></li>
            <li class="nav-item"><a class="nav-link" href="store.php?id=<?php echo $id?>">Store</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Log out</a></li>
        </ul>
    </div>
</nav>

<div class="jumbotron text-center">
    <h1>Welcome to the League of Legends Game Platform</h1>
    <p>Your one-stop destination for all things League!</p>
</div>

<div>
    <?php
        if ($cost > $money[0]['money']): ?>
    <h2>
        Oops! Seems like you did not bring enough money today, please try again later!
    </h2>
    <a class="champion-link" href="store.php?id=<?= $id?>"> Go back to store </a><br>
    <?php else: ?>
    <h2>
        Thank you for purchasing, now you have <?php echo $name?> in your collection!
    </h2>
    <a><img src="<?= htmlspecialchars($result[0]['image_url']) ?>" alt="" style="width:300px;height:200px;" ></a>
        <?php
            $update = $db->prepare("UPDATE Summoner set money = ? where id=?");
            $update->execute([$money[0]['money']-$cost, $id]);

            $new_money = $db->prepare("select money from summoner where id=?");
            $new_money->execute([$id]);
            $new_money = $new_money->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h2>
                Now you have <?php echo $new_money[0]['money'] ?> left, we have updated your profile!
            </h2>
            <a class="champion-link" href="store.php?id=<?= $id?>"> Go back to store </a><br>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
