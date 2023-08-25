<?php
require_once('component/required.php');

require_once('../config/connection.php');

if (isset($_POST['add_medicine'])) {

    $category_name = $_POST['category_name'];
    $parent_category = $_POST['parent_category'] ?? NULL;

    $sql = "INSERT INTO `category` (name, sub_category) values(:name, :sub_category)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute(["name" => $category_name, "sub_category" => $parent_category]);

    if ($res) {
        $success = "Category has been added!";
    } else {
        $error = "Something went wrong during add category!";
    }
}

if (isset($_POST['delete_category'])) {
    $sql = "DELETE FROM `category` WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute(["id" => $_POST['id']]);

    if ($res) {
        $success = "Category has been deleted!";
    } else {
        $error = "Something went wrong during delete category!";
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
                                    <h2>Category</h2>
                                </div>
                            </div>
                        </div>
                        <?php
                        include_once("../component/error-success.php");
                        ?>
                        <div class="row column1">
                            <div class="col-md-2"></div>
                            <div class="col-md-12">
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>Add category</h2>
                                        </div>
                                    </div>
                                    <div class="full padding_infor_info">
                                        <form class="col" action="<?php echo $_SERVER['PHP_SELF'] ?>" id="add_category_form" method="POST">
                                            <div class="row w-100">
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Category name</span>
                                                        <input type="text" class="form-control" name="category_name" id="category_name" placeholder="New category name">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Parent category</span>
                                                        <select name="parent_category" class="form-control" id="parent_category">
                                                            <?php
                                                            $sql = "SELECT * FROM `category` WHERE sub_category IS NULL";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->execute();

                                                            if ($stmt->rowCount()) {
                                                                echo "<option value='' disabled selected> - SELECT - </option>";
                                                                while ($row = $stmt->fetch()) {
                                                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' disabled selected>No category found!</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row w-100">
                                                <input type="submit" value="Add category" name="add_medicine" class="w-25 m-auto btn btn-outline-success">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>

                        <div class="row">
                            <!-- table section -->
                            <div class="col-md-12">
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>List of category</h2>
                                        </div>
                                    </div>
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <table class="table table-hover text-center">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Sub category</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT c1.id as id, c1.name as main_cat, c2.name as parent_cat FROM `category` AS c1 LEFT JOIN `category` AS C2 ON c1.sub_category = c2.id";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();

                                                    while ($row = $stmt->fetch()) {
                                                        echo "<tr>
                                                            <td>" . $row['main_cat'] . "</td>
                                                            <td>" . ($row['parent_cat'] ?? "-") . "</td>
                                                            <td>
                                                                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modal" . $row['id'] . "'>
                                                                    Delete
                                                                </button>
                                                            </td>
                                                        </tr>";

                                                        echo "
                                                            <!-- Modal -->
                                                            <div class='modal fade' id='modal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                                                                <div class='modal-dialog modal-dialog-centered' role='document'>
                                                                    <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <h5 class='modal-title' id='exampleModalLongTitle'>Delete category</h5>
                                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                        <span aria-hidden='true'>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        Are you sure you want to delete? 
                                                                    </div>
                                                                    <div class='modal-footer'>
                                                                        <button type='button' class='btn btn-outline-success' data-dismiss='modal'>No</button>
                                                                        <form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
                                                                            <input type='text' value='" . $row['id'] . "' name='id' hidden/>
                                                                            <input type='Submit' value='Yes' name='delete_category' class='btn btn-outline-danger'/>
                                                                        </form>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        ";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            $("#add_category_form").validate({
                rules:{
                    category_name:{
                        required: true
                    }
                }
            });
        });
    </script>
</body>

</html>