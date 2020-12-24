<?php require_once 'controllers/authController.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">


                <form action="forgot-password.php" method="post">
                    <h3 class="text-center">Login</h3>

                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <?php foreach($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if(count($errorss) > 0): ?>
                    <div class="alert alert-success">
                        <?php foreach($errorss as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block bn-lg" name="forgot-btn">Reset password</button>
                    </div>
                    <p class="text-center"><a href="login.php">Password remembered</a></p>
                </form>


            </div>
        </div>
    </div>
</body>
</html>