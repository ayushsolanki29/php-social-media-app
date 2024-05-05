<?php
global $profile;
global $user;
global $profile_post;
?>

<div class="container col-9 rounded-0">
<div class="col-md-12 rounded p-4 mt-4 d-flex flex-md-row flex-column gap-5">
    <div class="col-md-4 d-flex justify-content-end align-items-start">
        <img src="assets/images/profile/<?= $profile['profile_pic'] ?>" class="img-thumbnail rounded-circle my-3" style="height:170px;" alt="...">
    </div>
    <div class="col-md-8">
        <div class="d-flex flex-column">
            <div class="d-flex flex-md-row flex-column gap-5 align-items-center">
                <span style="font-size: xx-large;">
                    <?= $profile['f_name'] . " " . $profile['l_name'] . ($profile['blue_tick'] ? "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>" : '') ?>
                </span>
                <?php if (($user['id'] != $profile['id'] && !checkBS($profile['id']))) { ?>
                    <div class="dropdown">
                        <span style="font-size:xx-large" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#chatbox" onclick="popchat(<?= $profile['id'] ?>)"><i class="bi bi-chat-fill"></i> Message</a></li>
                            <li><a class="dropdown-item" href="assets/php/actions.php?block=<?= $profile['id'] ?>&username=<?= $profile['username'] ?>"><i class="bi bi-x-circle-fill"></i> Block</a></li>
                        </ul>
                    </div>
                <?php } elseif ($user['id'] == $profile['id']) { ?>
                    <div class="dropdown">
                        <span style="font-size:xx-large" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="?editprofile"><i class="bi bi-pen"></i> Edit Profile</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <span style="font-size: larger;" class="text-secondary">@<?= $profile['username'] ?></span>

            <?= (!checkBS($profile['id'])) ?
                '<div class="d-flex gap-2 align-items-center my-3">
                    <a class="btn btn-sm btn-info"><i class="bi bi-file-post-fill"></i>' . count($profile_post) . ' Posts</a>
                    <a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#FollowersList"><i class="bi bi-people-fill"></i>' . count($profile['follower']) . ' Followers</a>
                    <a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#FollowingList"><i class="bi bi-person-fill"></i>' . count($profile['following']) . ' Following</a>
                </div>' : '' ?>

            <?php
            if ($user['id'] != $profile['id']) {
                echo '<div class="d-flex gap-2 align-items-center my-1">';
                if (checkBlockStatus($user['id'], $profile['id'])) {
                    echo '<button class="btn btn-sm btn-danger unblockbtn" data-user-id="' . $profile['id'] . '">Unblock</button>';
                } elseif (checkBlockStatus($profile['id'], $user['id'])) {
                    echo '<div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-octagon-fill"></i> @' . $profile['username'] . ' blocked you !
                        </div>';
                } elseif (checkFollowStatus($profile['id'])) {
                    echo '<button class="btn btn-sm btn-danger unFollowBtn" data-user-id="' . $profile['id'] . '">Unfollow</button>';
                } else {
                    echo '<button class="btn btn-sm btn-primary FollowBtn" data-user-id="' . $profile['id'] . '">Follow</button>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>



    <div class="head-of-post">
        <h3 class="display-6 font-weight-bold">Latest Posts</h3>
        <div class="my-3">
            <hr class="border-top-2 border-primary">
        </div>
    </div>

    <?php
    if(checkBS($profile['id'])){
        $profile_post = array();
    
       ?>
     <div class="alert alert-secondary text-center" role="alert">
        <i class="bi bi-x-octagon-fill"></i> You are not allowed to see posts !
    </div>
       <?php
        
    }elseif (count($profile_post) < 1) {
        ?>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="bg-white border text-center p-4 rounded">
                        <h5 class="mb-3">
                            <?php
                            if ($user['id'] != $profile['id']) {
                                echo $profile['f_name'] . " Doesn't Have Any Post";
                            } else {
                                echo "You Don't Have Any Post";
                            }
                            ?>
                        </h5>
                        <?php
                        if ($user['id'] == $profile['id']) {
                            // Display the "Add a new post" link only for the user's own account
                            ?>
                            <p class="lead" data-bs-toggle="modal" data-bs-target="#addpost" style="cursor:pointer">
                                <i class="bi bi-plus-lg"></i> Add a new post
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="gallery d-flex flex-wrap mt-3 gap-2 mb-4">
        <br>
        <?php foreach ($profile_post as $post) { 
             $likes = gettingLikesCount($post['id']); 
             $comments = gettingCommentsCount($post['id']); ?>
            <img src="assets/images/posts/<?= $post['post_img'] ?>" width="300px" data-bs-toggle="modal" data-bs-target="#postview<?=$post['id']?>" class="rounded" />
            <!-- Modal -->
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
                                    <img src="assets/images/profile/<?= $user['profile_pic'] ?>" alt="" height="50"
                                        width="50" class="rounded-circle border">
                                    <div class="ms-3">
                                        <h6 class="mb-0">
                                            <?= $user['f_name'] ?>
                                            <?= $user['l_name'] ?>

                                            <?php if ($user['blue_tick']) {

                                                echo "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>";
                                            } ?>
                                        </h6>
                                        <p class="text-muted mb-0">@
                                            <?= $user['username'] ?>
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
            
            
        <?php } ?>
    </div>
</div>

<!-- For Followers List  -->
<div class="modal fade" id="FollowersList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addposttitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Followers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                foreach ($profile['follower'] as $f) {
                    $users = getUserData($f['follower_id']);
                    $followBtn = "";
                    if (checkFollowStatus($f['follower_id'])) {
                        $followBtn = '<button class="btn btn-sm btn-danger unFollowBtn" data-user-id=' . $users['id'] . '>Unfollow</button>';
                    } elseif ($user['id'] == $f['follower_id']) {
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
                                        <?= $users['l_name'] ?><?php if ($users['blue_tick']) {
                        
                        echo "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>";
                        }?>
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
                if (count($profile['follower']) < 1) {
                    echo "<p class='text-danger p-2 bg-white border rounded text-center'><i class='bi bi-x-circle'></i> No Follower Availbale</p>";
                }
                ?>

            </div>

        </div>
    </div>
</div>

<!-- For Following List  -->
<div class="modal fade" id="FollowingList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addposttitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Following</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                foreach ($profile['following'] as $f) {
                    $users = getUserData($f['user_id']);
                    $followBtn = "";
                    if (checkFollowStatus($f['user_id'])) {
                        $followBtn = '<button class="btn btn-sm btn-danger unFollowBtn" data-user-id=' . $users['id'] . '>Unfollow</button>';
                    } elseif ($user['id'] == $f['user_id']) {
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
                                        <?= $users['l_name'] ?><?php if ($users['blue_tick']) {
                        
                        echo "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>";
                        }?>
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
                if (count($profile['following']) < 1) {
                    echo "<p class='text-danger p-2 bg-white border rounded text-center'><i class='bi bi-x-circle'></i> No Following Availbale </p>";
                }
                ?>

            </div>

        </div>
    </div>
</div>