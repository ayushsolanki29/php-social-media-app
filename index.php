<?php
require_once 'assets/php/functions.php';

if (isset($_COOKIE['rememberme'])) {
    $token = mysqli_real_escape_string($db, $_COOKIE['rememberme']);
    $query = "SELECT * FROM rememberme_tokens WHERE token = '$token' AND expiration > NOW()";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $_SESSION['Auth'] = true;
        $_SESSION['userdata'] = getUserData($user_id);
    } else {
        echo "<script>alert('Login Session is ended Please Login Again')</script>";
        setcookie("rememberme", "", time() - 3600, "/"); // Clear cookie
    }
}


if (isset($_SESSION['Auth'])) {
    $user = getUserData($_SESSION['userdata']['id']);
    $posts = gettingHomePagePosts();
    $follow_suggetions = filterFollowSuggetions();
}
$pageCount = count($_GET);

if (isset($_SESSION['Auth']) && $user['ac_status'] == 1 && !$pageCount) {
    showPage('header', ['page_title' => 'Secret Space - Home']);
    showPage('navbar');
    showPage('home');
} elseif (isset($_SESSION['Auth']) && $user['ac_status'] == 0 && !$pageCount) {
    showPage('header', ['page_title' => 'Verify Your Email - Secret Space']);
    showPage('verify_email');
} elseif (isset($_SESSION['Auth']) && $user['ac_status'] == 2 && !$pageCount) {
    showPage('header', ['page_title' => 'Blocked - Secret Space']);
    showPage('blocked');
} elseif (isset($_SESSION['Auth']) && isset($_GET['editprofile']) && $user['ac_status'] == 1) {
    showPage('header', ['page_title' => 'editprofile - Secret Space']);
    showPage('navbar');
    showPage('editprofile');
} elseif (isset($_SESSION['Auth']) && isset($_GET['explore']) && $user['ac_status'] == 1) {
    showPage('header', ['page_title' => 'explore - Secret Space']);
    showPage('navbar');
    showPage('explore');
} elseif (isset($_SESSION['Auth']) && isset($_GET['u']) && $user['ac_status'] == 1) {
    $profile = getUserdataByusername($_GET['u']);
    if (!$profile) {
        showPage('header', ['page_title' => 'user not Found - Secret Space']);
        showPage('navbar');
        showPage('user-not-found');
    } else {
        $profile_post = gettingPostsByID($profile['id']);
        $profile['follower'] = getFollowersCount($profile['id']);
        $profile['following'] = getFollowingCount($profile['id']);
        showPage('header', ['page_title' => $profile['f_name'] . "'s profile - Secret Space"]);
        showPage('navbar');
        showPage('profile');
    }

} elseif (isset($_GET['signup'])) {
    showPage('header', ['page_title' => 'Secret Space - signup']);
    showPage('signup');
} elseif (isset($_GET['login'])) {
    showPage('header', ['page_title' => 'Secret Space - login']);
    showPage('login');
} elseif (isset($_GET['forgot_password'])) {
    showPage('header', ['page_title' => 'Secret Space - forgot_password']);
    showPage('forgot_password');
} else {
    if (isset($_SESSION['Auth']) && $user['ac_status'] == 1) {
        showPage('header', ['page_title' => 'Secret Space - Home']);
        showPage('navbar');
        showPage('home');
    } elseif (isset($_SESSION['Auth']) && $user['ac_status'] == 0) {
        showPage('header', ['page_title' => 'Verify Your Email - Secret Space']);
        showPage('verify_email');
    } elseif (isset($_SESSION['Auth']) && $user['ac_status'] == 2) {
        showPage('header', ['page_title' => 'Blocked - Secret Space']);
        showPage('blocked');
    } else {
        showPage('header', ['page_title' => 'Secret Space - login']);
        showPage('login');
    }

}



showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);

?>