<?php
// Connect to the SQLite database
require '../config/database.php';
$db = getDBConnection();
$id =  $_GET['id'];
// Query the Summoner table
$query = $db->prepare("SELECT * FROM StoreVisit SV, Sell1 S, ChampionBCNF C WHERE id =? AND SV.storeID = S.storeID 
                                                          AND C.name = S.name");
$query->execute([$id]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$store = $result[0]["storeID"];

$skins = $db->prepare("SELECT * FROM StoreVisit SV, Sell2 S, SkinDecorateBCNF SD WHERE id =? AND SV.storeID = S.storeID 
                                                          AND SD.skin_name = S.name");
$skins->execute([$id]);
$skins = $skins->fetchAll(PDO::FETCH_ASSOC);

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
<div class="container mt-5">
    <h1 class="text-center">Champion Store</h1>
    <?php $money = $db->prepare("select money from summoner where id=?");
    $money->execute([$id]);
    $money = $money->fetchAll(PDO::FETCH_ASSOC);?>
    <h3> You currently have <?= $money[0]['money']?> with you</h3>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Original Price</th>
            <th>Price After discount</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $champion):
            $query = $db->prepare("SELECT image_url FROM EntityImages WHERE entity_name =? AND entity_type='Champion'");
            $query->execute([$champion['name']]);
            $result = $query->fetch();
            ?>
            <tr>
                <td><?= htmlspecialchars($champion['name']) ?></td>
                <td><img src="<?= htmlspecialchars($result['image_url']) ?>" alt="Image of <?= htmlspecialchars($champion['name']) ?>" width="300" height="200"></td>
                <td><?= htmlspecialchars($champion['cost']) ?></td>
                <td><?= htmlspecialchars($champion['cost'] * (100 - $champion['promotion']) / 100) ?></td>
                <td>
                    <a class="champion-link" href="purchase.php?name=<?= urlencode($champion['name']) ?>&id=<?= $id?>&store=<?= $store?>&cost=<?=$champion['cost'] * (100 - $champion['promotion']) / 100 ?>&type=Champion"> Purchase </a><br>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h1 class="text-center">Skin Store</h1>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Original Price</th>
            <th>Price After discount</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($skins as $skin):
            $skin_image = $db->prepare("SELECT image_url FROM EntityImages WHERE entity_name =? AND entity_type='Skin'");
            $skin_image->execute([$skin['skin_name']]);
            $skin_image = $skin_image->fetch();
            ?>
            <tr>
                <td><?= htmlspecialchars($skin['skin_name']) ?></td>
                <td><img src="<?= htmlspecialchars($skin_image['image_url']) ?>" alt="Image of <?= htmlspecialchars($skin['skin_name']) ?>" width="300" height="200"></td>
                <?php $skin_cost = $db->prepare("SELECT cost FROM TypeCost WHERE type =?");
                $skin_cost->execute([$skin['type']]);
                $skin_cost = $skin_cost->fetch();
                ?>
                <td><?= htmlspecialchars($skin_cost['cost']) ?></td>
                <td><?= htmlspecialchars($skin_cost['cost'] * (100 - $skin['promotion']) / 100) ?></td>
                <td>
                    <a class="champion-link" href="purchase.php?name=<?= urlencode($skin['skin_name']) ?>&id=<?= $id?>&store=<?= $store?>&cost=<?=$skin_cost['cost'] * (100 - $skin['promotion']) / 100 ?>&type=Skin"> Purchase </a><br>
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
