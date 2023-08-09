<?php
require '../config/database.php';

// Connect to the SQLite database
$db = getDBConnection();


$id = $_GET['id'];
// HTML for displaying the Summoner table
$selected_columns = [];
if (isset($_POST['columns'])) {
    $selected_columns = $_POST['columns'];
}

$columns_sql = empty($selected_columns) ? "*" : implode(",", $selected_columns);

// Query the Summoner table
$query = $db->query("SELECT $columns_sql FROM Summoner");
$summoners = $query->fetchAll(PDO::FETCH_ASSOC);

$id = $_GET['id'];
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
        .feature { padding: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">LOL Platform</a>
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
    <div class="container">
        <div class="row">
            <div class="col-md-4 feature">
                <h3>Summoners</h3>
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
        <form method="post" class="mb-3">
            <label>Select columns to show:</label>
            <input type="checkbox" name="columns[]" value="id" <?= in_array('id', $selected_columns) ? 'checked' : '' ?>> ID
            <input type="checkbox" name="columns[]" value="level" <?= in_array('level', $selected_columns) ? 'checked' : '' ?>> Level
            <input type="checkbox" name="columns[]" value="rank" <?= in_array('rank', $selected_columns) ? 'checked' : '' ?>> Rank
            <input type="checkbox" name="columns[]" value="money" <?= in_array('money', $selected_columns) ? 'checked' : '' ?>> Money
            <button type="submit" class="btn btn-primary">Show</button>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <?php if (in_array('id', $selected_columns) || empty($selected_columns)): ?><th>ID</th><?php endif; ?>
                    <?php if (in_array('level', $selected_columns) || empty($selected_columns)): ?><th>Level</th><?php endif; ?>
                    <?php if (in_array('rank', $selected_columns) || empty($selected_columns)): ?><th>Rank</th><?php endif; ?>
                    <?php if (in_array('money', $selected_columns) || empty($selected_columns)): ?><th>Money</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summoners as $summoner): ?>
                    <tr>
                        <?php if (in_array('id', $selected_columns) || empty($selected_columns)): ?><td><?= htmlspecialchars($summoner['id']) ?></td><?php endif; ?>
                        <?php if (in_array('level', $selected_columns) || empty($selected_columns)): ?><td><?= htmlspecialchars($summoner['level']) ?></td><?php endif; ?>
                        <?php if (in_array('rank', $selected_columns) || empty($selected_columns)): ?><td><?= htmlspecialchars($summoner['rank']) ?></td><?php endif; ?>
                        <?php if (in_array('money', $selected_columns) || empty($selected_columns)): ?><td><?= htmlspecialchars($summoner['money']) ?></td><?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

