<?php global $user; ?>
<div class="container col-md-9 rounded-0 d-flex justify-content-between">
    <div class="col-md-12 bg-white border rounded p-4 mt-4 shadow-sm">
        <form method="post" action="assets/php/actions.php?updateprofile" enctype="multipart/form-data">
            <!-- Your existing form content -->

            <h1 class="h5 mb-3 fw-normal">Edit Profile </h1>

            <div class="form-floating mt-1 col-md-6">
                <img src="assets/images/profile/<?= $user['profile_pic'] ?>" class="img-thumbnail my-3"
                    style="height:150px;" alt="...">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Change Profile Picture</label>
                    <input class="form-control" type="file" name="profile_pic" id="formFile">
                </div>
            </div>
            <?= showError('profile_pic')?>
            <div class="d-flex flex-md-row flex-column">
                <div class="form-floating mt-1 col-md-6 col-sm-12">
                    <input type="text" name="f_name" value="<?= $user['f_name'] ?>" class="form-control rounded-0"
                        placeholder="first name">
                    <label for="floatingInput">first name</label>
                </div>
                <div class="form-floating mt-1 col-md-6 col-sm-12">
                    <input type="text" name="l_name" value="<?= $user['l_name'] ?>" class="form-control rounded-0"
                        placeholder="last name">
                    <label for="floatingInput">last name</label>
                </div>
            </div>
            <?= showError('f_name')?>
            <?= showError('l_name')?>
            <div class="d-flex gap-3 my-3">
                <!-- Your existing gender radio buttons here -->
            </div>
            <div class="form-floating mt-1">
                <input type="email" class="form-control rounded-0" name="email" value="<?= $user['email']?>"
                    placeholder="username/email" disabled>
                <label for="floatingInput">email</label>
            </div>
            <div class="form-floating mt-1">
                <input type="text" class="form-control rounded-0" value="<?= $user['username']?>" name="username"
                    placeholder="username">
                <label for="floatingInput">username</label>
            </div>
            <?= showError('username')?>
            <div class="form-floating mt-1">
                <input type="password" class="form-control rounded-0" name="password" id="floatingPassword"
                    placeholder="New Password">
                <label for="floatingPassword"> New Password</label>
            </div>
            <div class="mt-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" type="submit">Update Profile</button>
            </div>
        </form>
    </div>
</div>
