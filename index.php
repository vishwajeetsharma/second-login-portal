<?php require_once 'controllers/authController.php';
if (!isset($_SESSION['username'])) {
    header('location: logout.php');
}
if (!isset($_SESSION['email'])) {
    header('location: logout.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Homepage</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">

            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-success" >
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
                <h3>Welcome, <?php echo $_SESSION['username']; ?></h3>

                <a href="logout.php" class="logout">logout</a>
                <p class="alert alert-danger">You have to verify your all details <a href="verify.php">Click Here</a> to verify your all details!</p>
                <?php if (!$_SESSION['verified']): ?>
                <div class="alert alert-warning">
                    You need to verify your account.
                    Sign in into your email account and click on the
                    verification link we just emailed you at
                    <strong><?php echo $_SESSION['email']; ?></strong>
                <?php endif; ?>
                </div>

                <?php if ($_SESSION['verified']): ?>
                <button class="btn btn-block btn-lg btn-primary">I am verified</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>