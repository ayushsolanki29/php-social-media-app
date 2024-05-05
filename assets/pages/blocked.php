<?php global $user?>
<style>
       body {
            background: url('assets/images/wall5.png') center center fixed;
            backdrop-filter: blur(6px);
            background-size: cover;
            height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
        }
</style>
<div class="login-container  container">
    <div class=" rounded p-4">
        <form>
            <div class="d-flex justify-content-center">
                <img class="mb-4" src="assets/images/logo.png" alt="logo" height="45">
            </div>
            <h1 class="h5 mb-3 fw-normal">
                Hello, <?php echo $user['f_name'] ?>. Your account is currently blocked by the admin.
                <br>
                (Username: <?php echo $user['username'] ?>)
            </h1>

            <div class="mt-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#logoutConfirmationModal">
                    Logout
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutConfirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="assets/php/actions.php?logout" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>



    