<?php
require_once 'functions.php';
require_once 'send_code.php';

// signup manages 
if (isset($_GET['signup'])) {
    $response = validateSignUpForm($_POST);

    if ($response['status']) {
        if (createUser($_POST)) {
            header('Location: ../../?login=success');
            exit(); // Always exit after a header redirect
        } else {
            // Handle database error
            // Log the error or display a generic error page
            header('Location: ../../?error=database');
            exit();
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("Location: ../../?signup");
        exit();
    }
}
if (isset($_GET['login'])) {
    if (isset($_GET['newuser'])) {
        $username=  $_POST['username'];
     }
    $response = validateLoginForm($_POST);
 
    // if (isset($_POST['rememberme'])) {
    //     $user_id = $response['user']['id'];
    //     $token = bin2hex(random_bytes(32));
    //     $expiration = date('Y-m-d H:i:s', strtotime('+30 days'));
    //     $insertQuery = "INSERT INTO rememberme_tokens (user_id, token, expiration) VALUES ($user_id, '$token', '$expiration')";
    //     $run = mysqli_query($db, $insertQuery);
    //     if ($run) {
    //         setcookie("rememberme", $token, strtotime('+30 days'), '/', '', false, true); // Setting cookie
    //     } else {
    //         echo "<script>alert('Error while login please try again')</script>";
    //     }
    // }

    if ($response['status']) {
        $_SESSION['Auth'] = true;
        $_SESSION['userdata'] = $response['user'];

        if ($response['user']['ac_status'] == 0) {
            $_SESSION['otp'] = $otp = rand(111111, 999999);

            sendOtp($response['user']['email'], 'Verify Your Email', $otp,$response['user']['username'], gettime($response['user']['created_at']) );
            header("Location: ../../?verificationmsg=Code sended on Your Email");
        }
        header("Location: ../../");
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("Location: ../../?login");
        exit();
    }
}


if (isset($_GET['resend_code'])) {
    $_SESSION['otp'] = $otp = rand(111111, 999999);
    sendOtp($_SESSION['userdata']['email'], 'Verify Your Email', $otp,$_SESSION['userdata']['username'],gettime($_SESSION['userdata']['created_at']));
    header('location:../../?verificationmsg=Your Code is Resended Successfully');
}

if (isset($_GET['verify_email'])) {
    $user_code = $_POST['code'];
    if ($user_code == $_SESSION['otp']) {
        if (verifyEmail($_SESSION['userdata']['email'])) {
            header("Location: ../../");
        } else {
            $response['msg'] = "Somtthing went wrong , try again Later";
            $response['field'] = "email_verify";

            $_SESSION['error'] = $response;
            header("Location: ../../");
        }

    } else {
        $response['msg'] = "Invalid Verification Code!";
        if (empty($_POST['code'])) {

            $response['msg'] = "Enter Your 6 Digit Code";
        }
        $response['field'] = "email_verify";

        $_SESSION['error'] = $response;
        header("Location: ../../");
        exit();
    }
}
if (isset($_GET['forgot_password'])) {
    if (!$_POST['email']) {
        $response['msg'] = "Enter Your Email ID First";
        $response['field'] = "email";
        $_SESSION['error'] = $response;
        header('location:../../?forgot_password');
    } elseif (!isEmailRegistered($_POST['email'])) {
        $response['msg'] = "Email ID is Not Registered";
        $response['field'] = "email";
        $_SESSION['error'] = $response;
        header('location:../../?forgot_password');
    } else {
        $_SESSION['forgot_otp'] = $otp = rand(111111, 999999);
        //current time
        $time = date('Y-m-d H:i:s', time());
        sendOtp($_POST['email'], 'Forgot Your Password', $otp, $_POST['email'],$time);
        $_SESSION['forget_email'] = $_POST['email'];
        header('location:../../?forgot_password&verificationmsg=Your Code is sended Successfully');
    }
}


//verify forgot code
if (isset($_GET['verifycode'])) {
    $user_code = $_POST['code'];
    if ($user_code == $_SESSION['forgot_otp']) {
        $_SESSION['Auth_temp'] = true;
        header("Location: ../../?forgot_password");
    } else {
        $response['msg'] = "Invalid Verification Code!";
        if (empty($_POST['code'])) {
            $response['msg'] = "Enter Your 6 Digit Code";
        }
        $response['field'] = "email";
        $_SESSION['error'] = $response;
        header("Location: ../../?forgot_password");
        exit();
    }
}
if (isset($_GET['changepassword'])) {
    if (!$_POST['password']) {
        $response['msg'] = "Enter Your Passowrd";
        $response['field'] = "email";
        $_SESSION['error'] = $response;
        header('location:../../?forgot_password');
    } else {
        changepassword($_SESSION['forget_email'], $_POST['password']);
        header('location:../../?reseted');
    }

}

if (isset($_GET['updateprofile'])) {
    echo "<pre>";



    $response = validateUpdateForm($_POST, $_FILES['profile_pic']);

    if ($response['status']) {
        if (updateProfile($_POST, $_FILES['profile_pic'])) {
            header("Location: ../../?editprofile&sucess");
            exit();
        } else {
            header("Location: ../../?editprofile&failed");
            exit();
        }
        ;
      
    } else {
        $_SESSION['error'] = $response;
        header("Location: ../../?editprofile&failed");
        exit();
    }

}
if(isset($_GET['block'])){
    $user_id = $_GET['block'];
    $user = $_GET['username']; 
      if(blockUser($user_id)){
          header("location:../../?u=$user");
      }else{
          echo "something went wrong";
      }
  
    
  }
  if(isset($_GET['deletepost'])){
    $post_id = $_GET['deletepost'];
      if(deletePost($post_id)){
          header("location:{$_SERVER['HTTP_REFERER']}");
      }else{
          echo "something went wrong";
      }
  
    
  }
//for manage post
if (isset($_GET['addpost'])) {
    $response = validatePost($_FILES['post_image']);
    if ($response['status']) {
        if (createPost($_POST, $_FILES['post_image'])) {
           header("location:../../?newpostadded");
        }else{
            header("location:../../?faild");
        }
        
    }else{
        $_SESSION['error']= $response;
        header("Location: ../../");
    }
}

//logout function
if (isset($_GET['logout'])) {

    session_destroy();

    setcookie("rememberme", "", time() - 3600, '/');

    // Redirect the user to the homepage
    header("Location: ../../?login");
    exit();
} 

?>