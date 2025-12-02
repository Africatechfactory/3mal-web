<?php include "../components/header.php"; ?>
<title>3Mal Group | Let's Talk</title>
</head>
<body>
   <?php include "../components/navbar.php" ?>
   <!--Hero section-->
   <div class="hero contact_ui container-fluid">
      <div class="row">
         <div class=" col-md-1 col-lg-1 col-xl-1"></div>
         <div class="col-sm-12 col-12 col-md-10 col-lg-10 col-xl-10">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-12">
                  <div class="content-wrapper">
                     <h1><span> Need help with a digital project?</span> <br>You're in the right place. </h1>
                  </div>
               </div>
               <div class="col-sm-12 col-12 col-md-12 col-lg-6 col-xl-6">
                  <form action="" class="userReachForm" method="post">
                     <div class="form-row">
                        <div class="col-sm-12 form-group">
                           <label for="">I'm interested in...</label> <br>
                           <div class="form-row">
                              <div class="col-sm-12 post_select_pack" hidden>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-6">
                                 <div class="user_pack_select " id="1" target="Product design">
                                    <div class="item">Product design</div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-6">
                                 <div class="user_pack_select " id="2" target="Branding">
                                    <div class="item">Branding</div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-6">
                                 <div class="user_pack_select " id="3" target="Website development">
                                    <div class="item">Website development</div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-6">
                                 <div class="user_pack_select " id="4" target="Design strategy">
                                    <div class="item">Design strategy</div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-6">
                                 <div class="user_pack_select " id="5" target="App development">
                                    <div class="item">App development</div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-6">
                                 <div class="user_pack_select " id="6" target="General enquiry">
                                    <div class="item">General enquiry</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-sm-6">
                           <label for="name">Name or business name</label>
                           <input type="text" id="name" name="name" placeholder="E.g. John Doe's Enterprise" class="form-control raw_input">
                           <input type="hidden" id="enqTimezone" name="timezone">
                        </div>
                        <div class="form-group col-sm-6">
                           <label for="email">Email</label>
                           <input type="email" id="email" name="email" placeholder="E.g. johndoe@mymail.com" class="form-control raw_input">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="msg">Tell us about your project</label>
                        <textarea name="msg" placeholder="Message..." id="msg" class="form-control raw_input" rows="1"></textarea>
                     </div>
                     <div class="form-group">
                        <label for="budget">Project budget(USD)</label>
                        <select name="budget" id="budget" class="custom-select raw_input">
                           <option value="<$5k"><$5k</option>
                           <option value="$5 - 10k">$5 - 10k</option>
                           <option value="$10 - 20k">$10 - 20k</option>
                           <option value="$20 - 30k">$20 - 30k</option>
                           <option value="$30 - 40k">$30 - 40k</option>
                           <option value="$50,000+">$50,000+</option>
                        </select>
                     </div>
                     <div class="">
                        <button class="btn enq_btn">Send enquiry</button>
                     </div>
                     <!-- <label class="footer_label">*your email is completely safe & Secure, No Ads or Spam</label> -->
                  </form>
               </div>
            </div>
         </div>
         <div class=" col-md-1 col-lg-1 col-xl-1"></div>
      </div>
   </div>
   <?php include "../components/footer.php"; ?>
