<?php
global $user;
global $posts;
global $follow_suggetions;
?>


<div class="container rounded-0 d-flex justify-content-between main_container">

    <div class="col-8 image_container">
        <?php
        showError('post_image');
        foreach ($posts as $post) {
            $likes = gettingLikesCount($post['id']);
            $comments = gettingCommentsCount($post['id']);
            ?>
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="?u=<?= $post['username'] ?>" class="text-decoration-none text-dark">
                        <div class="d-flex align-items-center">
                            <img src="assets/images/profile/<?= $post['profile_pic'] ?>" alt="" height="30"
                                class="rounded-circle border">&nbsp;&nbsp;
                            <div class="d-flex flex-column align-items-start">
                                <span class="fw-bold">
                                    <?= $post['f_name'] ?>
                                    <?= $post['l_name'] ?>
                                    <?php if ($post['blue_tick'] == 1): ?>
                                        <sup class="blue_tick"><i class="bi bi-check-circle-fill"></i></sup>
                                    <?php endif; ?>
                                </span>
                                <span class="text-muted">@
                                    <?= $post['username'] ?>
                                </span>
                            </div>


                        </div>
                    </a>
                    <div class="dropdown">
                        <?php if ($post['user_id'] == $user['id']): ?>
                            <i class="bi bi-three-dots-vertical" id="option<?= $post['id'] ?>" data-bs-toggle="dropdown"
                                aria-expanded="false"></i>
                            <ul class="dropdown-menu" aria-labelledby="option<?= $post['id'] ?>">
                                <li><a class="dropdown-item" href="assets/php/actions.php?deletepost=<?= $post['id'] ?>">
                                        <i class="bi bi-trash-fill"></i> Delete Post</a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <img src="assets/images/posts/<?= $post['post_img'] ?>" class="card-img-top" data-bs-toggle="modal"
                    data-bs-target="#postview<?= $post['id'] ?>" alt="Post Image">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="like_btns">
                            <?php
                            $likeStatus = likeStatus($post['id']);
                            $like_btn = $likeStatus ? "none" : "";
                            $unlike_btn = $likeStatus ? "" : "none";
                            ?>
                            <i class="bi bi-heart-fill unlike_btn"
                                style="font-size:18px; color:red; display: <?= $unlike_btn ?>;"
                                data-post-id="<?= $post['id'] ?>"></i>
                            <i class="bi bi-heart like_btn" style=" font-size:18px;display: <?= $like_btn ?>"
                                data-post-id="<?= $post['id'] ?>"></i>
                            <span class="text-muted  " data-bs-toggle="modal" data-bs-target="#likes<?= $post['id'] ?>">
                                <?= count($likes) ?>
                            </span>
                            <i class="bi bi-chat-fill mx-2" style="font-size:18px;" data-bs-toggle="modal"
                                data-bs-target="#postview<?= $post['id'] ?>"></i><span class="text-muted">
                                <?= count($comments) ?>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <span class="text-muted">
                            <?= show_time($post['created_at']) ?>
                        </span>
                    </div>
                    <?php if (!empty($post['post_text'])): ?>
                        <div class="card-text mt-3">
                            <?= $post['post_text'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer bg-white">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-0 border-0 comment-input"
                            placeholder="Say something..." aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page="home"
                            data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>" type="button"
                            id="button-addon2">Post</button>
                    </div>
                </div>
            </div>

            <!-- for comments and view post -->
            <div class="modal fade" id="postview<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body d-md-flex p-0">
                            <div class="col-md-8 col-sm-12 text-center">
                                <img src="assets/images/posts/<?= $post['post_img'] ?>"
                                    class="img-fluid card-img-top mx-auto" data-bs-toggle="modal"
                                    data-bs-target="#postview<?= $post['id'] ?>" alt="...">
                            </div>
                            <div class="col-md-4 col-sm-12 d-flex flex-column">
                                <div class="d-flex align-items-center p-2 <?= $post['post_text'] ? '' : 'border-bottom' ?>">
                                    <img src="assets/images/profile/<?= $post['profile_pic'] ?>" alt="" height="50"
                                        width="50" class="rounded-circle border">
                                    <div class="ms-3">
                                        <a href="?u=<?= $post['username'] ?>" class="text-dark text-decoration-none">
                                        <h6 class="mb-0">
                                            <?= $post['f_name'] ?>
                                            <?= $post['l_name'] ?>

                                            <?php if ($post['blue_tick']) {

                                                echo "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>";
                                            } ?>
                                        </h6></a>
                                        <p class="text-muted mb-0">@
                                            <?= $post['username'] ?>
                                        </p>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="dropdown">
                                            <?php $likeStatus = likeStatus($post['id']);
                                            $like_btn = $likeStatus ? "none" : "";
                                            $unlike_btn = $likeStatus ? "" : "none";
                                            ?>
                                            <i class="bi bi-heart-fill unlike_btn"
                                                style="font-size:18px; color:red; display: <?= $unlike_btn ?>;"
                                                data-post-id="<?= $post['id'] ?>"></i>
                                            <i class="bi bi-heart like_btn"
                                                style=" font-size:18px;display: <?= $like_btn ?>"
                                                data-post-id="<?= $post['id'] ?>"></i>
                                            <span class="<?= count($likes) < 1 ? 'disabled' : '' ?>"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?= count($likes) ?> likes
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <?php foreach ($likes as $like): ?>
                                                    <?php $lu = getUserData($like['user_id']); ?>
                                                    <li><a class="dropdown-item" href="?u=<?= $lu['username'] ?>">
                                                            <?= $lu['f_name'] . ' ' . $lu['l_name'] ?>
                                                            <?php if ($lu['blue_tick']) {

                                                                echo "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>";
                                                            } ?> (@
                                                            <?= $lu['username'] ?>)
                                                        </a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="text-muted" style="font-size: small;">Posted
                                            <?= show_time($post['created_at']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-bottom p-2 <?= $post['post_text'] ? '' : 'd-none' ?>">
                                    <?= $post['post_text'] ?>
                                </div>
                                <div class="flex-fill align-self-stretch overflow-auto"
                                    id="comment-section<?= $post['id'] ?>" style="height: 100px;">
                                    <?php if (count($comments) < 1): ?>
                                        <p class="p-3 text-center my-2 comment_notice">No comments</p>
                                    <?php endif; ?>
                                    <?php foreach ($comments as $comment): ?>
                                        <?php $cuser = getUserData($comment['user_id']); ?>
                                        <div class="d-flex align-items-center p-2">
                                            <img src="assets/images/profile/<?= $cuser['profile_pic'] ?>" alt="" height="40"
                                                width="40" class="rounded-circle border">
                                            <div class="ms-3">
                                                <h6 class="mb-0">
                                                    <a href="?u=<?= $cuser['username'] ?>"
                                                        class="text-decoration-none text-muted">@
                                                        <?= $cuser['username'] ?>
                                                        <?php if ($cuser['blue_tick']) {

                                                            echo "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>";
                                                        } ?>
                                                    </a> -
                                                    <?= $comment['comment'] ?>
                                                </h6>
                                                <p class="text-muted mb-0">
                                                    <?= show_time($comment['created_at']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (checkFollowStatus($user['id']) || $user['id'] == $user['id']): ?>
                                    <div class="input-group p-2 border-top">
                                        <input type="text" class="form-control rounded-0 border-0 comment-input"
                                            placeholder="Say something..." aria-label="Recipient's username"
                                            aria-describedby="button-addon2">
                                        <button class="btn btn-outline-primary rounded-0 border-0 add-comment"
                                            data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>"
                                            type="button" id="button-addon2">Post</button>
                                    </div>
                                <?php else: ?>
                                    <div class="text-danger p-2 mt-3 bg-light border rounded text-center">
                                        If you want to comment, follow this user
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--=== for comments and view post end ====-->
            <!-- for like list -->
            <div class="modal fade" id="likes<?= $post['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="addposttitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Liked By</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                            foreach ($likes as $f) {
                                $users = getUserData($f['user_id']);
                                $followBtn = "";
                                if (checkFollowStatus($f['user_id'])) {
                                    $followBtn = '<button class="btn btn-sm btn-danger unFollowBtn" data-user-id=' . $users['id'] . '>Unfollow</button>';
                                } elseif ($user['id'] == $f['user_id']) {
                                    $followBtn = "";
                                } elseif (checkBS($f['user_id'])) {
                                    $followBtn = "";
                                } else {
                                    $followBtn = '<button class="btn btn-sm btn-success FollowBtn" data-user-id=' . $users['id'] . '>Follow</button>';
                                }
                                ?>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center p-2">
                                        <div><img src="assets/images/profile/<?= $users['profile_pic'] ?>"
                                                alt="<?= $users['username'] ?>" height="40" class="rounded-circle border">
                                        </div>
                                        <div>&nbsp;&nbsp;</div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="?u=<?= $users['username'] ?>" class="text-decoration-none text-dark">
                                                <h6 style="margin: 0px;font-size: small;">
                                                    <?= $users['f_name'] ?>
                                                    <?= $users['l_name'] ?>
                                                    <?php if ($users['blue_tick']) {

                                                        echo "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>";
                                                    } ?>
                                                </h6>
                                            </a>
                                            <p style="margin:0px;font-size:small" class="text-muted">@
                                                <?= $users['username'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <?= $followBtn ?>

                                    </div>
                                </div>
                                <?php
                            }
                            if (count($likes) < 1) {
                                echo "<p class='text-danger p-2 bg-white border rounded text-center'><i class='bi bi-x-circle'></i> No Likes Availbale </p>";
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div> <!-- for like list -->


        <?php }
        if (count($posts) < 1) { ?>
            <div class="container mt-4">
                <div class="justify-content-center">

                    <div class="bg-white border text-center p-4 rounded">
                        <h5 class="mb-3">Follow Someone or Add a New Post</h5>
                        <p class="lead " data-bs-toggle="modal" data-bs-target="#addpost" style="cursor:pointer">
                            <i class="bi bi-plus-lg"></i> Add a new post
                        </p>
                    </div>

                </div>
            </div>
        <?php }
        ?>



    </div>

    <div class="col-4 mt-4 p-3 image_container">
        <a href="?u=<?= $user['username'] ?>" class="text-decoration-none text-dark">
            <div class="d-flex align-items-center p-2">
                <div><img src="assets/images/profile/<?= $user['profile_pic'] ?>" alt="profile_pic" height="60"
                        class="rounded-circle border">
                </div>
                <div>&nbsp;&nbsp;&nbsp;</div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h6 style="margin: 0px;">
                        <?= $user['f_name'] . " " . $user['l_name'] ?>
                        <?php if ($user['blue_tick'] == 1) {
                            echo "<sup> <i class='bi bi-check-circle-fill blue_tick'></i></sup>";
                        } ?>
                    </h6>
                    <p style="margin:0px;" class="text-muted">@
                        <?= $user['username'] ?>
                    </p>
                </div>
            </div>
        </a>
        <div>
            <h6 class="text-muted p-2 ">You Can Follow Them</h6>
          
            <?php foreach ($follow_suggetions as $users) { ?>
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?= $users['profile_pic'] ?>" loading="lazy" alt="<?= $users['username'] ?>"
                                height="40" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href="?u=<?= $users['username'] ?>" class="text-decoration-none text-dark">
                                <h6 style="margin: 0px;font-size: small;">
                                    <?= $users['f_name'] ?>
                                    <?= $users['l_name'] ?>
                                    <?php if ($users['blue_tick'] == 1) {
                                        echo "<sup> <i class='bi bi-check-circle-fill blue_tick'></i></sup>";
                                    } ?>
                                </h6>
                            </a>
                            <p style="margin:0px;font-size:small" class="text-muted">@
                                <?= $users['username'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-primary FollowBtn" data-user-id="<?= $users['id'] ?>">Follow</button>

                    </div>
                </div>
            <?php }
            if (count($follow_suggetions) < 1) {
                echo "<p class='text-success p-2 bg-white border rounded text-center'><i class='bi bi-check-circle-fill'></i> No suggestions for you </p>";
            } ?>



        </div>
    </div>
</div>