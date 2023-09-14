<?php
require_once('component/required.php');
require_once('../config/connection.php');

if (isset($_POST['update_medicine'])) {

    $id = $_POST['id'];
    $photo = $_FILES['photo']['tmp_name'] ?? NULL;
    $name = $_POST['name'];
    $mrp = $_POST['medicine_mrp'];
    $category = $_POST['category'];
    $expiry_date = ($_POST['expiry_date'] && date('Y/m/d', strtotime($_POST['expiry_date'])) !== "00/00/00"  ? $_POST['expiry_date'] : NULL);
    $description = $_POST['description'];

    if ($photo) {
        $photo_new_path = "/img/medicine/" . time() . "." . explode("/", mime_content_type($photo))[1];
        move_uploaded_file($photo, "../" . $photo_new_path);
    }

    $sql = "UPDATE `medicine` SET name=:name, mrp=:mrp, category_id=:category, expiry_date=:expiry_date, description=:description " . ($photo ? ", photo='$photo_new_path'" : "") . " WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("id", $id);

    $res = $stmt->execute([
        "id" => $id,
        "name" => $name,
        "mrp" => $mrp,
        "category" => $category,
        "expiry_date" => $expiry_date,
        "description" => $description
    ]);

    if ($res) {
        $success = "Product has been updated";
    } else {
        $error = "Something went wrong during update medicine!";
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


                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Update medicine</h2>
                                </div>
                            </div>
                        </div>
                        <?php
                        include_once("../component/error-success.php");
                        ?>
                        <input type="search" name="search-medicine" id="search-update-medicine" class="form-control my-2 w-50 mx-auto" placeholder="Search here">
                        <div class="row column1" id="target-update-div">
                            <?php

                            $sql = "SELECT m.id as id, m.name as medicine_name, m.mrp as mrp, m.photo as photo, m.category_id as medicine_category_id, m.packing_date as packing_date, m.expiry_date as expiry_date, m.description as description, m.mrp as mrp, c.name as category_name FROM `medicine` as m INNER JOIN `category` as c ON m.category_id = c.id";
                            $medicine_stmt = $conn->prepare($sql);
                            $medicine_stmt->execute();
                            if ($stmt->rowCount()) {
                                $sql = "SELECT * FROM `category` WHERE sub_category IS NULL";
                                $stmt = $conn->prepare($sql);

                                $sql = "SELECT * FROM `category` WHERE sub_category=:sub_category";
                                $sub_stmt = $conn->prepare($sql);

                                $stmt->execute();
                                $option = "";
                                while ($row = $stmt->fetch()) {
                                    $sub_stmt->bindValue("sub_category", $row['id']);
                                    $sub_stmt->execute();

                                    if ($sub_stmt->rowCount()) {
                                        $option .= "<optgroup label='" . $row['name'] . "'>";
                                        while ($sub_row = $sub_stmt->fetch()) {
                                            $option .= "<option value='" . $sub_row['id'] . "'>" . $sub_row['name'] . "</option>";
                                        }
                                        $option .= "</optgroup>";
                                    } else {
                                        $option .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                }

                                while ($row = $medicine_stmt->fetch()) {
                                    echo '
                                <div class="col-lg-3 col-md-6 col-sm-12 pb-4">
                                    <div class="card product-item border-0 mb-4">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex align-items-center" style="height:200px;">
                                            <img class="img-fluid w-100" style="object-fit: contain; background: rgba(245, 245, 245, 0.5); height:200px;" src="' . (isset($row['photo']) && $row['photo'] &&  $row['photo'] !== "" ? $domain_name . $row['photo'] : $domain_name . "/img/default_medicine_img.png") . '" alt="medicine photo">
                                        </div>
                                        <div class="card-body border-left border-right p-2">
                                            <h4 class="text-truncate">' . $row['medicine_name'] . '</h4>
                                            <p style="font-size: 13px; color: black">Category name: ' . ($row['category_name']) . '</p>
                                            <p class="text-truncate">' . $row['description'] . '</p>
                                            <h6>MRP: ₹' . $row['mrp'] . '</h6>
                                            <p style="font-size: 10px" class="m-0 p-0">Created At: ' . date('Y/m/d', strtotime($row['packing_date'])) . '</p>
                                            <p style="font-size: 10px" class="m-0 p-0"> ' . ($row['expiry_date'] ? "Expired At: " . date('Y/m/d', strtotime($row['expiry_date'])) : "") . '</p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between border px-1">
                                            <button type="button" class="btn btn-success text-white mx-1 w-100" data-toggle="modal" data-target="#modal' . $row["id"] . '">
                                                <i class="fa fa-edit mr-1"></i>Update
                                            </button>
                                        </div>
                                    </div>
                                </div>';
                                    echo "
                                <!-- Modal -->
                                <div class='modal fade' id='modal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered form-modal' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLongTitle'>Update medicine</h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <form class='col' action='" . $_SERVER['PHP_SELF'] . "' id='add_medicine_form' enctype='multipart/form-data' method='POST'>
                                                    <div class='row w-100'>
                                                        <div class='col'>
                                                            <div class=' d-flex justify-content-center'>
                                                                <img src='" . $domain_name . $row['photo'] . "' class='pb-4' width='200' id='picture_preview' />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row w-100'>
                                                        <div class='col'>
                                                            <div class='input-group mb-3'>
                                                                <span class='input-group-text' id='basic-addon1'>Medicine photo</span>
                                                                <input type='file' class='form-control upload-pic' name='photo' data-target-id='#picture_preview' placeholder='Upload profile photo' aria-label='Username' aria-describedby='basic-addon1'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type='text' class='form-control' name='id' id='id' value='" . $row['id'] . "' hidden>
                                                    <div class='row w-100'>
                                                        <div class='col'>
                                                            <div class='input-group mb-3'>
                                                                <span class='input-group-text'>Name</span>
                                                                <input type='text' class='form-control' name='name' id='name' value='" . $row['medicine_name'] . "' placeholder='Medicine name'>
                                                            </div>
                                                        </div>
                                                        <div class='col'>
                                                            <div class='input-group mb-3'>
                                                                <span class='input-group-text'>MRP</span>
                                                                <input type='number' class='form-control' name='medicine_mrp' value='" . $row['mrp'] . "' id='medicine_mrp' placeholder='MRP (In Rupees)'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row w-100'>
                                                        <div class='col'>
                                                            <div class='input-group mb-3'>
                                                                <span class='input-group-text'>Category</span>
                                                                <select name='category' id='category' class='form-control'  value='" . $row['medicine_category_id'] . "'>
                                                                    <option value='' disabled> - SELECT - </option>
                                                                    $option
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class='col'>
                                                            <div class='input-group mb-3'>
                                                                <span class='input-group-text'>Expiry Date</span>
                                                                <input type='date' name='expiry_date' id='expiry_date' value='" . date('Y-m-d', strtotime($row['expiry_date'])) . "' class='form-control' placeholder='Expiry date'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row w-100'>
                                                        <div class='col'>
                                                            <div class='input-group mb-3'>
                                                                <span class='input-group-text'>Description</span>
                                                                <textarea class='form-control' name='description' id='description' placeholder='Medicine description'>" . $row['description'] . "</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row w-100'>
                                                        <input type='submit' value='Update medicine' name='update_medicine' class='w-25 m-auto btn btn-outline-success'>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="js/custom.js"></script>
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