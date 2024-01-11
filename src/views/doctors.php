<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./public/css/doctors.css"/>
    <script type="text/javascript" src="./public/js/doctors.js" defer></script>
    <title>Doctors</title>
</head>
<body>
<nav>
    <div class="logo">
        <img src="./public/img/logo.svg" alt=""/>
    </div>
    <ul>
        <li><p>Doctors</p></li>
        <li><p>Personal Data</p></li>
        <li><p>Logout</p></li>
    </ul>
</nav>
<div class="doctors">
    <div class="container">
        <?php
        if (isset($doctors) && $doctors != null) {
            foreach ($doctors as $doctor): ?>
                <div class="doctor">
                    <div class="doctorCard">
                        <div class="info">
                            <div class="photo"><img src="public/img/doctor<?= $doctor['id'] ?>.jpg" alt=""/></div>
                            <div class="name">
                                <p><?= $doctor['name'] ?> <?= $doctor['surname'] ?></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur cupiditate debitis
                                delectus
                                distinctio excepturi nam odit placeat quia quos? Alias consectetur dignissimos dolore
                                illum
                                ipsam
                                quae quasi ratione suscipit voluptatum.</p>
                        </div>
                        <div class="schedule">
                            <div class="days">
                                <?php
                                if (isset($days)) {
                                    foreach ($days as $day): ?>
                                        <div class="day">
                                            <div><?= $day['dayOfWeek']; ?></div>
                                            <div><?= $day['dayOfMonth']; ?></div>
                                        </div>
                                    <?php endforeach;
                                }
                                ?>
                            </div>
                            <div class="hours">
                                <div class="hour">9:00</div>
                                <div class="hour">9:30</div>
                                <div class="hour">10:00</div>
                                <div class="hour">10:30</div>
                                <div class="hour">11:00</div>
                                <div class="hour">11:30</div>
                                <div class="hour">12:00</div>
                                <div class="hour">12:30</div>
                                <div class="hour">13:00</div>
                                <div class="hour">13:30</div>
                                <div class="hour">14:00</div>
                                <div class="hour">14:30</div>
                                <div class="hour">15:00</div>
                                <div class="hour">15:30</div>
                                <div class="hour">16:00</div>
                                <div class="hour">16:30</div>
                                <div class="hour">17:00</div>
                                <div class="hour">17:30</div>
                            </div>
                        </div>
                    </div>
                    <button>submit</button>
                </div>
            <?php endforeach;
        } ?>
    </div>
</body>
</html>
