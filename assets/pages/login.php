
<style>
        body {
            background: url('assets/images/wall2.jpg') center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            backdrop-filter: blur(2px);
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin-top: 30px;
        }

        .social-btn {
            margin-top: 20px;
        }

        .social-btn button {
            width: 100%;
            margin-bottom: 10px;
        }
        .sign-in{
            width: 100%;
        }
    </style>
<div class="container login-container">

    <form method="post" action="assets/php/actions.php?login=true&api=encoded">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/images/logo.png" alt="logo" height="45">
        </div>
        <h1 class="h5 mb-3 fw-normal text-center">Please sign in</h1>

        <div class="form-group mb-2">
            <label for="usernameEmail">Enter Email or Username</label>
            <input type="text" class="form-control" name="username_email" value="<?= showFormData('username_email')?>" placeholder="Enter Email or Username" required>
        </div>
        <?= showError('username_email')?>

        <div class="form-group mb-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <?= showError('password')?>
        <?= showError('checkuser')?>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" name="rememberme" id="rememberme" checked >
        <label class="form-check-label" for="rememberme">
        Remember me
        </label>
      </div>

        <div class="form-group mt-3">
            <button class="btn btn-primary btn-block sign-in mb-3"  type="submit">Sign in</button>
        </div>

        <div class="form-group text-center">
            <a href="?signup" class="text-decoration-none">Create New Account</a> |
            <a href="?forgot_password" class="text-decoration-none">Forgot password?</a>
        </div>

        <div class="social-btn">
            <button type="button" class="btn btn-outline-danger">Sign in with Google</button>
        </div>
    </form>
</div>

