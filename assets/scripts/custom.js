document.querySelector("body").insertAdjacentHTML(
  "beforeend",
  `
    <div class="loader_box">
    <div class="loader">
  <div class="box1"></div>
  <div class="box2"></div>
  <div class="box3"></div>
</div>
    </div>
    `
);

// Remove the loader when the window is fully loaded
window.addEventListener("load", function () {
  const loader = document.querySelector(".loader_box");
  if (loader) {
    loader.remove();
  }
});
//for priview the post image
let input = document.getElementById("select_post_image");
input.addEventListener("change", preview);
function preview() {
  let fileobject = this.files[0];
  let filereader = new FileReader();

  filereader.readAsDataURL(fileobject);
  filereader.onload = function () {
    let image_src = filereader.result;
    let image = document.querySelector("#post_image");
    image.setAttribute("src", image_src);
    image.setAttribute("style", "display:");
  };
}

//for follow the user

$(".FollowBtn").click(function () {
  let user_id_v = $(this).data("userId");
  let button = this;
  $(button).attr("disabled", true);
  $.ajax({
    url: "assets/php/ajax.php?follow",
    method: "post",
    dataType: "json",
    data: { user_id: user_id_v },
    success: function (response) {
      if (response.status) {
        $(button).data("userId", 0);
        $(button).html('<i class="bi bi-check-circle-fill"></i> Following');
      } else {
        $(button).attr("disabled", false);
        alert("something is wrong, try again after some time");
      }
    },
  });
});

$(".unFollowBtn").click(function () {
  let user_id_v = $(this).data("userId");
  let button = this;
  $(button).attr("disabled", true);
  $.ajax({
    url: "assets/php/ajax.php?unFollow",
    method: "post",
    dataType: "json",
    data: { user_id: user_id_v },
    success: function (response) {
      if (response.status) {
        $(button).data("userId", 0);
        $(button).html('<i class="bi bi-check-circle-fill"></i> unFollowed');
      } else {
        $(button).attr("disabled", false);
        alert("something is wrong, try again after some time");
      }
    },
  });
});

$(".like_btn").click(function () {
  let post_id_v = $(this).data("postId");
  let button = this;
  $(button).attr("disabled", true);
  $.ajax({
    url: "assets/php/ajax.php?like",
    method: "post",
    dataType: "json",
    data: { post_id: post_id_v },
    success: function (response) {
      if (response.status) {
        $(button).attr("disabled", false);
        $(button).hide();
        $(button).siblings(".unlike_btn").show();
        location.reload();
      } else {
        $(button).attr("disabled", false);
        alert("something is wrong, try again after some time");
      }
    },
  });
});

$(".unlike_btn").click(function () {
  let post_id_v = $(this).data("postId");
  let button = this;
  $(button).attr("disabled", true);
  $.ajax({
    url: "assets/php/ajax.php?unlike",
    method: "post",
    dataType: "json",
    data: { post_id: post_id_v },
    success: function (response) {
      if (response.status) {
        $(button).attr("disabled", false);
        $(button).hide();
        $(button).siblings(".like_btn").show();
        location.reload();
      } else {
        $(button).attr("disabled", false);
        alert("something is wrong, try again after some time");
      }
    },
  });
});

$(document).on("input", ".comment-input", function () {
  let comment_input = $(this);
  let comment_btn = comment_input.siblings(".add-comment");

  if (comment_input.val().trim() !== "") {
    comment_btn.show();
    comment_btn.attr("disabled", false);
  } else {
    comment_btn.hide();
  }
});

$(".add-comment").click(function () {
  let button = this;
  let post_id_v = $(this).data("postId");
  let cs = $(this).data("cs");
  let page = $(this).data("page");

  let comment_text = $(button).siblings(".comment-input").val();
  if (comment_text == "") {
    return 0;
  }
  $(button).attr("disabled", true);
  $(button).siblings(".comment-input").attr("disabled", true);

  $.ajax({
    url: "assets/php/ajax.php?addcomment",
    method: "post",
    dataType: "json",
    data: { post_id: post_id_v, comment: comment_text },
    success: function (response) {
      if (response.status) {
        $(button).attr("disabled", false);
        $(button).siblings(".comment-input").attr("disabled", false);
        $(button).siblings(".comment-input").val("");
        $("#" + cs).append(response.comment);
        $(".comment_notice").hide();
        if (page == "home") {
          location.reload();
        }
      } else {
        $(button).attr("disabled", false);
        $(button).siblings(".comment-input").attr("disabled", false);
        alert("something is wrong, try again after some time");
      }
    },
  });
});

