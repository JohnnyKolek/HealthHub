<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/public/css/addVisit.css"/>
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
            <input name="date" type="text" placeholder="date in format YYYY-MM-DD">
            <input name="hour" type="text" placeholder="hour in format HH:mm">
        </div>
        <button type="submit">ADD</button>
    </form>
</main>
</body>
</html>
