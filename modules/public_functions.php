<?php 

function getAllPosts($sort = 'most_liked', $category = 'all') {
   global $conn;
   switch ($sort) {
      case 'newest':
         $orderBy = "ORDER BY time DESC";
         break;
   
      case 'most_liked':
         $orderBy = "ORDER BY likes DESC";
         break;

      case 'popular':
         $orderBy = "ORDER BY comment_count DESC";
         break;   
   }
   $filter = '';
   if ($category != 'all') {
      $filter = "WHERE post.category_id IN (SELECT category_id FROM category WHERE slug ='$category')";
   }
      $sql = "SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id INNER JOIN user ON post.user_id = user.user_id $filter $orderBy";
      $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
      return $resultset;
   }
    
function getUserPosts($id) {
   global $conn;
   $sql = "SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id INNER JOIN user ON post.user_id = user.user_id WHERE user.user_id = '$id' ORDER BY time DESC";
   $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
   return $resultset;
}

function getAllComments($id) {
    global $conn;
    $sql = "SELECT * FROM comment INNER JOIN user ON comment.user_id = user.user_id WHERE post_id ='$id'";
    $comments = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
    return $comments;
}

function getPost($id) {
    global $conn;
    $sql = "SELECT * FROM post INNER JOIN user ON post.user_id = user.user_id  INNER JOIN category ON category.category_id = post.category_id WHERE post_id = '$id'";
    $post = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
    return $post;
}

function check_comment_like($user_id, $comment_id) {
   global $conn;
   $results = mysqli_query($conn, "SELECT * FROM comment_like WHERE user_id='$user_id' AND comment_id='$comment_id'");
   return mysqli_num_rows($results);
}

function check_post_like($user_id, $post_id) {
   global $conn;
   $results = mysqli_query($conn, "SELECT * FROM post_like WHERE user_id='$user_id' AND post_id='$post_id'");
   return mysqli_num_rows($results);
}

function getCommentCount($id) {
   global $conn;
   $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as totalComments FROM comment WHERE post_id='$id'"));
   return $data['totalComments'];
}

function getCategories($slug = "") {
   global $conn;
   if ($slug != "") {
      $data = mysqli_query($conn, "SELECT * FROM category WHERE slug='$slug'") or die("database error:". mysqli_error($conn));
      return $data;
   }
      $data = mysqli_query($conn, "SELECT * FROM category") or die("database error:". mysqli_error($conn));
   
   return $data;
}

function getProfile($id) {
   global $conn;
   return $profile = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$id'");
}

function getPostStat($id) {
   global $conn;
   $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as totalPosts FROM post WHERE user_id='$id'"));
   return $data['totalPosts'];
}

function getCommentStat($id) {
   global $conn;
   $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as totalComment FROM comment WHERE user_id='$id'"));
   return $data['totalComment'];
}

function getLikeStat($id) {
   global $conn;
   $data1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(likes) as totalCommentLikes FROM comment WHERE user_id='$id'"));
   $data2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(likes) as totalPostLikes FROM post WHERE user_id='$id'"));
   
   return $data1['totalCommentLikes'] + $data2['totalPostLikes'];
}

function timeAgo($time_ago) {
    $time_ago = strtotime($time_ago);
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
    
    if ($seconds <= 60) {
       return "upravo sada";
    }
    
    else if ($minutes <= 60) {
       if ($minutes == 1) {
          return "prije jednu minutu";
       } else {
          return "prije $minutes min.";
       }
    }
    
    else if ($hours <= 24) {
       if ($hours == 1) {
          return "prije 1 sat";
       } else {
          return "prije $hours h";
       }
    }
    
    else if ($days <= 7) {
       if ($days == 1) {
          return "jučer";
       } else {
          return "prije $days dana";
       }
    }
    
    else if ($weeks <= 4.3) {
       if ($weeks == 1) {
          return "prije tjedan dana";
       } else {
          return "prije $weeks tj.";
       }
    }
    
    else if ($months <= 12) {
       if ($months == 1) {
          return "prije mjesec dana";
       } else {
          return "prije $months mj.";
       }
    }
    
    else {
       if ($years == 1) {
          return "prije godinu dana";
       } else {
          return "prije $years god.";
       }
    }
 }

?>