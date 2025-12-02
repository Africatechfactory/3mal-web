<div class="fixed_bg"></div>
<div class="right_action_box">
   <div class="container alert-container" style="position: fixed">
      <div class="row">
         <div class="col-sm-3"></div>
         <div class="col-sm-6 text-center">
            <div class="alert alert-success" >
               <p></p>
            </div>
         </div>
         <div class="col-sm-3"></div>
      </div>
   </div>
   <div class="modal_header">
      <div class="row">
         <div class="col-sm-8 col-10">
            <div class="text-box">
               <h2 class="add_title">Responses <span class="row_count"></span></h2>
            </div>
         </div>
         <div class="col-sm-4 col-2">
            <div class="text-box close_btn text-right">
               <i class="bi bi-x-lg"></i>
            </div>
         </div>
      </div>
   </div>
   <div class="modal_body">
      <div class="form_box">
         <form action="" method="post" class="response_form">
            <div class="form-group col-sm-12 pl-0 pr-0">
               <label for="">Your Name</label>
               <input type="text" placeholder="E.g. John Doe" name="name" class="form-control raw_input">
            </div>
            <div class="form-group col-sm-12 pl-0 pr-0">
               <label for="">Your Email</label>
               <input type="email" placeholder="E.g. johndoe@mymail.com" name="email" class="form-control raw_input">
            </div>
            <div class="form-group col-sm-12 pl-0 pr-0">
               <label for="">What are your thoughts</label>
               <textarea name="response" id="" class="form-control comment_box"  rows="5"></textarea>
            </div>
            <input type="text" name="news_id" id="news_id" hidden class="form-control" >
            <input type="text" name="news_url" hidden class="form-control" >
             <input type="hidden" id="commentTimezone" name="timezone">  
            <div class="form-group col-sm-12 pl-0 pr-0 text-right">
               <!-- <p  class="btn repond_active post_response">Respond</p> -->
               <button type="submit" class="form-control btn repond_active post_response">Comment</button>
            </div>
         </form>
      </div>
      <div class="dropdown-divider"></div>
      <div class="response_box">
         <div class="ult_loader">
            <div class="lds-ripple">
               <div></div>
               <div></div>
            </div>
            <div class="loader-text">
            </div>
         </div>
      </div>
   </div>
</div>