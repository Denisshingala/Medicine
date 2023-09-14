<!-- topbar -->
<div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="full">
            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
            <div class="logo_section">
                <a href="index.php"><img class="img-responsive" src="<?php echo (isset($data['company_logo']) && $data['company_logo'] && $data['company_logo'] !== "" ? $domain_name . $data['company_logo'] : $domain_name . "/img/default_logo.png") ?>" alt="site_logo" /></a>
            </div>
            <div class="right_topbar">
                <div class="icon_info">
                    <ul class="user_profile_dd">
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="<?php echo (isset($data['owner_photo']) && $data['owner_photo'] && $data['owner_photo '] !== "" ? $domain_name . $data['owner_photo'] : $domain_name . "/img/default_profile.png") ?>" alt="Profile photo" /><span class="name_user"><?php echo (isset($data['owner_name']) && $data['owner_name'] && $data['owner_name '] !== "" ? $domain_name . $data['owner_name'] : "Admin name") ?></span></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="profile.php">My Profile</a>
                                <a class="dropdown-item" href="<?php echo $domain_name; ?>/admin/logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- end topbar -->