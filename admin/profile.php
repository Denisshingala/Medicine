<?php
require_once('component/required.php');

require_once('../config/connection.php');

if (isset($_POST['update_profile'])) {

   $profile_photo = $_FILES['profile_photo']['tmp_name'];
   $company_logo = $_FILES['company_logo']['tmp_name'];
   $admin_name = $_POST['admin_name'];
   $compnay_name = $_POST['company_name'];
   $phone_number = $_POST['phone_number'];
   $company_email = $_POST['company_email'];
   $address = $_POST['address'];

   $sql = "SELECT * FROM `company` WHERE admin_id=:admin_id";
   $stmt = $conn->prepare($sql);
   $stmt->execute(["admin_id" => $_SESSION['admin_id']]);

   if ($company_logo) {
      $company_logo_new_path = "/img/company/" . time() . "." . explode("/", mime_content_type($company_logo))[1];
      move_uploaded_file($company_logo, "../" . $company_logo_new_path);
   }

   if ($profile_photo) {
      $profile_photo_new_path = "/img/company/" . time() . "." . explode("/", mime_content_type($profile_photo))[1];
      move_uploaded_file($profile_photo, "../" . $profile_photo_new_path);
   }

   if ($stmt->rowCount()) {
      $sql = "UPDATE `company` SET `admin_id`=:admin_id, `company_name`=:company_name, `owner_name`=:owner_name, " . ($company_logo ? "`company_logo`='$company_logo_new_path'," : "") . " " . ($profile_photo ? "`owner_photo`='$profile_photo_new_path'," : "") . " `address`=:address, `company_email`=:company_email, `mobile_number`=:mobile_number";
   } else {
      $sql = "INSERT INTO `company` (`admin_id`, `company_name`, `company_logo`, `owner_name`, `owner_photo`, `address`, `company_email`, `mobile_number`) VALUES (:admin_id, :company_name," . ($company_logo ? "'$company_logo_new_path'," : "'',") . " :owner_name, " . ($profile_photo ? "'$profile_photo_new_path'," : "'',") . " :address, :company_email, :mobile_number)";
   }

   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([
      "admin_id" => $_SESSION['admin_id'],
      "company_name" => $compnay_name,
      "owner_name" => $admin_name,
      "address" => $address,
      "company_email" => $company_email,
      "mobile_number" => $phone_number,
   ]);

   if ($res) {
      $success = "Profile has been updated";
   } else {
      $error = "Something went wrong during update profile!";
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
   <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="css/colors.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="css/custom.css" />
</head>

<body class="inner_page profile_page">
   <div class="full_container">
      <div class="inner_container">

         <?php
         include_once("component/sidebar.php");
         ?>

         <!-- right content -->
         <div id="content">

            <?php
            include_once("component/topbar.php");
            ?>
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">

                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Profile</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row column1">
                     <div class="col-md-2"></div>
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>User profile</h2>
                              </div>
                           </div>
                           <div class="full padding_infor_info">
                              <?php
                              include_once("../component/error-success.php");
                              ?>
                              <form class="col" action="<?php echo $_SERVER['PHP_SELF'] ?>" id="profile_update_form" enctype="multipart/form-data" method="POST">
                                 <!-- Admin profile -->
                                 <div class="row w-100">
                                    <div class="col">
                                       <div class="d-flex justify-content-center">
                                          <img src="<?php echo (isset($data['owner_photo']) && $data['owner_photo'] && $data['owner_photo'] !== "" ? $domain_name . $data['owner_photo'] : '')  ?>" class="pb-4" width="200" id="profile_preview" />
                                       </div>
                                    </div>
                                    <div class="col">
                                       <div class=" d-flex justify-content-center">
                                          <img src="<?php echo (isset($data['company_logo']) && $data['company_logo'] && $data['company_logo'] !== "" ? $domain_name . $data['company_logo'] : '') ?>" class="pb-4" width="200" id="company_logo_preview" />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row w-100">
                                    <div class="col">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text" id="basic-addon1">Upload profile</span>
                                          <input type="file" class="form-control upload-pic" name="profile_photo" data-target-id="#profile_preview" placeholder="Upload profile photo" aria-label="Username" aria-describedby="basic-addon1">
                                       </div>
                                    </div>
                                    <div class="col">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">Company logo</span>
                                          <input type="file" class="form-control upload-pic" name="company_logo" data-target-id="#company_logo_preview" placeholder="Upload company logo">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row w-100">
                                    <div class="col">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">Admin name</span>
                                          <input type="text" class="form-control" name="admin_name" id="admin_name" value="<?php echo ($data['owner_name'] ?? '') ?>" placeholder="Admin name">
                                       </div>
                                    </div>
                                    <div class="col">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">Company name</span>
                                          <input type="text" class="form-control" name="company_name" value="<?php echo ($data['company_name'] ?? '') ?>" id="company_name" placeholder="Company name">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row w-100">
                                    <div class="col">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">Phone number</span>
                                          <input type="text" class="form-control" name="phone_number" value="<?php echo ($data['mobile_number'] ?? '') ?>" id="phone_number" placeholder="Compnay phone number">
                                       </div>
                                    </div>
                                    <div class="col">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">Email</span>
                                          <input type="email" name="company_email" id="company_email" value="<?php echo ($data['company_email'] ?? '') ?>" class="form-control" placeholder="Compnay email">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row w-100">
                                    <div class="col">
                                       <div class="input-group mb-3">
                                          <span class="input-group-text">Address</span>
                                          <textarea class="form-control" name="address" id="address" placeholder="Company address"><?php echo ($data['address'] ?? '') ?></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row w-100">
                                    <input type="submit" value="Update" name="update_profile" class="w-25 m-auto btn btn-outline-danger">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <!-- end row -->
                  </div>
                  <?php
                  include_once("component/footer.php");
                  ?>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
   </div>

   <!-- jQuery -->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <!-- wow animation -->
   <script src="js/animate.js"></script>
   <!-- select country -->
   <script src="js/bootstrap-select.js"></script>
   <!-- owl carousel -->
   <script src="js/owl.carousel.js"></script>
   <!-- chart js -->
   <script src="js/Chart.min.js"></script>
   <script src="js/Chart.bundle.min.js"></script>
   <script src="js/utils.js"></script>
   <script src="js/analyser.js"></script>
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/custom.js"></script>
   <!-- calendar file css -->
   <script src="js/semantic.min.js"></script>

   <!-- jQuery validation -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

   <script>
      $(document).ready(function() {
         const showPicture = (event) => {
            const ele = event.target;

            const reader = new FileReader();
            reader.onload = (event) => {
               $(ele.dataset.targetId).attr("src", reader.result);
            }

            reader.error = (event) => {
               $(ele.dataset.targetId).attr("src", "");
            }

            reader.readAsDataURL(ele.files[0]);
         }

         const removePicture = (event) => {
            const ele = event.target;

            $(ele.dataset.targetId).attr("src", "");
         }

         $(".upload-pic").click(removePicture);
         $(".upload-pic").change(showPicture);

         $("#profile_update_form").validate({
            rules: {
               "admin_name": {
                  required: true
               },
               "company_name": {
                  required: true
               },
               "phone_number": {
                  required: true,
                  number: true
               },
               "company_email": {
                  required: true,
                  email: true
               },
               "address": {
                  required: true,
               }
            }
         });
      });
   </script>
</body>

</html>