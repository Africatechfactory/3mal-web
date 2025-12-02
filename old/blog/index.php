<?php include "../components/header.php" ?>
<title>Blog | 3Mal Group</title>
</head>
<body>
   <!--Navigation-->
   <?php include "../components/navbar.php" ?>   
   <!--Page Header-->
   <div class="container-fluid page_header">
      <div class="row">
         <div class="col-md-1 col-lg-2 col-xl-2"></div>
         <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8 col-12">
            <div class="breadcrumbs">
               <a href="../">Home Page</a> <span>/</span> <a class="inactive">Blog</a>
            </div>
            <div class="text_box">
               <h1>Insights, news, articles, read it all.</h1>
            </div>
         </div>
         <div class="col-md-1 col-lg-2 col-xl-2"></div>
      </div>
   </div>
   <!--Blog-->
   <div class="blog container-fluid">
      <div class="row">
         <div class="col-md-1 col-xl-2 col-lg-2"></div>
         <div class="col-sm-12 col-12 col-md-10 col-lg-8 col-xl-8">
            <!--Fetch all Blog Post -->
            <div id="postContainer"></div>
         </div>
         <div class="col-md-1 col-xl-2 col-lg-2"></div>
      </div>
   </div>
   <!--Footer-->
   <?php include "../components/footer.php" ?>
