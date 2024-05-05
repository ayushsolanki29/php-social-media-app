<?php
require_once 'functions.php';

if (isset($_GET['sendmessage'])) {
    $msg = mysqli_escape_string($db,$_POST['msg']);
    if (sendmessage($_POST['user_id'], $msg)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }
    echo json_encode($response);
}

if (isset($_GET['getMessages'])) {
    $chats = getAllMessages();
    $chatlist = "";

    foreach ($chats as $chat) {
        $ch_user = getUserData($chat['user_id']);

        $seen = false;

        if ($chat['messages'][0]['read_status'] == 1 || $chat['messages'][0]['from_user_id'] == $_SESSION['userdata']['id']) {
            $seen = true;
        }
        $chatlist .= '<div class="d-flex justify-content-between border-bottom chatlist_item" data-bs-toggle="modal" data-bs-target="#chatbox" onclick="popchat(' . $chat['user_id'] . ')">
        <div class="d-flex align-items-center p-2">
            <div><img src="assets/images/profile/' . $ch_user['profile_pic'] . '" alt="" height="40" width="40" class="rounded-circle border"></div>
            <div>&nbsp;&nbsp;</div>
            <div class="d-flex flex-column justify-content-center">
                <a href="#" class="text-decoration-none text-dark">
                    <h6 style="margin: 0px; font-size: small;">
                        ' . $ch_user['f_name'] . ' ' . $ch_user['l_name'];

        // Check for blue tick and append if present
        if ($ch_user['blue_tick'] == 1) {
            $chatlist .= '<sup class="blue_tick mx-1"><i class="bi bi-check-circle-fill"></i></sup>';
           
                $json['verifyed'] = true;
            } else{
                 $json['verifyed'] = false;
             }
            
        $chatlist .= '</h6></a>
                <p style="margin:0px; font-size: small;" class="">' . $chat['messages'][0]['msg'] . '</p>
                <time style="font-size: small;" class="timeago text-small" datetime="' . $chat['messages'][0]['created_at'] . '">' . gettime($chat['messages'][0]['created_at']) . '</time>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="p-1 bg-primary rounded-circle ' . ($seen ? 'd-none' : '') . '"></div>
        </div>
    </div>';

    }

    $json['chatlist'] = $chatlist;

    if (isset($_POST['chatter_id']) && $_POST['chatter_id'] != 0) {
        $messages = getMessages($_POST['chatter_id']);
        $chatmsg = "";
        if (checkBS($_POST['chatter_id'])) {
            $json['blocked'] = true;
        } else {
            $json['blocked'] = false;
        }
      
        foreach ($messages as $cm) {
            if ($cm['from_user_id'] == $_SESSION['userdata']['id']) {
                $cl1 = "reply-message";
            } else {
                $cl1 = "user-message";
            }
            $chatmsg .= "
            <div class=" . $cl1 . ">
            <p>" . $cm['msg'] . "</p>
            <span class='timestamp'>" . gettime($cm['created_at']) . "</span>
          </div>
           ";
        }
        $json['chat']['msgs'] = $chatmsg;
        $json['chat']['userdata'] = getUserData($_POST['chatter_id']);
    } else {

        $json['chat']['msgs'] = "<div class='spinner-border text-center' role='status'> </div>";
    }

    $json['newmsg_count'] = getNewCount();
    echo json_encode($json);

}

if (isset($_GET['notread'])) {
    if (setNotificationStatusAsRead()) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }

    echo json_encode($response);
}
if (isset($_GET['follow'])) {
    $user_id = $_POST['user_id'];
    if (follow_user($user_id)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }
    echo json_encode($response);
}

if (isset($_GET['unFollow'])) {
    $user_id = $_POST['user_id'];
    if (unFollow_user($user_id)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }
    echo json_encode($response);
}

if (isset($_GET['like'])) {
    $post_id = $_POST['post_id'];

    if (!likeStatus($post_id)) {
        if (like($post_id)) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }
    }

    echo json_encode($response);
}

if (isset($_GET['unlike'])) {
    $post_id = $_POST['post_id'];

    if (likeStatus($post_id)) {
        if (unlike($post_id)) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }
    }

    echo json_encode($response);
}
if (isset($_GET['addcomment'])) {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    if (comments($post_id, $comment)) {
        $cuser = getUserData($_SESSION['userdata']['id']);
        $response['status'] = true;
        $response['comment'] = ' <div class="d-flex align-items-center p-2">
        <div><img src="assets/images/profile/' . $cuser['profile_pic'] . '" alt="" height="40" class="rounded-circle border">
        </div>
        <div>&nbsp;&nbsp;&nbsp;</div>
        <div class="d-flex flex-column justify-content-start align-items-start">
          <a href="?u=' . $cuser['username'] . '" class="text-decoration-none text-dark"> <h6 style="margin: 0px;">@' . $cuser['username'] . '</h6></a> 
            <p style="margin:0px;" class="text-muted">' . $comment . '</p>
        </div>     
    </div>';
    } else {
        $response['status'] = false;

    }

    echo json_encode($response);
}

if (isset($_GET['search'])) {
    $response = array(); // Initialize response array

    // Check if the keyword is set and not empty
    if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
        $keyword = $_POST['keyword'];

        // Assuming searchUser returns an array of users based on the keyword
        $data = searchUser($keyword);

        if (count($data) > 0) {
            $response['status'] = true;
            $users = '';

            foreach ($data as $fuser) {
                $fbtn = ''; // Initialize fbtn (assuming it's a button related to each user)

                $users .= '<div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center p-2">
                                    <div><img src="assets/images/profile/' . $fuser['profile_pic'] . '" alt="" height="40" class="rounded-circle border"></div>
                                    <div>&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="?u=' . $fuser['username'] . '" class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;">' . $fuser['f_name'] . ' ' . $fuser['l_name'] . '</h6></a>
                                        <p style="margin:0px;font-size:small" class="text-muted">@' . $fuser['username'] . '</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    ' . $fbtn . '
                                </div>
                            </div>';
            }

            $response['users'] = $users;
        } else {
            $response['status'] = false;
        }
    } else {
        $response['status'] = false; // No keyword provided
    }

    // Output the JSON response
    echo json_encode($response);
}




if (isset($_GET['unblock'])) {
    $user_id = $_POST['user_id'];
    if (unblockUser($user_id)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }

    echo json_encode($response);
}
?>