<?php include "../../components/admin-header.php" ?>
<title>Admin Webforms</title>
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
                <li><a href="https://3malgroup.com/admin/dashboard/"><i class="bi bi-grid"></i> Dashboard</a></li>
                <li ><a href="https://3malgroup.com/admin/blog/"><i class="bi bi-info-circle"></i> Blog</a></li>
                <li><a href="https://3malgroup.com/admin/listings/"><i class="bi bi-list-check"></i> Listings</a></li>
                <li><a href="https://3malgroup.com/admin/case-study/"><i class="bi bi-border-style"></i> Case studies</a></li>
                <li><a href="https://3malgroup.com/admin/events/"><i class="bi bi-calendar-event"></i> Events</a></li>
                <li class="active"><a href="https://3malgroup.com/admin/webforms/"><i class="bi bi-ui-checks"></i> Webforms </a></li>
                <li><a href="https://3malgroup.com/admin/settings/"><i class="bi bi-gear"></i> Settings</a></li>
            </ul>
        <ul class="logout_btn">
            <li>
            <a href="https://3malgroup.com/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
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
                <h2>Webforms</h2>
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

<div class="d-flex inner_flex">
<ul class="nav nav-mobile-role" role="tablist">  
<li class="nav-item ">
<a href="#published" id="bg_inner_1" target="published" class="nav-link active active_tab_published "  aria-selected="false" 
data-toggle="tab" role="tab">Contact form</a>
</li>
<li class="nav-item">
<a href="#archive" id="bg_inner_2" target="archive" class="nav-link active_tab_archive " aria-selected="false" 
data-toggle="tab" role="tab">Newsletter</a>
</li> 
<li class="nav-item">
<a href="#trash" id="bg_inner_3" target="trash" class="nav-link active_tab_trash " aria-selected="false" 
data-toggle="tab" role="tab">Quote</a>
</li> 
</ul>
</div>


<div class="post_data">
<div class="row">
<div class="col-sm-12">
<div class="tab-content">
<div class="tab-pane fade show active published" id="published" aria-labelledby="bg_inner_1" role="tabpanel" >
<div class="innerContent main_innerContent " > 

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
<div class="tab-pane fade archive" id="archive" aria-labelledby="bg_inner_2" role="tabpanel" >
<div class="innerContent main_innerContent" > 

</div>
</div>
<div class="tab-pane fade trash" id="trash" aria-labelledby="bg_inner_3" role="tabpanel" >
<div class="innerContent main_innerContent " > 

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
</div>

<?php include "../../components/admin-footer.php" ?>