<?php
// Connect to the SQLite database
require_once('../config/database.php');
$db = getDBConnection();
$id =  $_GET['id'];
// Query the Summoner table
// Query the Summoner table, including the images
$query = $db->prepare("
    SELECT Summoner.id, level, rank, money, GROUP_CONCAT(distinct skin_name) AS skins, GROUP_CONCAT(distinct ChampionBCNF.name) AS champions, EntityImages.image_url
    FROM Summoner 
    LEFT JOIN Play ON Summoner.id = Play.id 
    LEFT JOIN ChampionBCNF ON Play.name = ChampionBCNF.name 
    LEFT JOIN EntityImages ON Summoner.id = EntityImages.entity_name AND EntityImages.entity_type = 'Summoner'
    LEFT JOIN Owns on Summoner.id = Owns.id
    where Summoner.id = ?
    GROUP BY Summoner.id
");
$query->execute([$id]);
$summoners = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f5f5; }
        .navbar { background-color: #ffcc00; }
        h1 {
            font-size: 36px;
            color: #333;
            margin-top: 30px;
        }
        .champion-link {
            display: inline-block;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .champion-link:hover {
            background-color: #f2f2f2;
        }
        img {
            border-radius: 5px;
        }
    </style>
    <title>Summoners Profiles | League of Legends Game Platform</title>
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
    <div class="container mt-5">
        <h1 class="text-center">Summoners Profiles</h1>
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>ID</th>
                    <th>Level</th>
                    <th>Rank</th>
                    <th>Money</th>
                    <th>Champions</th>
                    <th>Skins</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summoners as $summoner): 
                    $champions = explode(',', $summoner['champions']);
                    $skins = explode(',', $summoner['skins']);
                ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($summoner['image_url']) ?>" alt="Image of <?= htmlspecialchars($summoner['id']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($summoner['id']) ?></td>
                        <td><?= htmlspecialchars($summoner['level']) ?></td>
                        <td><?= htmlspecialchars($summoner['rank']) ?></td>
                        <td><?= htmlspecialchars($summoner['money']) ?></td>
                        <td>
                            <?php foreach ($champions as $champion): ?>
                                <a class="champion-link" href="champion.php?name=<?= urlencode($champion) ?>"><?= htmlspecialchars($champion) ?></a><br>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach ($skins as $skin): ?>
                                <p><?= $skin ?></p>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<script type="text/html" id="lover">
    <tr>
        <td>Champion lover</td>
        <td>Have at least 2 skins for 1 champion</td>
        <?php
        $result = $db->prepare("select champion_name from Owns O, SkinDecorateBCNF S
                where O.skin_name = S.skin_name and id = ? group by champion_name having count(*) >= 2;");
        $result->execute([$id]);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result) > 0):?>
            <td>
                <?php foreach ($result as $champion): ?>
                    <p>Title achieved for <?= $champion['champion_name'] ?></p>
                <?php endforeach; ?>
            </td>
        <?php else: ?>
            <td>Not owned</td>
        <?php endif; ?>
    </tr>
</script>

<script type="text/html" id="collector">
    <tr>
        <td>Collector</td>
        <td>Have all skins</td>
        <?php
        $result = $db->prepare("select * from Owns as O where O.id = ? and not exists (select * from SkinDecorateBCNF as S where not
        exists (select * from Owns as OW where OW.id = O.id and OW.skin_name = S.skin_name))");
        $result->execute([$id]);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result) > 0):?>
        <td>Title achieved!</td>
        <?php else: ?>
        <td>Not owned</td>
        <?php endif; ?>
    </tr>
</script>

<script type="text/html" id="hunter">
    <tr>
        <td>Skin hunter</td>
        <td>Have more skins than all other summoners combined</td>
        <?php
        $result = $db->prepare("select O1.id from Owns O1 group by O1.id having O1.id = ? and count(*) > 
                                                (select count(*) from Owns O2 where O2.id != ?)");
        $result->execute([$id, $id]);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result) > 0):?>
            <td>Title achieved!</td>
        <?php else: ?>
            <td>Not owned</td>
        <?php endif; ?>
    </tr>
