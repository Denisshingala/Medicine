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
                  <div class="row column1">
                     <?php
                     $sql = "SELECT * FROM `medicine`";
                     $stmt = $conn->prepare($sql);
                     $stmt->execute();

                     while ($row = $stmt->fetch()) {
                        echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-4">
                                 <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex align-items-center" style="height:200px;">
                                       <img class="img-fluid w-100" style="object-fit: contain; background: rgba(245, 245, 245, 0.5); height:200px;" src="' . $domain_name . $row['photo'] . '" alt="medicine photo">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-2">
                                       <h6 class="text-truncate">' . $row['name'] . '</h6>
                                       <div class="d-flex justify-content-center">
                                          <h6>₹ ' . ($row['mrp']) . '</h6>
                                       </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between border px-1">
                                       <a href="' . $domain_name . '/about.php?m_id=' . $row['id'] . '" class="btn btn-danger text-white mx-1 w-100">
                                          <i class="fa fa-eye mr-1"></i>View Details
                                       </a>
                                    </div>
                                 </div>
                              </div>';
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
   <script src="js/chart_custom_style1.js"></script>
</body>

</html>