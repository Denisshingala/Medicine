<?php
require_once("./config/connection.php");

if (isset($_GET['c_id'])) {
    $id = $_GET['c_id'];
    $sql = "SELECT m.name as medicine_name, m.photo as photo, m.id as m_id, c.name as category_name, m.mrp as mrp FROM `medicine` as m INNER JOIN `category` as c ON m.category_id = c.id WHERE c.id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("id", $id);

    $stmt->execute();

    if ($stmt->rowCount()) {
        $medicines = $stmt->fetchAll();
        $category = $medicines[0]['category_name'];
    } else {
        header("location: $domain_name");
    }
} else {
    header("location: $domain_name");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foody - Organic Food Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <?php
    include_once("./component/navbar.php");
    ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown"><?php echo $category ?>'s medicines</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="/<?php echo $domain_name; ?>">Home</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Category Start -->
    <div class="tab-content">
        <div id="tab-1" class="tab-pane fade show p-4 active">
            <div class="row g-4">
                <?php

                foreach ($medicines as $row) {
                    echo '
                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="product-item">
                                <div class="position-relative bg-light overflow-hidden">
                                    <img class="img-fluid w-100" src="' . $domain_name . $row['photo'] . '" alt="">
                                    <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                                </div>
                                <div class="text-center p-4">
                                    <a class="d-block h5 mb-2" href="">' . $row['medicine_name'] . '</a>
                                    <span class="text-primary me-1">₹' . $row['mrp'] . '</span>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="w-100 text-center border-end py-2">
                                        <a href="' . $domain_name . '/about.php?m_id=' . $row['m_id'] . '" class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>View detail</a>
                                    </small>
                                </div>
                            </div>
                        </div>';
                }

                ?>
            </div>
        </div>
    </div>
    <!-- Category End -->

    <?php
    include_once("./component/footer.php");
    ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>