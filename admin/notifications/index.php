<?php include "../../components/admin-header.php" ?>
<title>Admin Notifications</title>
</head>

<div class="container-fluid admin_body">
    <div class="row">
        <div class="col-sm-2 p-0">
        <div class="left_pane">
            <div class="heading">
                <!-- <h1>John Okoye</h1> -->
                <img src="https://3malgroup.com/images/logo.png" width="100px" height="auto" class="img-fluid">
            </div>
            <ul class="navbar_nav">
                <li><a href="<?= $adminBase ?>dashboard/"><i class="bi bi-grid"></i> Dashboard</a></li>
                <li ><a href="<?= $adminBase ?>blog/"><i class="bi bi-info-circle"></i> Blog</a></li>
                <li><a href="<?= $adminBase ?>listings/"><i class="bi bi-list-check"></i> Listings</a></li>
                <li><a href="<?= $adminBase ?>case-study/"><i class="bi bi-border-style"></i> Case studies</a></li>
                <li><a href="<?= $adminBase ?>events/"><i class="bi bi-calendar-event"></i> Events</a></li>
                <li><a href="<?= $adminBase ?>webforms/"><i class="bi bi-ui-checks"></i> Webforms </a></li>
                <li><a href="<?= $adminBase ?>settings/"><i class="bi bi-gear"></i> Settings</a></li>
            </ul>
        <ul class="logout_btn">
            <li>
            <a href="/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
        </ul>
        </div>
    </div>
       <div class="col-sm-10">
       <?php include "../../components/admin-nav.php" ?>
       <div class="main_box">
       <div class="heading">
       <div class="row">
            <div class="col-sm-4">
                <h2>Notifications</h2>
            </div>
            <!-- <div class="col-sm-4">
                <div class="search_input"><input placeholder="Search..." type="text" class="form-control"></div>
            </div>
            <div class="col-sm-4">
                <div class="cta_btn text-right"><button class="btn">Add listing</button></div>
            </div> -->
        </div>
       </div>

       <div class="tab-box">

       <div class="box_wrapper">
<div class="d-flex">
    <div class="item_box_1">
        <div class="d-flex">
        <div class="check_box">
                <input type="checkbox">
            </div>
            <!-- <div class="img_box"><img src="https://newprofilepic.photo-cdn.net//assets/images/article/profile.jpg?90af0c8" alt="" class="img-fluid"></div> -->
            <div class="text_box">
                <h2>This is the title of the post</h2>
                <h3>Published by: Jones</h3>
                <p>06 Mar, 2024</p>
            </div>
        </div>
    </div>
    <div class="item_box_2">
    <div class="dropdown dropleft">
                <a class="btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
                </a>
                <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Edit</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Share</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">View</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Send to archive</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Move to trash</a>
                </div>
                </div>
    </div>
</div>
</div>

</div>
       </div>
       </div>
    </div>
</div>

<?php include "../../components/admin-footer.php" ?>
