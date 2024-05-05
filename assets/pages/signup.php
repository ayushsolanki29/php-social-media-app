<style>
    body {
        background: url('assets/images/wall4.jpg') center center fixed;
        background-size: cover;
        height: 100vh;
        margin: 0;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(2px);
    }

    .signup-container {
        background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin-bottom: 20px;
            margin-top: 30px;
    }

    .gender-options {
        display: flex;
        gap: 3px;
        margin-top: 10px;
    }

    .gender-options label {
        flex-grow: 1;
    }
    .Sign-Up{
        width: 100%;
        margin-bottom: 10px;
    }
</style>


<div class="container signup-container">
    <form method="post" action="assets/php/actions.php?signup=true&api=encoded">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/images/logo.png" alt="" height="45">
        </div>
        <h1 class="h5 mb-3 fw-normal text-center">Create new account</h1>
        <div class="d-flex  mb-3">
            <div class="form-group col-6 ">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" name="f_name" placeholder="First Name"
                    value="<?= showFormData('f_name') ?>">
                <?= showError('f_name') ?>
            </div>
            <div class="form-group col-6">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" name="l_name" placeholder="Last Name"
                    value="<?= showFormData('l_name') ?>">
                <?= showError('l_name') ?>
            </div>
        </div>

        <div class="gender-options  mb-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="1"
                    <?= showFormData('gender') == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="maleRadio">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="2"
                    <?= showFormData('gender') == 2 ? 'checked' : '' ?>>
                <label class="form-check-label" for="femaleRadio">Female</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="otherRadio" value="0"
                    <?= showFormData('gender') == 0 ? 'checked' : '' ?>>
                <label class="form-check-label" for="otherRadio">Other</label>
            </div>
        </div>

        <div class="form-group  mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email"
                value="<?= showFormData('email') ?>">
            <?= showError('email') ?>
        </div>

        <div class="form-group  mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username"
                value="<?= showFormData('username') ?>">
            <?= showError('username') ?>
        </div>

        <div class="form-group  mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <?= showError('password') ?>
        </div>

        <div class="form-group mt-3">
            <button class="btn btn-primary btn-block Sign-Up" type="submit">Sign Up</button>
        </div>

        <div class="form-group text-center">
            <a href="?login" class="text-decoration-none">Already have an account?</a>
        </div>
    </form>
</div>