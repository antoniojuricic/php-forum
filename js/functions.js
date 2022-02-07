$(document).ready(function() {
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
        $(".card").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$(".reply-btn").click(function(e) {
var comment = $("#reply-box").val();
var postid = $("#postid").val();
if(!comment) {
    return 0;
}

$.ajax({
    type: "POST",
    url: "modules/new_comment.php",
    data: {
        comment:comment,
        postid:postid,
    },
    cache: false,
    success: function(data) {
        if (data == "notreg") alert("Morate biti prijavljeni kako biste ostavili komentar.");
        else {
        location.reload();
        }
    }
  });
});

$("#new_topic_btn").click(function(e) {
  var category = $("#new_category_select").val();
  var title = $("#new_title").val();
  var content = $("#new_content").val();
  $.ajax({
      type: "POST",
      url: "modules/new_post.php",
      data: {
          category:category,
          title:title,
          content:content
      },
      cache: false,
      success: function(data) {
        window.location.href = "./thread.php?id=" + data;
       
      }
    });
  });

  $(document).on('click','.delete',function() {
    var id = $(this).attr('id');
    var type = $(this).attr('value');
    console.log(type);
    if (confirm('Jeste li sigurni da želite obrisati ovu stavku?')) {
    $.ajax({
        type: "POST",
        url: "modules/delete.php",
        data: {
            id:id,
            type:type
        },
        cache: false,
        success: function(data) {
            location.reload();
        }
      });
    }
    });

$(document).on('click','.like', function() {
  var comment_id = $(this).attr('id');
    $comment = $(this);
    liked = 0;
    type = 0;
    $.ajax({
        url: "modules/like.php",
        data: {comment_id:comment_id, liked:liked, type:type},
        type: "POST",
        success:function(data){
            if (data == 0) alert("Morate biti prijavljeni za ovu radnju!");
            else {
            $('#'+comment_id).attr("src","images/heart-liked.svg");
            $comment.parent().find('div.like_count').text(data);
            $comment.attr('class', 'unlike');
            }
        }

    });
  });

  $(document).on('click','.unlike', function() {

    var comment_id = $(this).attr('id');
    $comment = $(this);
    liked = 1;
    type = 0;
    $.ajax({
        url: "modules/like.php",
        data: {comment_id:comment_id, liked:liked, type:type},
        type: "POST",
        success:function(data){
            $('#'+comment_id).attr("src","images/heart.svg");
            $comment.parent().find('div.like_count').text(data);
            $comment.attr('class', 'like');
        }
    });
  });


  $(document).on('click','.post_like',function() {
    var post_id = $(this).attr('id');
      $post = $(this);
      liked = 0;
      type = 1;
      $.ajax({
          url: "modules/like.php",
          data: {post_id:post_id, liked:liked, type:type},
          type: "POST",
          success:function(data){
            console.log(data);
              if (data == 0) alert("Morate biti prijavljeni za ovu radnju!");
              else {
              $('#'+post_id).attr("src","images/heart-liked.svg");
              $post.parent().find('div.like_count').text(data);
              $post.attr('class', 'post_unlike');
              }
          }
  
      });
    });
  
    $(document).on('click','.post_unlike',function(){
  
      var post_id = $(this).attr('id');
      $post = $(this);
      liked = 1;
      type = 1;
      $.ajax({
          url: "modules/like.php",
          data: {post_id:post_id, liked:liked, type:type},
          type: "POST",
          success:function(data){
              $('#'+post_id).attr("src","images/heart.svg");
              $post.parent().find('div.like_count').text(data);
              $post.attr('class', 'post_like');
          }
      });
    });


$("#loginbutton").click(function(){
  var username = $("#username1").val();
  var password = $("#password1").val();

  if( username != "" && password != "" ){
      $.ajax({
          url:'modules/login.php',
          type:'post',
          data:{username:username,password:password},
          success:function(response){
              var msg = "";
              if(response == 1){
                  location.reload();
              }else{
                  msg = "Pogrešni podaci za prijavu. Pokušajte ponovno.";
              }
              $("#message").html(msg);
          }
      });
  }
});

$("#registerbutton").click(function(){
    
  var username = $("#username2").val();
  var password = $("#password2").val();
  var email = $("#email").val();

  if( username != "" && password != "" && email != ""){
      $.ajax({
          url:'modules/register.php',
          type:'post',
          data:{username:username,password:password,email:email},
          success:function(response){
              var msg = "";
              if(response == 1){
                  location.reload();
              }else {
                $("#message1").html(response);
              }
              
          }
      });
  }
});

$('#profile-photo').click(function(){
    if($("#current_user_id").val() === $("#profile_id").val()) {
      $('#imgupload').trigger('click'); 
    }
  });

  $(document).on('change','#imgupload',function(){
    var image = document.getElementById('imgupload').files[0];
    
    var image_name = image.name;
    var image_extension = image_name.split('.').pop().toLowerCase();
    if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1){
      alert("Datoteka nije podržana");
    } else {
    var form_data = new FormData();
        form_data.append("file", image);
        form_data.append('name', image_name);
    $.ajax({
        url:'modules/upload_photo.php',
        type:'post',
        data: form_data,
        contentType:false,
        cache : false,
        processData: false,
        success:function(data){
          if (data == 1) {
            location.reload();
          } else {
            alert(data);
          };
            }
    });
  }
});


 $("#login_btn").click(function() {
  showpopuplogin();
});

$("#registration_btn").click(function() {
  showpopupregistration();
});

$("#new_btn").click(function() {
  if(document.getElementById('logout')) {
    $("#new_topic_modal").fadeIn();
    $("#new_topic_modal").css({"visibility":"visible","display":"block"});
    $("#blocker").fadeIn();
    $("#blocker").css({"visibility":"visible","display":"block"});
  }
  else {
    showpopupregistration();
  }
})
 
function showpopuplogin() {
  document.getElementById('login_form').classList.add("active");
  document.getElementById('login_form_btn').classList.add("active");
  document.getElementById('reg_form').classList.remove("active");
  document.getElementById('reg_form_btn').classList.remove("active");

  $("#auth_form").fadeIn();
  $("#auth_form").css({"visibility":"visible","display":"block"});
  $("#blocker").fadeIn();
  $("#blocker").css({"visibility":"visible","display":"block"});
}

function showpopupregistration() {
  document.getElementById('reg_form').classList.add("active");
  document.getElementById('reg_form_btn').classList.add("active");
  document.getElementById('login_form').classList.remove("active");
  document.getElementById('login_form_btn').classList.remove("active");

  $("#auth_form").fadeIn();
  $("#auth_form").css({"visibility":"visible","display":"block"});
  $("#blocker").fadeIn();
  $("#blocker").css({"visibility":"visible","display":"block"})
}

let tabPanes = document.getElementsByClassName("tab-header")[0].getElementsByTagName("div");
for(let i=0;i<tabPanes.length;i++){
  tabPanes[i].addEventListener("click",function(){
    document.getElementsByClassName("tab-header")[0].getElementsByClassName("active")[0].classList.remove("active");
    tabPanes[i].classList.add("active");
    
    document.getElementsByClassName("tab-content")[0].getElementsByClassName("active")[0].classList.remove("active");
    document.getElementsByClassName("tab-content")[0].getElementsByClassName("tab-body")[i].classList.add("active");
  });
}
});

function hidepopup() {
 $("#auth_form").fadeOut();
 $("#auth_form").css({"visibility":"hidden","display":"none"});
 $("#new_topic_modal").fadeOut();
 $("#new_topic_modal").css({"visibility":"hidden","display":"none"});
 $("#blocker").css({"visibility":"hidden","display":"none"});
}
