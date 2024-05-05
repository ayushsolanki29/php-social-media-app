<?php
require_once 'config.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Database is Not Conneted :(");

 

//function for showing Pages
function showPage($page, $data = "")
{
    include("assets/pages/$page.php");
}
//function for blocking the user
function checkLikeStatus($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM likes WHERE user_id=$current_user && post_id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}

function blockUser($blocked_user_id)
{
    global $db;
    $cu = getUserData($_SESSION['userdata']['id']);
    $current_user = $_SESSION['userdata']['id'];
    $query = "INSERT INTO block_list(user_id,blocked_user_id) VALUES($current_user,$blocked_user_id)";

    createNotification($cu['id'], $blocked_user_id, "blocked you");
    $query2 = "DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$blocked_user_id";
    mysqli_query($db, $query2);
    $query3 = "DELETE FROM follow_list WHERE follower_id=$blocked_user_id && user_id=$current_user";
    mysqli_query($db, $query3);


    return mysqli_query($db, $query);

}

function searchUser($keyword)
{
    global $db;
    $query = "SELECT * FROM users WHERE username LIKE '%" . $keyword . "%' || (f_name LIKE '%" . $keyword . "%' || l_name LIKE '%" . $keyword . "%') LIMIT 5";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}

//for unblocking the user
function unblockUser($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "DELETE FROM block_list WHERE user_id=$current_user && blocked_user_id=$user_id";
    createNotification($current_user, $user_id, "Unblocked you !");
    return mysqli_query($db, $query);
}
// for follow the user 
function follow_user($user_id)
{
    global $db;
    $cu = getUserData($_SESSION['userdata']['id']);
    $current_user = $_SESSION['userdata']['id'];
    $query = "INSERT INTO follow_list (follower_id,user_id) VALUES ($current_user, $user_id)";
    createNotification($cu['id'], $user_id, "started following you !");
    return mysqli_query($db, $query);
}
// for unfollow the user 
function unFollow_user($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";

    createNotification($current_user, $user_id, "Unfollowed you !");
    return mysqli_query($db, $query);
}
// for like post 
function getPosterId($post_id)
{
    global $db;
    $query = "SELECT user_id FROM posts WHERE id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['user_id'];

}
function like($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "INSERT INTO likes (post_id,user_id) VALUES ($post_id, $current_user)";

    $poster_id = getPosterId($post_id);

    if ($poster_id != $current_user) {
        createNotification($current_user, $poster_id, "liked your post !", $post_id);
    }
    return mysqli_query($db, $query);
}

function unlike($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "DELETE FROM likes WHERE user_id = $current_user && post_id=$post_id";
    $poster_id = getPosterId($post_id);
    if ($poster_id != $current_user) {
        createNotification($current_user, $poster_id, "unliked your post !", $post_id);
    }
    return mysqli_query($db, $query);
}

