<?php
$expolore = gettingPosts();

global $expolore;
global $user;

?>
<style>
    .photo-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        grid-gap: 10px;
        padding: 20px;
    }

    .photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
        overflow: hidden;
        cursor: pointer;
    }

    .vertical-photo {
        aspect-ratio: 3/4;
        /* Adjust the aspect ratio as needed */
    }

    .horizontal-photo {
        aspect-ratio: 3/4;
        /* Adjust the aspect ratio as needed */
    }

    .lightbox-container {
        z-index: 1000;
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(8px);
    }

    .lightbox-image {
        max-width: 90%;
        max-height: 90%;
    }

    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        color: #fff;
        font-size: 20px;
    }
    .gradient-text {
  background-image: linear-gradient(
    90.65deg, 
    #605DFF 41.17%, 
    #AD63F6 92.13%
  );
  background-size: 100%;
  background-clip: text;
  -webkit-background-clip: text;
  -moz-background-clip: text;
  -webkit-text-fill-color: transparent; 
  -moz-text-fill-color: transparent;
}
.landing-page-section {
  display: flex;
  padding: 22px 8px;
  flex-direction: column;
  align-items: center;
  background: linear-gradient(
    to top,
    rgba(96, 93, 255, 0.1) 0%,
    rgba(96, 93, 255, 0) 100%
  );
  min-height: 100%;
  height: 100%;
}

.landing-page-section > h2 {
  color: var(--text-color);
  text-align: center;
  font-size: 2.5rem;
  margin: 0px;
}
</style>

<div class="container">
        <section class="landing-page-section">
            <h2>Explore <span class="gradient-text">All Posts</span></h2>
        </section>

        <div class="photo-gallery">
    <?php
    $explore = gettingPosts();
    shuffle($explore);
    
    if (!empty($explore)) {
        foreach ($explore as $ex_post) { 
            $likes = gettingLikesCount($ex_post['id']); 
            $comments = gettingCommentsCount($ex_post['id']); ?>

            <img src="assets/images/posts/<?= $ex_post['post_img'] ?>" alt="Photo"  data-bs-toggle="modal" data-bs-target="#postview<?=$ex_post['id']?>" class="photo horizontal-photo">
       
       
       
            <div class="modal fade" id="postview<?= $ex_post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body d-md-flex p-0">
                            <div class="col-md-8 col-sm-12 text-center">
                                <img src="assets/images/posts/<?= $ex_post['post_img'] ?>"
                                    class="img-fluid card-img-top mx-auto" data-bs-toggle="modal"
                                    data-bs-target="#postview<?= $ex_post['id'] ?>" alt="...">
                            </div>
                            <div class="col-md-4 col-sm-12 d-flex flex-column">
                                <div class="d-flex align-items-center p-2 <?= $ex_post['post_text'] ? '' : 'border-bottom' ?>">
                                    <img src="assets/images/profile/<?= $ex_post['profile_pic'] ?>" alt="" height="50"
                                        width="50" class="rounded-circle border">
                                    <div class="ms-3">
                                        <a href="?u=<?= $ex_post['username'] ?>" class="text-dark text-decoration-none">
                                        <h6 class="mb-0">
                                            <?= $ex_post['f_name'] ?>
                                            <?= $ex_post['l_name'] ?>

                                            <?php if ($ex_post['blue_tick']) {

                                                echo "<sup class='blue_tick mx-1'><i class='bi bi-check-circle-fill'></i></sup>";
                                            } ?>
                                        </h6></a>
                                        <p class="text-muted mb-0">@
                                            <?= $ex_post['username'] ?>
                                        </p>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="dropdown">
                                            <?php $likeStatus = likeStatus($ex_post['id']);
                                            $like_btn = $likeStatus ? "none" : "";
                                            $unlike_btn = $likeStatus ? "" : "none";
                                            ?>
                                            <i class="bi bi-heart-fill unlike_btn"
                                                style="font-size:18px; color:red; display: <?= $unlike_btn ?>;"
                                                data-post-id="<?= $ex_post['id'] ?>"></i>
                                            <i class="bi bi-heart like_btn"
                                                style=" font-size:18px;display: <?= $like_btn ?>"
                                                data-post-id="<?= $ex_post['id'] ?>"></i>
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
                                            <?= show_time($ex_post['created_at']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-bottom p-2 <?= $ex_post['post_text'] ? '' : 'd-none' ?>">
                                    <?= $ex_post['post_text'] ?>
                                </div>
                                <div class="flex-fill align-self-stretch overflow-auto"
                                    id="comment-section<?= $ex_post['id'] ?>" style="height: 100px;">
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
       
       
       
       <?php }

        
    } else {
        // Handle the case when $explore is empty or null
        echo "No posts found.";
    }
    ?>
</div>

</div>
 
 