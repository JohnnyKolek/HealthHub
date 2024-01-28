<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/css/personalData.css"/>
    <script type="text/javascript" src="./public/js/personalData.js" defer></script>
    <title>Personal Data</title>
</head>
<body>
<nav>
    <div class="logo">
        <img src="./public/img/logo.svg" alt=""/>
    </div>
    <ul>
        <li><a href="doctors">doctors</a></li>
        <li><a href="#">personal data</a></li>
        <li><a href="logout">logout</a></li>
    </ul>
</nav>
<main>
    <div>
        <div class="choose">
            <?php
            if (isset($user)){
                echo "<div><b>Name</b>: ".$user->getName()."</div>";
                echo "<div><b>Surname</b>: ".$user->getSurname()."</div>";
                echo "<div><b>email</b>: ".$user->getEmail()."</div>";
                echo "<div><b>Phone number</b>: ".$user->getPhone()."</div>";
            }
            ?>
        </div>
        <p>My Visits</p>
        <ul class="visits">
            <?php
            if (isset($visits) && $visits != null) {
                foreach ($visits as $visit): ?>
                    <li>
                        <div><?= $visit->getDate() ?></div>
                        <div><?= $visit->getDoctor() ?></div>
                    </li>
                <?php endforeach;
            }
            ?>
        </ul>
    </div>
</main>
</body>
</html>