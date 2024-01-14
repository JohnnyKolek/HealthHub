<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/public/css/doctorVisits.css"/>
    <title>Doctor Dashboard</title>
</head>
<body>
<nav>
    <div class="logo">
        <img src="./public/img/logo.svg" alt=""/>
    </div>
    <ul>
        <li><a href="addVisit">add visit date</a></li>
        <li><a href="#">my visits</a></li>
        <li><a href="logout">logout</a></li>
    </ul>
</nav>
<main>
    <div>
        <ul>
            <?php
            if (isset($visits) && $visits != null) {
                foreach ($visits as $visit): ?>
            <li>
                <div><?=$visit->getDate() ?></div>
                <div><?=$visit->getPatient()?></div>
            </li>
                <?php endforeach;
            }
            ?>
        </ul>
    </div>
</main>
</body>