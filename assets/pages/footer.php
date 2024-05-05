<?php global $db;
?>
<?php if (isset($_SESSION['Auth'])) { ?>
    <div class="modal fade" id="addpost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addposttitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" style="display:none" id="post_image" class="w-100 rounded border">
                    <form method="post" action="assets/php/actions.php?addpost" enctype="multipart/form-data">
                        <div class="my-3">
                            <input class="form-control" name="post_image" type="file" id="select_post_image">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Say Something</label>
                            <textarea name="post_text" class="form-control" id="exampleFormControlTextarea1"
                                rows="1"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" title="publish your post" style="width:100%" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="notification_sidebar" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notifications</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php
            $notifications = getNotifications();

            // Check if there are unread notifications
            $unreadNotifications = array_filter($notifications, function ($notification) {
                return $notification['read_status'] == 0;
            });

            if (count($unreadNotifications) > 0) {
                // Display the message for unread notifications
                echo "<div class='text-danger p-2 mt-1 bg-light border rounded text-center'>
              You have " . count($unreadNotifications) . " unread notifications</div>";
            } elseif (count($notifications) > 0) {
                // Display a message for no unread notifications but there are notifications
                echo "<div class='text-success p-2 mt-1 bg-light border rounded text-center'>
              You have no unread notifications</div>";
            } else {
                // Display a message when there are no notifications at all
                echo "<div class='text-info p-2 mt-1 bg-light border rounded text-center'>
              No notifications available</div>";
            }


            foreach ($notifications as $not) {

                $time = $not['created_at'];
                $fuser = getUserData($not['from_user_id']);
                $post = '';
                if ($not['post_id']) {
                    $post = 'data-bs-toggle="modal" data-bs-target="#postview' . $not['post_id'] . '"';
                }
                $fbtn = '';
                ?>
                <div class="d-flex justify-content-between border-bottom">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?= $fuser['profile_pic'] ?>" alt="" height="40" width="40"
                                class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?= $fuser['username'] ?>' class="text-decoration-none text-dark">
                                <h6 style="margin: 0px;font-size: small;">
                                    <?= $fuser['f_name'] ?>
                                    <?= $fuser['l_name'] ?>
                                    <?php if ($fuser['blue_tick'] == 1): ?>
                                        <sup class="blue_tick"><i class="bi bi-check-circle-fill"></i></sup>
                                    <?php endif; ?>
                                </h6>
                            </a>
                            <p style="margin:0px;font-size:small" class="<?= $not['read_status'] ? 'text-muted' : '' ?> "
                                <?= $post ?>>@
                                <?= $fuser['username'] ?>
                                <?= $not['message'] ?>
                            </p>
                            <time style="font-size:small"
                                class="timeago <?= $not['read_status'] ? 'text-muted' : '' ?> text-small"
                                datetime="<?= $time ?>"></time>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <?php
                        if ($not['read_status'] == 0) {
                            ?>
                            <div class="p-1 bg-primary rounded-circle"></div>

                            <?php

                        } else if ($not['read_status'] == 2) {
                            ?>
                                <span class="badge bg-danger">Post Deleted</span>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <?php
            }


            ?>

        </div>
    </div>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="messages_sidebar" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Messages</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="chatlist">
        </div>

    </div>
    </div>
    <div class="modal fade" id="chatbox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><img src="assets/images/profile/default.png"
                            id="chatter_pic" height="40" width="40" class="m-1 rounded-circle" alt=""> @<span
                            id="chatter_username">username</span>
                        <sup class="blue_tick mx-1 d-none" id="verifyed"><i class="bi bi-check-circle-fill"></i></sup>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body message-container" id="user_data">

                </div>
                <div class="modal-footer">

                    <div class="alert alert-danger text-center d-none mx-auto" role="alert" id="blerror">
                        <i class="bi bi-x-octagon-fill"></i> You are not allowed to send message!
                    </div>

                    <div class="input-group p-2" id="msgsender">
                        <input type="text" class="form-control rounded-0 border-0" id="msginput"
                            placeholder="say something.." aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary rounded-0 border-0" id="sendmessage" data-user-id="0"
                            type="button">send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<!-- <div class="footer-container">
    <footer class="py-3 ">
        <div class="footer_UL">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 footer_nav ">
                <li class="nav-item"><a href="#" class="nav-link px-3">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-3">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-3">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-3">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-3">About</a></li>
            </ul>
        </div>
        <p class="text-center text-muted">&copy; 2024 Secret Space, Inc</p>
    </footer>
</div> -->
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/scripts/jquery-3.7.1.min.js"></script>
<script src="assets/scripts/jquery.timeago.js"></script>
<script src="assets/scripts/custom.js?v=<?= time() ?>"></script>
</body>

</html>