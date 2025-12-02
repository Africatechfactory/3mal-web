<?php include "../../components/admin-header.php" ?>
<title>Admin Settings</title>
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
                <li><a href="<?= $adminBase ?>blog/"><i class="bi bi-info-circle"></i> Blog</a></li>
                <li><a href="<?= $adminBase ?>listings/"><i class="bi bi-list-check"></i> Listings</a></li>
                <li><a href="<?= $adminBase ?>case-study/"><i class="bi bi-border-style"></i> Case studies</a></li>
                <li><a href="<?= $adminBase ?>events/"><i class="bi bi-calendar-event"></i> Events</a></li>
                <li><a href="<?= $adminBase ?>webforms/"><i class="bi bi-ui-checks"></i> Webforms </a></li>
                <li class="active"><a href="<?= $adminBase ?>settings/"><i class="bi bi-gear"></i> Settings</a></li>
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
                <h2>Settings</h2>
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
<a href="#edit_profile" id="bg_inner_1" target="edit_profile" class="nav-link active active_tab_edit_profile "  aria-selected="false" 
data-toggle="tab" role="tab">Edit profile</a>
</li>
<li class="nav-item">
<a href="#add_user" id="bg_inner_2" target="add_user" class="nav-link active_tab_add_user " aria-selected="false" 
data-toggle="tab" role="tab">Add user</a>
</li> 
<li class="nav-item">
<a href="#update_password" id="bg_inner_3" target="update_password" class="nav-link active_tab_update_password " aria-selected="false" 
data-toggle="tab" role="tab">Update password</a>
</li> 
</ul>
</div>


<div class="post_data">
<div class="row">
<div class="col-sm-12">
<div class="tab-content">
<div class="tab-pane fade show active edit_profile" id="edit_profile" aria-labelledby="bg_inner_1" role="tabpanel" >
<div class="innerContent main_innerContent " > 

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="box_wrapper">
            <div class="img_display">
            <img class="img-fluid" src="" alt="user profile" />
            </div>
            <form action="" class="edit_admin_profile" method="post">
                <div class="form-group">
                <div class="select_img">
                <label for="productImg">Upload Image</label>
                <input type="file" accept="image/*" id="productImg" name="images"  />
                </div>
                </div>
                <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="fname">First name</label>
                    <input type="text" id="fname" name="firstname" placeholder="E.g. John" class="form-control">
                </div>
                <div class="form-group col-sm-12">
                    <label for="lname">Last name</label>
                    <input type="text" id="lname" name="lastname" placeholder="E.g. Doe" class="form-control">
                </div>
                </div>
             
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="E.g. johndoe@mymail.com" class="form-control">
                </div>
                <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" placeholder="E.g. +234 809---" class="form-control">
                </div>
                <div class="form-group col-sm-12">
                    <label for="dob">Date of birth</label>
                    <input type="date" id="dob" name="dob"  class="form-control">
                </div>
                </div>
              
                <div class="form-group">
                    <button class="form-control btn update_profile" type="submit">Update profile</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

</div>
</div>
<div class="tab-pane fade add_user" id="add_user" aria-labelledby="bg_inner_2" role="tabpanel" >
<div class="innerContent main_innerContent" > 

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div class="box_wrapper">
            <div class="img_display">
            <img class="img-fluid" src="" alt="user profile" />
            </div>
            <form action="" class="add_admin_profile" method="post">
                <div class="form-group">
                <div class="select_img">
                <label for="productImg">Add Image</label>
                <input type="file" accept="image/*" id="productImg" name="images"  />
                </div>
                </div>
                <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="fname">First name</label>
                    <input type="text" id="fname" name="firstname" placeholder="E.g. John" class="form-control">
                </div>
                <div class="form-group col-sm-12">
                    <label for="lname">Last name</label>
                    <input type="text" id="lname" name="lastname" placeholder="E.g. Doe" class="form-control">
                </div>
                </div>
             
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="E.g. johndoe@mymail.com" class="form-control">
                </div>
                <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" placeholder="E.g. +234 809---" class="form-control">
                </div>
                <div class="form-group col-sm-12">
                    <label for="dob">Date of birth</label>
                    <input type="date" id="dob" name="dob"  class="form-control">
                </div>
                </div>
              
                <div class="form-group">
                    <button class="form-control btn add_admin" type="submit">Add admin</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

</div>
</div>
<div class="tab-pane fade update_password" id="update_password" aria-labelledby="bg_inner_3" role="tabpanel" >
<div class="innerContent main_innerContent " > 

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div class="box_wrapper">    
            <form action="" class="edit_admin_password" method="post">     
                <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="oldpassword">Old password</label>
                    <input type="password" id="oldpassword" name="oldpassword" placeholder="***" class="form-control">
                </div>
                <div class="form-group col-sm-12">
                    <label for="newpassword">New password</label>
                    <input type="password" id="newpassword" name="newpassword" placeholder="***" class="form-control">
                </div>
                </div>
             
                <div class="form-group">
                    <label for="confirmpassword">Confirm password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" placeholder="***" class="form-control">
                </div>
              
                <div class="form-group">
                    <button class="form-control btn update_password" type="submit">Update password</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>
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
</div>

<?php include "../../components/admin-footer.php" ?>
