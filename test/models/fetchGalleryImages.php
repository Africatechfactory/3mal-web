<?php include "../database/connect.php"; 
   if(isset($_POST['image_id'])){
       $img_id = $_POST['image_id'];
   ?>
<div class=" ">
   <div  class="carousel slide" id="gallery_control" data-ride="carousel" data-interval="5000">
      <div class="carousel-inner" role="listbox">
         <?php
            $select="SELECT * FROM image_gallery WHERE image_id='$img_id' ORDER BY id DESC";
            $result_select=mysqli_query($mysqli,$select) or die(mysqli_error($mysqli));
            $num_select=mysqli_num_rows($result_select);
            $q=0;
            if($num_select>0){
            while($row = mysqli_fetch_assoc($result_select)){
            $id=$row['id'];
                  $image_path=$row['image_path'];
                  $image_title=$row['image_title'];
            	if($q==0){
            		$active='active';
            	}else{
            		$active='';
            	}
            ?>
         <div class="carousel-item <?php echo $active ?>" >
            <div class="row">
               <div class="col-sm-12 ">
                  <div class="image-box">
                     <div class="image_wrapper" style="background-image: url(<?php echo $image_path; ?>);"></div>
                  </div>
               </div>
            </div>
         </div>
         <?php
            $q++;
            }
            }
            ?>
         <!-- Left and right controls -->
         <div class="">
            <div class="left-chevron">
               <a class="left carousel-control " href="#gallery_control" role="button" data-slide="prev">
               <i class="las la-angle-left"></i>
               <span class="sr-only">Previous</span>
               </a>
            </div>
            <div class="right-chevron">
               <a class="right carousel-control" href="#gallery_control" role="button" data-slide="next">
               <i class="las la-angle-right"></i>
               <span class="sr-only">Next</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   mysqli_close($mysqli);
   }
   ?>