function likeStatus($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM likes WHERE user_id = $current_user && post_id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];

}
function deletePost($post_id)
{
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $dellike = "DELETE FROM likes WHERE post_id=$post_id && user_id=$user_id";
    mysqli_query($db, $dellike);
    $delcom = "DELETE FROM comments WHERE post_id=$post_id && user_id=$user_id";
    mysqli_query($db, $delcom);
    $not = "UPDATE notifications SET read_status=2 WHERE post_id=$post_id && to_user_id=$user_id";
    mysqli_query($db, $not);


    $query = "DELETE FROM posts WHERE id=$post_id";
    return mysqli_query($db, $query);
}
function gettingLikesCount($post_id)
{
    global $db;
    $query = "SELECT * FROM likes WHERE post_id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}

//for comments
function comments($post_id, $comment)
{
    global $db;
    $comment = mysqli_real_escape_string($db, $comment);
    $current_user = $_SESSION['userdata']['id'];
    $query = "INSERT INTO comments (post_id,user_id,comment) VALUES ($post_id, $current_user,'$comment')";
    $poster_id = getPosterId($post_id);

    if ($poster_id != $current_user) {
        createNotification($current_user, $poster_id, "commented on your post", $post_id);
    }
    return mysqli_query($db, $query);
}
function gettingCommentsCount($post_id)
{
    global $db;
    $query = "SELECT * FROM comments WHERE post_id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//showing error
function showError($field)
{
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        if (isset($error['field']) && $field == $error['field']) {
            ?>
            <div class="alert alert-danger my-2" role="alert">
                <?= $error['msg'] ?>
            </div>
            <?php
        }
    }
}
//show prev form data
function showFormData($field)
{
    if (isset($_SESSION['formdata'])) {
        $formdata = $_SESSION['formdata'];
        return $formdata[$field];
    }
}
//cheking for dublicate email
function isEmailRegistered($email)
{
    global $db;
    $query = "SELECT COUNT(*) AS row FROM users WHERE email='$email'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

//cheking for dublicate user
function isUserRegistered($user)
{
    global $db;
    $query = "SELECT COUNT(*) AS row FROM users WHERE username='$user'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
function isUserRegisteredByOther($user)
{
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $query = "SELECT COUNT(*) AS row FROM users WHERE username='$user' && id!='$user_id'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

// For validating the Signup Form
function validateSignUpForm($form_data)
{
    $response = array();
    $response['status'] = true;

    // Check password
    if (!$form_data['password'] || strlen($form_data['password']) < 6) {
        $response['msg'] = "Password should be at least 6 characters long!";
        $response['status'] = false;
        $response['field'] = "password";
    }

    // Check username length
    if (!$form_data['username'] || strlen($form_data['username']) < 2 || strlen($form_data['username']) > 15) {
        $response['msg'] = "Username should be between 2 and 15 characters!";
        $response['status'] = false;
        $response['field'] = "username";
    }

    // Check email
    if (!$form_data['email']) {
        $response['msg'] = "Email is not given!";
        $response['status'] = false;
        $response['field'] = "email";
    }

    // Check last name
    if (!$form_data['l_name'] || $form_data['f_name'] === $form_data['l_name']) {
        $response['msg'] = "Last Name is required and should be different from First Name!";
        $response['status'] = false;
        $response['field'] = "l_name";
    }

    // Check first name
    if (!$form_data['f_name']) {
        $response['msg'] = "First Name is not given!";
        $response['status'] = false;
        $response['field'] = "f_name";
    }

    // Check if email is already registered
    if (isEmailRegistered($form_data['email'])) {
        $response['msg'] = "Email ID is already in use";
        $response['status'] = false;
        $response['field'] = "email";
    }

    // Check if username is already taken
    if (isUserRegistered($form_data['username'])) {
        $response['msg'] = "Username is already taken!";
        $response['status'] = false;
        $response['field'] = "username";
    }

    return $response;
}

// for checking login user
function checkUser($login_data)
{
    global $db;

    $username_email = mysqli_real_escape_string($db, $login_data['username_email']);
    $password = md5($login_data['password']);

    $query = "SELECT * FROM users WHERE (email='$username_email' OR username='$username_email')";

    // Execute the query
    $run = mysqli_query($db, $query);

    // Check for query execution errors
    if (!$run) {
        return array('error' => 'Query execution error: ' . mysqli_error($db));
    }

    // Fetch the user data
    $data['user'] = mysqli_fetch_assoc($run) ?? array();

    // Check if user exists
    if (count($data['user']) > 0) {
        // Check if the password matches
        if ($data['user']['password'] == $password) {
            $data['status'] = true;
        } else {
            // Password doesn't match
            $data['status'] = false;
            $data['msg'] = "Incorrect password. Please try again.";
        }
    } else {
        // User doesn't exist
        $data['status'] = false;
        $data['msg'] = "User with the provided email/username doesn't exist.";
    }

    return $data;
}

//for getting userdata from id
function getUserData($user_id)
{
    global $db;
    $query = "SELECT * FROM users WHERE id='$user_id'";
    
    // Execute the query
   
    $result = mysqli_query($db, $query);
    // Check if user exists
    if(mysqli_num_rows($result) == 0) {
        $query1 = "SELECT * FROM users WHERE id='31'";
        $result1 = mysqli_query($db, $query1);
        return mysqli_fetch_assoc($result1);
    } else {
        return mysqli_fetch_assoc($result);
    }
}

function getUserdataByusername($username)
{
    global $db;
    $query = "SELECT * FROM users WHERE username='$username'";
    // Execute the query
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run);
}


// For validating the Login Form
function validateLoginForm($form_data)
{
    $response = array();
    $response['status'] = true;
    $blank = false;

    if (empty($form_data['password']) || strlen($form_data['password']) < 6) {
        $response['msg'] = "Password should be at least 6 characters long!";
        $response['status'] = false;
        $response['field'] = "password";
        $blank = true;
    }

    if (!$form_data['username_email']) {
        $response['msg'] = "Username or Email is not given!";
        $response['status'] = false;
        $response['field'] = "username_email";
        $blank = true;
    }

    if (!$blank) {
        $userData = checkUser($form_data);

        if (!$userData['status']) {
            if (empty($userData['user'])) {
                $response['msg'] = "Something is not correct, we can't find you!";
                $response['field'] = "checkuser";
            } else {
                $response['msg'] = $userData['msg'];
            }
            $response['status'] = false;
        } else {
            $response['user'] = $userData['user'];
        }
    }

    return $response;
}




// Creating new user
function createUser($data)
{
    global $db;

    $f_name = mysqli_real_escape_string($db, $data['f_name']);
    $l_name = mysqli_real_escape_string($db, $data['l_name']);
    $gender = $data['gender'];
    $email = mysqli_real_escape_string($db, $data['email']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $password = mysqli_real_escape_string($db, $data['password']);

    // Use password_hash to securely hash the password
    $hashed_password = md5($password);

    $query = "INSERT INTO `users`(`f_name`, `l_name`, `gender`, `email`, `username`, `password`) VALUES ('$f_name','$l_name',$gender,'$email','$username','$hashed_password')";
    return mysqli_query($db, $query);
}

//verify email
function verifyEmail($email)
{
    global $db;
    $query = "UPDATE users SET ac_status=1 WHERE email = '$email'";
    return mysqli_query($db, $query);

}
function changepassword($email, $password)
{
    global $db;
    $password = md5($password);
    $query = "UPDATE users SET password='$password' WHERE email = '$email'";
    return mysqli_query($db, $query);

}

// For validating the Signup Form
function validateUpdateForm($form_data, $image_data)
{
    $response = array();
    $response['status'] = true;


    if (!$form_data['username']) {
        $response['msg'] = "username is Not Given !";
        $response['status'] = false;
        $response['field'] = "username";
    }

    if (!$form_data['l_name']) {
        $response['msg'] = "Last Name is Not Given !";
        $response['status'] = false;
        $response['field'] = "l_name";
    }
    if (!$form_data['f_name']) {
        $response['msg'] = "Fisrt Name is Not Given !";
        $response['status'] = false;
        $response['field'] = "f_name";
    }

    if (isUserRegisteredByOther($form_data['username'])) {
        $response['msg'] = $form_data['username'] . " is Already Taken!";
        $response['status'] = false;
        $response['field'] = "username";
    }

    if ($image_data['name']) {
        $image = basename($image_data['name']);
        $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $size = $image_data['size'] / 1000;

        if ($type != 'jpg' && $type != 'jpeg' && $type != 'png') {
            $response['msg'] = "only JPG,JPEG,PNG Images are Allowed";
            $response['status'] = false;
            $response['field'] = "profile_pic";
        }
        if ($size > 3000) {
            $response['msg'] = "Image Size Should be Less than or equal to 3MB";
            $response['status'] = false;
            $response['field'] = "profile_pic";
        }

    }
    return $response;
}

function updateProfile($form_data, $image_data)
{
    global $db;
    $f_name = mysqli_real_escape_string($db, $form_data['f_name']);
    $l_name = mysqli_real_escape_string($db, $form_data['l_name']);
    $username = mysqli_real_escape_string($db, $form_data['username']);
    $password = md5(mysqli_real_escape_string($db, $form_data['password']));
    $user_id = $_SESSION['userdata']['id'];

    if (!$form_data['password']) {
        $password = $_SESSION['userdata']['password'];
    } else {
        $_SESSION['userdata']['password'] = $password;
    }

    $profile_pic = "";
    if ($image_data['name']) {
        $image_name = time() . basename($image_data['name']);
        $image_target = "../images/profile/$image_name";
        move_uploaded_file($image_data['tmp_name'], $image_target);
        $profile_pic = ", profile_pic = '$image_name'";
    }

    $query = "UPDATE users SET f_name = '$f_name', l_name = '$l_name', username = '$username', password = '$password' $profile_pic WHERE id='$user_id'";

    return mysqli_query($db, $query);
}
function validatePost($image_data)
{
    $response = array();
    $response['status'] = true;

    if (!$image_data['name']) {
        $response['msg'] = "no Image is Selected";
        $response['status'] = false;
        $response['field'] = "post_image";
    }

    if ($image_data['name']) {
        $image = basename($image_data['name']);
        $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $size = $image_data['size'] / 1000;

        if ($type != 'jpg' && $type != 'jpeg' && $type != 'png') {
            $response['msg'] = "only JPG,JPEG,PNG Images are Allowed";
            $response['status'] = false;
            $response['field'] = "post_image";
        }
        if ($size > 3000) {
            $response['msg'] = "Image Size Should be Less than or equal to 3MB";
            $response['status'] = false;
            $response['field'] = "post_image";
        }

    }
    return $response;
}
function createPost($text, $image)
{
    global $db;

    $post_text = mysqli_real_escape_string($db, $text['post_text']);

    $image_name = time() . basename($image['name']);
    $image_target = "../images/posts/$image_name";
    move_uploaded_file($image['tmp_name'], $image_target);
    $user_id = $_SESSION['userdata']['id'];


    $query = "INSERT INTO `posts`( user_id, post_text,post_img) VALUES ('$user_id', '$post_text','$image_name')";
    return mysqli_query($db, $query);
}

//forgetting posts
function checkBlockStatus($current_user, $user_id)
{
    global $db;

    $query = "SELECT count(*) as row FROM block_list WHERE user_id=$current_user && blocked_user_id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}


function checkBS($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM block_list WHERE (user_id=$current_user && blocked_user_id=$user_id) || (user_id=$user_id && blocked_user_id=$current_user)";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}
//
function gettingPosts()
{
    global $db;
    $query = "SELECT posts.id,posts.user_id, posts.post_img,posts.post_text,posts.created_at, users.f_name,users.l_name,users.username,users.profile_pic,users.blue_tick FROM posts JOIN users ON users.id = posts.user_id ORDER BY id DESC";
    // Execute the query
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//get home Page for post
function gettingHomePagePosts()
{
    $list = gettingPosts();
    $filter_list = array();
    foreach ($list as $post) {
        if (checkFollowStatus($post['user_id']) || $post['user_id'] == $_SESSION['userdata']['id']) {
            $filter_list[] = $post;
        }
    }
    return $filter_list;
}
//get follower count
function getFollowersCount($user_id)
{
    global $db;
    $query = "SELECT * FROM follow_list WHERE user_id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//get Following count
function getFollowingCount($user_id)
{
    global $db;
    $query = "SELECT * FROM follow_list WHERE follower_id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
// Get Mutual Friends Count


function gettingPostsByID($user_id)
{
    global $db;
    $query = "SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC";
    // Execute the query
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//filtering the suggetion list
function filterFollowSuggetions()
{
    $list = gettingUsersForSuggetions();

    // Randomize the order of the users
    shuffle($list);

    $filter_list = array();

    foreach ($list as $user) {
        if (!checkFollowStatus($user['id']) && !checkBS($user['id']) && count($filter_list) < 5) {
            $filter_list[] = $user;
        }
    }

    return $filter_list;
}

function checkFollowStatus($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM follow_list WHERE follower_id = $current_user && user_id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}
function gettingUsersForSuggetions()
{
    global $db;

    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM users WHERE id !=$current_user LIMIT 7";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}

//notification
function getNotifications()
{
    $cu_user_id = $_SESSION['userdata']['id'];

    global $db;
    $query = "SELECT * FROM notifications WHERE to_user_id=$cu_user_id ORDER BY id DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
function createNotification($from_user_id, $to_user_id, $msg, $post_id = 0)
{
    global $db;
    $query = "INSERT INTO notifications(from_user_id,to_user_id,message,post_id) VALUES($from_user_id,$to_user_id,'$msg',$post_id)";
    mysqli_query($db, $query);
}
function getUnreadNotificationsCount()
{
    $cu_user_id = $_SESSION['userdata']['id'];
    global $db;
    $query = "SELECT count(*) as row FROM notifications WHERE to_user_id=$cu_user_id && read_status=0 ORDER BY id DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}

function show_time($time)
{
    return '<time style="font-size:small" class="timeago text-muted text-small" datetime="' . $time . '"></time>';
}
function gettime($date)
{
    return date('H:i - (F jS, Y )', strtotime($date));
}
function setNotificationStatusAsRead()
{
    $cu_user_id = $_SESSION['userdata']['id'];
    global $db;
    $query = "UPDATE notifications SET read_status=1 WHERE to_user_id=$cu_user_id";
    return mysqli_query($db, $query);
}

//for getting ids of chat users

function getActiveChatUserIds()
{
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT from_user_id,to_user_id FROM messages WHERE to_user_id=$current_user_id || from_user_id=$current_user_id ORDER BY id DESC";
    $run = mysqli_query($db, $query);
    $data = mysqli_fetch_all($run, true);
    $ids = array();
    foreach ($data as $ch) {
        if ($ch['from_user_id'] != $current_user_id && !in_array($ch['from_user_id'], $ids)) {
            $ids[] = $ch['from_user_id'];
        }

        if ($ch['to_user_id'] != $current_user_id && !in_array($ch['to_user_id'], $ids)) {
            $ids[] = $ch['to_user_id'];
        }

    }

    return $ids;
}
function getMessages($user_id)
{
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM messages WHERE (to_user_id=$current_user_id && from_user_id=$user_id) || (from_user_id=$current_user_id && to_user_id=$user_id) ORDER BY id DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
function sendmessage($user_id, $msg)
{
    global $db;
    $msg = mysqli_escape_string($db,$msg);
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "INSERT INTO messages (from_user_id,to_user_id,msg) VALUES($current_user_id, $user_id, '$msg')";
    updateMsgReadStatus($user_id);
    return mysqli_query($db, $query);

}
function getAllMessages()
{
    $active_chat_ids = getActiveChatUserIds();
    $conversation = array();
    foreach ($active_chat_ids as $index => $id) {
        $conversation[$index]['user_id'] = $id;
        $conversation[$index]['messages'] = getMessages($id);
    }
    return $conversation;
}
function getNewCount()
{
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT COUNT(*) as row FROM messages WHERE to_user_id=$current_user_id && read_status=0";
    $result = mysqli_query($db, $query);
    return mysqli_fetch_assoc($result)['row'];
}

function updateMsgReadStatus($user_id)
{
    $cu_user_id = $_SESSION['userdata']['id'];
    global $db;
    $query = "UPDATE messages SET read_status=1 WHERE to_user_id=$cu_user_id && from_user_id=$user_id";
    return mysqli_query($db, $query);
}
?>