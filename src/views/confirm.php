<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/css/confirmation.css" />
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="confirmation">
        <?php
        if (isset($message)){
            echo "<p>".$message."</p>";
        }
        if (isset($doctor)){
            echo "<p>Doctor: ".$doctor."</p>";
        }
        if (isset($date)){
            echo "<p>Date: ".$date."</p>";
        }
        ?>
        <a href="menu">return to menu</a>
    </div>
</body>
</html>
