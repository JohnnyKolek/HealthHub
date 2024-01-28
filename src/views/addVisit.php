<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/public/css/addVisit.css"/>
    <script type="text/javascript" src="./public/js/addVisit.js" defer></script>
    <title>Doctor Dashboard</title>
</head>
<body>
<nav>
    <div class="logo">
        <img src="./public/img/logo.svg" alt=""/>
    </div>
    <ul>
        <li><a href="#">add visit date</a></li>
        <li><a href="doctorVisits">my visits</a></li>
        <li><a href="logout">logout</a></li>
    </ul>
</nav>
<main>
    <form class="add-visit" action="addVisit" method="POST">
        <h1>add visit date</h1>
        <div class="input">
            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <label>
                <input name="date" type="date">
            </label>
            <label>
                <input name="hour" type="time">
            </label>
        </div>
        <button type="submit">ADD</button>
    </form>
</main>
</body>
</html>
