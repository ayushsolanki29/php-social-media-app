<?php global $user; ?>




<nav class="navbar navbar-expand-lg navbar-light bg-white border">
    <div class="container-fluid">

        <!-- Logo and Search Form -->
        <div class="navbar-brand">
            <a href="?">
                <img src="assets/favicon/safari-pinned-tab.svg" alt="logo - secret Space" height="41">
            </a>
        </div>


        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <form class="d-flex position-relative flex-wrap" id="searchform" style="z-index: 22;">
                <input class="form-control me-2" type="search" id="search" placeholder="Looking for someone..."
                    aria-label="Search" autocomplete="off">
                <div class="bg-white rounded border shadow py-3 px-4 mt-5 position-absolute start-0 end-0"
                    id="search_result" data-bs-auto-close="true">
                    <button type="button" class="btn-close position-absolute end-0 p-1"
                        style="padding: 10px !important;" aria-label="Close" id="close_search"></button>
                    <div id="sra" class="text-start">
                        <p class="text-center text-muted">Search...</p>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="?"><i class="bi bi-house-door-fill"></i><span
                            class="nav-icon-text">Home</span> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?explore"><i class="bi bi-collection-fill"></i> Expolore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#addpost"><i
                            class="bi bi-plus-square-fill"></i> Add Post</a>
                </li>
                <li class="nav-item">
                    <?php
                    if (getUnreadNotificationsCount() > 0) {
                        ?>
                        <a class="nav-link position-relative" id="show_not" data-bs-toggle="offcanvas"
                            href="#notification_sidebar" role="button" aria-controls="offcanvasExample">
                            <i class="bi bi-bell-fill"></i> Notifications
                            <span
                                class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
                                <small>
                                    <?= getUnreadNotificationsCount() ?>
                                </small>
                            </span>
                        </a>
                        <?php
                    } else {
                        ?>
                        <a class="nav-link " data-bs-toggle="offcanvas" href="#notification_sidebar" role="button"
                            aria-controls="offcanvasExample"><i class="bi bi-bell-fill"></i> Notifications</a>
                        <?php
                    }
                    ?>
                </li>
                <li class="nav-item">

                    <a class="nav-link" data-bs-toggle="offcanvas" href="#messages_sidebar" role="button"
                        aria-controls="offcanvasExample"><i class="bi bi-chat-right-dots-fill"></i> Messages
                        <span
                            class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger"
                            id="msgcounter">
                        </span></a>

                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/images/profile/<?= $user['profile_pic'] ?>" alt="" height="30"
                            class="rounded-circle border">
                        <?= $user['username'] ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="?u=<?= $user['username'] ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="?editprofile">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="#">Account Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="assets/php/actions.php?logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>