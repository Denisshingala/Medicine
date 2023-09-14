<?php

session_start();
require_once("../config/connection.php");

if (isset($_SESSION["is_loggedin"])) {
   header("location: $domain_name/admin/");
}

if (isset($_POST['login_submit'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM `admin` WHERE email= :email";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam("email", $email);
   $stmt->execute();
   if ($stmt->rowCount()) {
      $row = $stmt->fetch();
      if (password_verify($password, $row['password'])) {
         $_SESSION['admin_email'] = $email;
         $_SESSION['admin_id'] = $row['id'];
         $_SESSION['is_loggedin'] = true;
         header("location: $domain_name/admin");
      } else {
         $error = "Email or password is invalid!";
      }
   } else {
      $error = "Email or password is invalid!";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Medicine</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="./css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="./style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="./css/responsive.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="./css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="./css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="./css/custom.css" />
</head>

<body class="inner_page login">
   <div class="full_container">
      <div class="container">
         <div class="center verticle_center full_height">
            <div class="login_section">
               <div class="logo_login">
                  <div class="center">
                     <h1 class="text-white">Admin login</h1>
                  </div>
               </div>
               <div class="login_form">
                  <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> method="POST" id="login_form">
                     <fieldset>
                        <?php
                        include_once("../component/error-success.php");
                        ?>

                        <div class="field">
                           <label class="label_field">Email Address</label>
                           <input type="email" name="email" placeholder="E-mail" />
                        </div>
                        <div class="field">
                           <label class="label_field">Password</label>
                           <input type="password" name="password" placeholder="Password" />
                        </div>
                        <!-- <div class="field">
                           <label class="label_field hidden">hidden label</label>
                           <a class="forgot" href="">Forgotten Password?</a>
                        </div> -->
                        <div class="field margin_0">
                           <input type="submit" name="login_submit" class="main_bt w-100" value="Sing In">
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- jQuery -->
   <script src="./js/jquery.min.js"></script>
   <script src="./js/popper.min.js"></script>
   <script src="./js/bootstrap.min.js"></script>
   <!-- wow animation -->
   <script src="./js/animate.js"></script>
   <!-- select country -->
   <script src="./js/bootstrap-select.js"></script>
   <!-- jQuery validation -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

   <script>
      $(document).ready(function() {
         $("#login_form").validate({
            rules: {
               email: {
                  required: true,
                  email: true
               },
               password: {
                  required: true,
                  minlength: 8
               }
            }
         });
      });
   </script>
</body>

</html>