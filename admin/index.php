<?php
require_once('component/required.php');
require_once('../config/connection.php');
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

<body class="dashboard dashboard_1">
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

                  <?php
                  include_once("../component/error-success.php");
                  ?>

                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Dashboard</h2>
                        </div>
                     </div>
                  </div>
                  <input type="search" name="search-medicine" id="search-view-medicine" class="form-control my-2 w-50 mx-auto" placeholder="Search here">
                  <div class="row column1" id="target-view-div">
                     <?php
                     $sql = "SELECT m.id as id, m.name as medicine_name, m.mrp as mrp, m.category_id as medicine_category_id, m.photo as photo, m.packing_date as packing_date, m.expiry_date as expiry_date, m.description as description, m.mrp as mrp, c.name as category_name FROM `medicine` as m INNER JOIN `category` as c ON m.category_id = c.id LIMIT 8";
                     $stmt = $conn->prepare($sql);
                     $stmt->execute();
                     if ($stmt->rowCount()) {
                        while ($row = $stmt->fetch()) {
                           echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-4">
                                 <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex align-items-center" style="height:200px;">
                                       <img class="img-fluid w-100" style="object-fit: contain; background: rgba(245, 245, 245, 0.5); overflow: hidden; height:200px;" src="' . (isset($row['photo']) && $row['photo'] &&  $row['photo'] !== "" ? $domain_name . $row['photo'] : $domain_name . "/img/default_medicine_img.png") . '" alt="medicine photo">
                                    </div>
                                    <div class="card-body border-left border-right p-2">
                                       <h4 class="text-truncate">' . $row['medicine_name'] . '</h4>
                                       <p style="font-size: 13px; color: black">Category name: ' . ($row['category_name']) . '</p>
                                       <p class="text-truncate">' . $row['description'] . '</p>
                                       <h6>MRP: ₹' . $row['mrp'] . '</h6>
                                       <p style="font-size: 10px" class="m-0 p-0">Created At: ' . date('Y/m/d', strtotime($row['packing_date'])) . '</p>
                                       <p style="font-size: 10px" class="m-0 p-0"> ' . ($row['expiry_date'] ? "Expired At: " . date('Y/m/d', strtotime($row['expiry_date'])) : "") . '</p>
                                    </div>
                                 </div>
                              </div>';
                        }
                     } else {
                        echo "<div class='container py-5 text-center text-secondary'>No data found!</div>";
                     }
                     ?>
                  </div>
               </div>
               <!-- footer -->
               <?php
               include_once("component/footer.php");
               ?>
            </div>
            <!-- end dashboard inner -->
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
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>