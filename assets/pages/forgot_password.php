
 <style>
   body {
            background: url('assets/images/wall1.jpg') center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            backdrop-filter: blur(4px);
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin-top: 30px;
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .btn-action {
            width: 100%;
            padding: 10px;
        }

        .btn-back {
            text-align: center;
            margin-top: 20px;
        }
    </style>



    <div class="login-container container">
    <div class="text-center mb-4">
            <img class="mb-4" src="assets/images/logo.png" alt="logo" height="45">
        </div>
        <?php
        if (isset($_SESSION['forgot_otp']) && !isset($_SESSION['Auth_temp'])) {
            $action = "verifycode";
        } elseif (isset($_SESSION['forgot_otp']) && isset($_SESSION['Auth_temp'])) {
            $action = "changepassword";
        } else {
            $action = "forgot_password";
        }
        ?>

        <form action="assets/php/actions.php?<?= $action ?>" method='post'>
            <h1 class="h5 mb-3 fw-normal">Forgot Your Password ?</h1>

            <?php if (isset($_GET['verificationmsg'])): ?>
                <div class="alert alert-info my-2" role="alert">
                    <?= $_GET['verificationmsg'] ?>
                </div>
            <?php endif; ?>

            <?php if ($action == "forgot_password"): ?>
                <p>Enter Your Connected Email with your Account</p>
                <div class="form-floating">
                    <input type="text" class="form-control rounded-0" name="email" placeholder="Enter email Here">
                    <label for="floatingInput">Enter Email here</label>
                </div>
               
                <button class="btn btn-info btn-action" type="submit">Send Verification Code</button>
            <?php endif; ?>

            <?php if ($action == "verifycode"): ?>
                <p>Enter 6 Digit Code Sent to <span class="text-success"><?= $_SESSION['forget_email'] ?></span></p>
                <div class="form-floating mt-1">
                    <input type="text" class="form-control rounded-0" name="code" id="floatingPassword"
                           placeholder="Enter Code">
                    <label for="floatingPassword">######</label>
                </div>
                <button class="btn btn-primary btn-action" type="submit">Verify Code</button>
            <?php endif; ?>

            <?php if ($action == "changepassword"): ?>
                <p>Enter Your New Password for <span class="text-success"><?= $_SESSION['forget_email'] ?></span></p>
                <div class="form-floating mt-1">
                    <input type="password" class="form-control rounded-0" id="floatingPassword" name="password"
                           placeholder="New Password">
                    <label for="floatingPassword">New Password</label>
                </div>
                <button class="btn btn-primary btn-action" type="submit">Change Password</button>
            <?php endif; ?>

            <?= showError('email'); ?>
            
            <div class="btn-back">
                <a href="assets/php/actions.php?logout" class="text-decoration-none">
                    <i class="bi bi-arrow-left-circle-fill"></i> Go Back To Login
                </a>
            </div>
        </form>
    </div>
