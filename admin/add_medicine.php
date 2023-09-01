<?php
require_once('component/required.php');

require_once('../config/connection.php');

if (isset($_POST['add_medicine'])) {

    $photo = $_FILES['photo']['tmp_name'];
    $name = $_POST['name'];
    $mrp = $_POST['medicine_mrp'];
    $category = $_POST['category'];
    $expiry_date = ($_POST['expiry_date'] && date('Y/m/d', strtotime($_POST['expiry_date'])) !== "00/00/00"  ? $_POST['expiry_date'] : NULL);
    $description = $_POST['description'];

    $photo_new_path = "/img/medicine/" . time() . "." . explode("/", mime_content_type($photo))[1];
    move_uploaded_file($photo, "../" . $photo_new_path);

    $sql = "INSERT INTO `medicine`(`name`, `photo`, `description`, `mrp`, `expiry_date`, `category_id`, `admin_id`) VALUES (:name, '$photo_new_path', :description, :mrp, :expiry_date, :category_id, :admin_id)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute(["name" => $name, "description" => $description, "mrp" => $mrp, "expiry_date" => $expiry_date, "category_id" => $category, "admin_id" => $_SESSION['admin_id']]);

    if ($res) {
        $success = "Product has been added";
    } else {
        $error = "Something went wrong during add medicine!";
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
                                    <h2>Medicine</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row column1">
                            <div class="col-md-2"></div>
                            <div class="col-md-12">
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>Add medicine</h2>
                                        </div>
                                    </div>
                                    <div class="full padding_infor_info">
                                        <?php
                                        include_once("../component/error-success.php");
                                        ?>
                                        <form class="col" action="<?php echo $_SERVER['PHP_SELF'] ?>" id="add_medicine_form" enctype="multipart/form-data" method="POST">
                                            <div class="row w-100">
                                                <div class="col">
                                                    <div class=" d-flex justify-content-center">
                                                        <img class="pb-4" width="200" id="picture_preview" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row w-100">
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Medicine photo</span>
                                                        <input type="file" class="form-control upload-pic" name="photo" data-target-id="#picture_preview" placeholder="Upload profile photo" aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row w-100">
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Name</span>
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Medicine name">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">MRP</span>
                                                        <input type="number" class="form-control" name="medicine_mrp" id="medicine_mrp" placeholder="MRP (In Rupees)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row w-100">
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Category</span>
                                                        <select name="category" id="category" class="form-control">
                                                            <option value="" selected disabled> - SELECT - </option>
                                                            <?php
                                                            $sql = "SELECT * FROM `category` WHERE sub_category IS NULL";
                                                            $stmt = $conn->prepare($sql);

                                                            $sql = "SELECT * FROM `category` WHERE sub_category=:sub_category";
                                                            $sub_stmt = $conn->prepare($sql);

                                                            $stmt->execute();

                                                            while ($row = $stmt->fetch()) {
                                                                $sub_stmt->bindValue("sub_category", $row['id']);
                                                                $sub_stmt->execute();

                                                                if ($sub_stmt->rowCount()) {
                                                                    echo "<optgroup label='" . $row['name'] . "'>";
                                                                    while ($sub_row = $sub_stmt->fetch()) {
                                                                        echo "<option value='" . $sub_row['id'] . "'>" . $sub_row['name'] . "</option>";
                                                                    }
                                                                    echo "</optgroup>";
                                                                } else {
                                                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Expiry Date</span>
                                                        <input type="date" name="expiry_date" id="expiry_date" class="form-control" placeholder="Expiry date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row w-100">
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Description</span>
                                                        <textarea class="form-control" name="description" id="description" placeholder="Medicine description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row w-100">
                                                <input type="submit" value="Add medicine" name="add_medicine" class="w-25 m-auto btn btn-outline-success">
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

            $("#add_medicine_form").validate({
                rules: {
                    "photo": {
                        required: true,
                    },
                    "name": {
                        required: true
                    },
                    "medicine_mrp": {
                        required: true,
                        number: true
                    },
                    "category": {
                        required: true,
                    },
                    "expiry_date": {
                        required: true,
                        date: true
                    },
                    "description": {
                        required: true,
                    }
                }
            });
        });
    </script>
</body>

</html>