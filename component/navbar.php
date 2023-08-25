<?php
session_start();

$loggedin = false;
if (isset($_SESSION['admin_email'])) {
    $loggedin = true;
}

require_once("./config/connection.php");

?>
<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@example.com</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0">Ru<span class="text-secondary">shi Mar</span>eting</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-toggle-split" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                        <?php
                        $sql = "SELECT * FROM `category` WHERE `sub_category` IS NULL";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $sql = "SELECT * FROM `category` WHERE `sub_category` = :sub_category";
                        $sub_stmt = $conn->prepare($sql);
                        $sub_stmt->bindParam("sub_category", $sub_id);

                        if ($stmt->rowCount()) {
                            while ($row = $stmt->fetch()) {

                                $sub_id = $row['id'];
                                $sub_stmt->execute();
                                $count = $sub_stmt->rowCount();
                                echo "<li>
                                    <a href='#' class='dropdown-item'>" . $row['name'] . ($count ? " &raquo;" : "") . "</a>";

                                if ($count) {
                                    echo "<ul class='dropdown-submenu'>";
                                    while ($row = $sub_stmt->fetch()) {
                                        echo "
                                            <li>
                                                <a href='#' class='dropdown-item'>" . $row['name'] . "</a>
                                            </li>";
                                    }
                                    echo "</ul>";
                                }
                                echo "</li>";
                            }
                        } else {
                            echo "
                                <li>
                                    <a href='#' class='dropdown-item'>No category found!</a>
                                </li>";
                        }
                        ?>
                    </ul>
                </li>
                <a href=" contact.html" class="nav-item nav-link">Contact Us</a>
            </ul>
            <div class="d-none d-lg-flex ms-2">

                <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                    <small class="fa fa-search text-body"></small>
                </a>
                <?php if ($loggedin) { ?>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="/medicine/admin">
                        <small class="fa fa-user text-body"></small>
                    </a>
                <?php } else { ?>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="/medicine/admin/login.php">
                        <small class="fa fa-sign-in-alt text-body"></small>
                    </a>
                <?php } ?>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->