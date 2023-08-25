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
                <a href="/medicine/admin/"><i class="fa fa-eye yellow_color"></i> <span>View Product</span></a>
            </li>
            <li class="<?php echo ($page = "add_product" ? "active" : ""); ?>">
                <a href="add_medicine.php"><i class="fa fa-plus-circle purple_color"></i> <span>Add Product</span></a>
            </li>
            <li class="<?php echo ($page = "category" ? "active" : ""); ?>">
                <a href="add_category.php"><i class="fa fa-tasks purple_color2"></i> <span>Category</span></a>
            </li>
            <li class="active">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
                <ul class="collapse list-unstyled" id="dashboard">
                    <li>
                        <a href="dashboard.html">> <span>Default Dashboard</span></a>
                    </li>
                    <li>
                        <a href="dashboard_2.html">> <span>Dashboard style 2</span></a>
                    </li>
                </ul>
            </li>
            <li><a href="widgets.html"><i class="fa fa-clock-o orange_color"></i> <span>Widgets</span></a></li>
            <li>
                <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Elements</span></a>
                <ul class="collapse list-unstyled" id="element">
                    <li><a href="general_elements.html">> <span>General Elements</span></a></li>
                    <li><a href="media_gallery.html">> <span>Media Gallery</span></a></li>
                    <li><a href="icons.html">> <span>Icons</span></a></li>
                    <li><a href="invoice.html">> <span>Invoice</span></a></li>
                </ul>
            </li>
            <li><a href="tables.html"><i class="fa fa-table purple_color2"></i> <span>Tables</span></a></li>
            <li>
                <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i> <span>Apps</span></a>
                <ul class="collapse list-unstyled" id="apps">
                    <li><a href="email.html">> <span>Email</span></a></li>
                    <li><a href="calendar.html">> <span>Calendar</span></a></li>
                    <li><a href="media_gallery.html">> <span>Media Gallery</span></a></li>
                </ul>
            </li>
            <li><a href="price.html"><i class="fa fa-briefcase blue1_color"></i> <span>Pricing Tables</span></a></li>
            <li>
                <a href="contact.html">
                    <i class="fa fa-paper-plane red_color"></i> <span>Contact</span></a>
            </li>
            <li class="active">
                <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span>Additional Pages</span></a>
                <ul class="collapse list-unstyled" id="additional_page">
                    <li>
                        <a href="profile.html">> <span>Profile</span></a>
                    </li>
                    <li>
                        <a href="project.html">> <span>Projects</span></a>
                    </li>
                    <li>
                        <a href="login.html">> <span>Login</span></a>
                    </li>
                    <li>
                        <a href="404_error.html">> <span>404 Error</span></a>
                    </li>
                </ul>
            </li>
            <li><a href="map.html"><i class="fa fa-map purple_color2"></i> <span>Map</span></a></li>
            <li><a href="charts.html"><i class="fa fa-bar-chart-o green_color"></i> <span>Charts</span></a></li>
            <li><a href="settings.html"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li>
        </ul>
    </div>
</nav>
<!-- end sidebar -->