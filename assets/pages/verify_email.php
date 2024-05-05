<?php global $user;?>
<style>
         body {
            background: url('assets/images/wall4.jpg') center center fixed;
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
            
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .btn-resend {
            color: #007bff;
            text-decoration: none;
        }

        .btn-verify {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            width: 100%;
        margin-bottom: 10px;
        }
   
        .btn-logout {
            color: #dc3545;
            text-decoration: none;
        }
    </style>
</head>
<body>


    <div class="container login-container">
        <form method="post" action="assets/php/actions.php?verify_email">
            <h1 class="h5 mb-3 fw-normal">Verify Your Email ID <span class="text-success"><?= $user['email'] ?></span></h1>

            <p>Enter the 6-digit code sent to you.</p>

            <?php if (isset($_GET['verificationmsg'])): ?>
                <div class="alert alert-info my-2" role="alert">
                    <?= $_GET['verificationmsg'] ?>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" class="form-control rounded-0" id="floatingPassword" name="code" placeholder="Enter OTP Here">
                <label for="floatingPassword">######</label>
            </div>

            <?= showError('email_verify');?>

            <div class="d-flex justify-content-between align-items-center">
                <!-- <a href="assets/php/actions.php?resend_code" class="btn-resend">Resend Code</a> -->
                <button class="btn btn-verify" type="submit">Verify Email</button>
            </div>

            <br>

            <a href="assets/php/actions.php?logout" class="btn-logout mt-4">
                <i class="bi bi-arrow-left-circle-fill"></i> Logout
            </a>
            <a href="assets/php/actions.php?resend_code" class="btn-resend float-end" ><i class="bi bi-arrow-clockwise"></i> Send again</a>
        </form>
    </div>