jQuery(document).ready(function () {
  jQuery("time.timeago").timeago();
});

$("#show_not").click(function () {
  $.ajax({
    url: "assets/php/ajax.php?notread",
    method: "post",
    dataType: "json",
    success: function (response) {
      if (response.status) {
        $(".un-count").hide();
      }
    },
  });
});

$(".unblockbtn").click(function () {
  var user_id_v = $(this).data("userId");
  var button = this;
  $(button).attr("disabled", true);
  $.ajax({
    url: "assets/php/ajax.php?unblock",
    method: "post",
    dataType: "json",
    data: { user_id: user_id_v },
    success: function (response) {
      if (response.status) {
        location.reload();
      } else {
        $(button).attr("disabled", false);

        alert("something is wrong,try again after some time");
      }
    },
  });
});
$("#search_result").hide();
$("#search").focus(function () {
  $("#search_result").show();
});

$("#search").on("blur", function () {
  if ($(this).val().trim() === "") {
    $("#search_result").hide();
  }
});
$("#close_search").click(function () {
  $("#search_result").hide();
});

$("#search").keyup(function () {
  var keyword_v = $(this).val();

  $.ajax({
    url: "assets/php/ajax.php?search",
    method: "post",
    dataType: "json",
    data: { keyword: keyword_v },
    success: function (response) {
      if (response.status) {
        $("#sra").html(response.users);
      } else {
        $("#sra").html('<p class="text-center text-muted">no user found !</p>');
      }
    },
  });
});
var chatting_user_id = 1;

function popchat(user_id) {
  $("#user_chat").html(`<div class="spinner-border text-center" role="status">
</div>`);

  $("#chatter_username").text("loading..");
  $("#chatter_name").text("");
  $("#chatter_pic").attr("src", "assets/images/profile/default.png");
  $("#sendmessage").attr("data-user-id", user_id);
  chatting_user_id = user_id;
}
$("#sendmessage").click(function () {
  var user_id = chatting_user_id;
  var msg = $("#msginput").val();
  if (!msg) {
    return;
  }
  $("#sendmessage").attr("disabled", true);
  $("#msginput").attr("disabled", true);
  $.ajax({
    url: "assets/php/ajax.php?sendmessage",
    method: "post",
    dataType: "json",
    data: { user_id: user_id, msg: msg },
    success: function (response) {
      if (response.status) {
        $("#sendmessage").attr("disabled", false);
        $("#msginput").attr("disabled", false);
        $("#msginput").val("");
      } else {
        alert("something went wrong");
      }
    },
  });
});

function syncmsg() {
  $.ajax({
    url: "assets/php/ajax.php?getMessages",
    method: "post",
    dataType: "json",
    data: { chatter_id: chatting_user_id },
    success: function (response) {
      if (chatting_user_id != 0) {
        $("#chatlist").html(response.chatlist);
        if (response.newmsg_count == 0) {
          $("#msgcounter").hide();
        } else {
          $("#msgcounter").css("display", "");
          $("#msgcounter").show();
          $("#msgcounter").html("<small>" + response.newmsg_count + "</small>");
        }

        if (response.blocked) {
          $("#msgsender").hide();
          $("#blerror").show();
        } else {
          $("#msgsender").show();
          $("#blerror").hide();
        }

        if (response.verifyed) {
          $("#verifed").show();
        } else {
          $("#verifed").hide();
        }

        $("#user_data").html(response.chat.msgs);
        $("#chatter_username").text(response.chat.userdata.username);
        $("#chatter_pic").attr(
          "src",
          "assets/images/profile/" + response.chat.userdata.profile_pic
        );
      }
    },
  });
}

setInterval(() => {
  syncmsg();
}, 1000);
