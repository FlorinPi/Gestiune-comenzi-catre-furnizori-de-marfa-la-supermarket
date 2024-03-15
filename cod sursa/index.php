<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>

    <div id="bg"></div>

    <form action="includes/login.inc.php" method="post">
        <div class="form-field">
            <input type="text" name="username" placeholder="Username">
        </div>
        <div class="form-field">
            <input type="password" name="pwd" placeholder="Password">
        </div>
        <div class="form-field">
            <button class="btn" type="submit">Login</button>
        </div>
    </form>

    <?php
        check_login_errors();
    ?>

</body>
</html>