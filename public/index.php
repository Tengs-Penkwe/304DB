<?php
// Connect to the SQLite database
$db = new PDO('sqlite:../database/LOL.db');

// Query the Summoner table
$query = $db->query("SELECT * FROM Summoner");
$summoners = $query->fetchAll(PDO::FETCH_ASSOC);

// HTML for displaying the Summoner table
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
        .jumbotron { background-image: url('images/banner.jpg'); background-size: cover; color: white; }
        .feature { padding: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">LOL Platform</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="champions.php">Champions</a></li>
                <li class="nav-item"><a class="nav-link" href="store.php">Store</a></li>
            </ul>
        </div>
    </nav>
    <div class="jumbotron text-center">
        <h1>Welcome to the League of Legends Game Platform</h1>
        <p>Your one-stop destination for all things League!</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 feature">
                <h3>Profile</h3>
                <p>Explore your summoner's profile, including stats, friends, and achievements.</p>
            </div>
            <div class="col-md-4 feature">
                <h3>Champions</h3>
                <p>Discover the vast array of champions, abilities, and skins you own.</p>
            </div>
            <div class="col-md-4 feature">
                <h3>Store</h3>
                <p>Learn about in-game store items, offers, and more.</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <div class="container mt-5">
        <h1 class="text-center">Summoners</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Level</th>
                    <th>Rank</th>
                    <th>Money</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summoners as $summoner): ?>
                    <tr>
                        <td><?= htmlspecialchars($summoner['id']) ?></td>
                        <td><?= htmlspecialchars($summoner['level']) ?></td>
                        <td><?= htmlspecialchars($summoner['rank']) ?></td>
                        <td><?= htmlspecialchars($summoner['money']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

