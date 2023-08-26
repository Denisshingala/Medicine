<?php
require_once("../config/connection.php");
$email = $_SESSION['admin_email'];
$sql = "SELECT * FROM `company` INNER JOIN `admin` ON `company`.admin_id = `admin`.id AND `admin`.email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindValue("email", $email);
$stmt->execute();
$data = $stmt->fetch();
?>

<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="index.html"><img class="logo_icon img-responsive" src="<?php echo $domain_name . $data['owner_photo'] ?>" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><img class="img-responsive" src="<?php echo $domain_name . $data['owner_photo'] ?>" alt="#" /></div>
                <div class="user_info">
                    <h6><?php echo $data['owner_name'] ?></h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <ul class="list-unstyled components">
            <?php $page = basename($_SERVER['PHP_SELF'], ".php"); ?>
            <li class="<?php echo ($page == "" || $page = "index" ? "active" : ""); ?>">
                <a href="/medicine/admin/"><i class="fa fa-eye yellow_color"></i> <span>View medicine</span></a>
            </li>
            <li class="<?php echo ($page = "add_medicine" ? "active" : ""); ?>">
                <a href="add_medicine.php"><i class="fa fa-plus-circle purple_color"></i> <span>Add medicine</span></a>
            </li>
            <li class="<?php echo ($page = "medicine" ? "active" : ""); ?>">
                <a href="update_medicine.php"><i class="fa fa-edit purple_color"></i> <span>Update medicine</span></a>
            </li>
            <li class="<?php echo ($page = "medicine" ? "active" : ""); ?>">
                <a href="remove_medicine.php"><i class="fa fa-remove purple_color"></i> <span>Delete medicine</span></a>
            </li>
            <li class="<?php echo ($page = "category" ? "active" : ""); ?>">
                <a href="add_category.php"><i class="fa fa-tasks purple_color2"></i> <span>Category</span></a>
            </li>
        </ul>
    </div>
</nav>
<!-- end sidebar -->