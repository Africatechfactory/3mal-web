<?php 
if(isset($_GET['category'])){
   $category = $_GET['category'];
}
else {
   $category = '';
}
include "../components/header.php";
?>
<title>Case Study | 3Mal Group</title>
</head>
<body>
   <input type="hidden" value="<?= $category; ?>" id="get_category">
   <!--Navigation-->
   <?php include "../components/navbar.php" ?>   
   <!--Page Header-->
   <div class="container-fluid page_header">
      <div class="row">
      <div class="col-md-1 col-lg-1 col-xl-1"></div>
      <div class="col-sm-12 col-md-10 col-lg-10 col-xl-10 col-12">
            <div class="breadcrumbs">
               <a href="../">Home Page</a> <span>/</span> <a class="inactive">Case Study</a>
            </div>
            <div class="text_box">
               <h1>Our works speak for themselves</h1>
            </div>
         </div>
         <div class="col-md-1 col-lg-1 col-xl-1"></div>
      </div>
   </div>
   <!--Case Studies-->
   <div class="case-study-wrapper data-page container-fluid">
      <div class="row">
      <div class="col-md-1 col-lg-1 col-xl-1"></div>
      <div class="col-sm-12 col-md-10 col-lg-10 col-xl-10 col-12">
      <div class="case-wrapper">
    <div class="row">
        <div class="col-sm-12 col-12">
            <?php
            if (isset($_GET['category'])) {
                echo '<div class="btn-wrapper"><a href="https://test.3malgroup.com/case-study/?category=all" class="active_btn">All Projects</a></div>';
            }
            ?>
            <!-- Fetch all case studies -->
            <div id="allCaseStudyContainer"></div>
        </div>
    </div>
</div>

         </div>
         <div class="col-md-1 col-xl-1 col-lg-`"></div>
      </div>
   </div>
   <!--Footer-->
   <?php include "../components/footer.php" ?>