<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE user_id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> user accounts </h1>

   <div class="heading">
  
   <!-- <p> <a href="home.php">home</a> / search </p> -->
</div>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="search user..." class="box">
      <input type="submit" name="submit" value="search" class="btn">
   </form>
</section>

<section class="users" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_users) > 0){
         while($fetch_users = mysqli_fetch_assoc($select_users)){
   ?>
   <!-- <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_users['image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_users['name']; ?></div>
      <div class="price">Rs.<?php echo $fetch_users['price']; ?>/-</div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <input type="submit" class="btn" value="add to cart" name="add_to_cart">
   </form> -->
   <div class="box">
         <p> user id : <span><?php echo $fetch_users['user_id']; ?></span> </p>
         <p> username : <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['user_id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a>
      </div>
   <?php
            }
         }else{
            echo '<p class="empty">no result found!</p>';
         }
      }
   ?>
   </div>

     <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> user id : <span><?php echo $fetch_users['user_id']; ?></span> </p>
         <p> username : <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
          ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['user_id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a>
      </div>
      <?php
         };
      ?>
   </div> 




  

</section>







</section>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