</script>

<div class="container mt-5">
    <h1 class="text-center">Titles</h1>
    <button class="appendLover" onclick="this.style.display='none'">Click to see if you have champion lover title</button>
    <button class="appendCollector" onclick="this.style.display='none'">Click to see if you have collector title</button>
    <button class="appendHunter" onclick="this.style.display='none'">Click to see if you have skin hunter title</button>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody id="title">

        </tbody>
    </table>
</div>


<script type="text/html" id="append">
    <div class="container" id="summary">
    <div class="row">
        <div class="col-md-4 feature">
            <?php $count = $db->prepare("select count(*) as number from Owns O, SkinDecorateBCNF S
                where O.skin_name = S.skin_name and type = 'Epic' and id = ? group by id;");
            $count->execute([$id]);
            $count = $count->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($count) > 0) :?>
                <h3>Epic Skin: <?= $count[0]['number'];?></h3>
            <?php else:?>
                <h3>Epic Skin: 0</h3>
            <?php endif;?>
        </div>
        <div class="col-md-4 feature">
            <?php $count = $db->prepare("select count(*) as number from Owns O, SkinDecorateBCNF S
                where O.skin_name = S.skin_name and type = 'Legendary' and id = ? group by id;");
            $count->execute([$id]);
            $count = $count->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($count) > 0) :?>
                <h3>Legendary Skin: <?= $count[0]['number'];?></h3>
            <?php else:?>
                <h3>Legendary Skin: 0</h3>
            <?php endif;?>
        </div>
        <div class="col-md-4 feature">
            <?php $count = $db->prepare("select count(*) as number from Owns O, SkinDecorateBCNF S
                where O.skin_name = S.skin_name and type = 'Mythic' and id = ? group by id;");
            $count->execute([$id]);
            $count = $count->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($count) > 0) :?>
                <h3>Mythic Skin: <?= $count[0]['number'];?></h3>
            <?php else:?>
                <h3>Mythic Skin: 0</h3>
            <?php endif;?>
        </div>
    </div>
    </div>
</script>


    <div class="container mt-5" id="summary">
        <h1 class="text-center">Skin Collection</h1>
        <button class="appendDiv" id="buttonHide" onclick="this.style.display='none'">Click to view your collection summary</button>
    </div>

    <div class="container mt-5">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Type</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($summoners as $summoner):
                $skins = explode(',', $summoner['skins']);
                foreach ($skins as $skin):
                    $skin_info = $db->prepare("select * from SkinDecorateBCNF S, TypeCost T where skin_name = ? and S.type = T.type");
                    $skin_info->execute([$skin]);
                    $skin_info = $skin_info->fetchAll(PDO::FETCH_ASSOC);

                    $query = $db->prepare("SELECT image_url FROM EntityImages WHERE entity_name =? AND entity_type='Skin'");
                    $query->execute([$skin]);
                    $result = $query->fetch();
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($skin_info[0]['skin_name']) ?></td>
                        <td><img src="<?= htmlspecialchars($result['image_url']) ?>" alt="Image of <?= htmlspecialchars($skin_info[0]['type']) ?>" width="400" height="200"></td>
                        <td><?= htmlspecialchars($skin_info[0]['type']) ?></td>
                        <td><?= htmlspecialchars($skin_info[0]['cost']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script>
        $(".appendDiv").click(function() {
            let template = $('#append').html();
            $("#summary").append(template);
        });

        $(".appendLover").click(function() {
            let table = $('#lover').html();
            $("#title").append(table);
        });

        $(".appendCollector").click(function() {
            let table = $('#collector').html();
            $("#title").append(table);
        });

        $(".appendHunter").click(function() {
            let table = $('#hunter').html();
            $("#title").append(table);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

