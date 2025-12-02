<?php include "../components/header.php" ?>
<title>Contact | 3Mal Group</title>
</head>
<body>
   <!--Navigation-->
   <?php include "../components/navbar.php" ?>   
   <section class="contact_hero">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 ">
               <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-1"></div>
                  <div class="col-sm-12 col-12 col-md-10 col-xl-4 col-lg-4">
                     <div class="text-box text-center">
                        <h2>Get in touch!</h2>
                        <p>We are always happy to answer any questions and assist you in every way we can. 
                           Please feel free to contact us anytime.
                        </p>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-1"></div>
               </div>
               <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-2"></div>
                  <div class="col-sm-12 col-12 col-xl-4 col-lg-4 col-md-8">
                     <div class="contact_info_box text-center">
                        <p><a href="tel:+2348066010359">+234 806 601 0359</a> | 
                           <a href="tel:+2347030050512">+234 703 005 0512</a>
                        </p>
                        <p><a href="mailto:info@3malgroup.com">info@3malgroup.com</a> | <a href="mailto:3mal.official@gmail.com">3mal.official@gmail.com</a></p>
                        
                       
                        <div class="contact_social_pack">
                           <a href="https://www.facebook.com/3MALOFFICIAL?mibextid=ZbWKwL" target="_blank"><i class="bi bi-facebook"></i></a>
                           <a href="https://www.instagram.com/3mal_official?igsh=MTRzY3RzcjEzOW83aw==" target="_blank"><i class="bi bi-instagram"></i></a>
                           <a href="https://x.com/3mal_official?t=iWvRIQR8mRYJ729le5xxnA&s=09" target="_blank"><i class="bi bi-twitter-x"></i></a>
                           <a href="https://www.linkedin.com/company/3mal-group/" target="_blank"><i class="bi bi-linkedin"></i></a>
                           <!--<a href="https://wa.me/+2348100017925/" target="_blank"><i class="bi bi-whatsapp"></i></a>-->
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-2"></div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <div class="contact_box">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
               <div class="form-box">
                  <h2 >Leave a message</h2>
                  <p class="echo_msg"></p>
                  <form action="" method="post" class="contact_form">
                     <div class="form-row">
                        <div class="form-group col-sm-4">
                           <input type="text" name="name" class="form-control form_input" placeholder="Name &amp; surname">
                        </div>
                        <div class="form-group col-sm-4">
                           <input type="email" name="email" class="form-control form_input" placeholder="Email">
                        </div>
                        <div class="form-group col-sm-4">
                           <input type="tel" name="phone" class="form-control form_input" placeholder="Phone number.">
                           <input type="hidden" id="ctimezone" name="ctimezone">  
                     </div>
                     </div>
              
                     <div class="form-row">
                        <div class="form-group col-sm-12">
                           <textarea name="message" class="form-control form_text form_input" id="" placeholder="Your message"  rows="3"></textarea>
                        </div>
                     </div>
                     <div class="form-group"><button type="submit"  class="btn submit_btn contact_submit_btn">Submit</button></div>
                  </form>
               </div>
            </div>
            <div class="col-sm-1"></div>
         </div>
      </div>
   </div>
   <!--Footer-->
   <?php include "../components/footer.php" ?>