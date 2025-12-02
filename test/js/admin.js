$(document).ready(function(){
    
        //Pick Multiple images
        if (window.File && window.FileList && window.FileReader) {
          $("#productImg").on("change", function(e) {
            alert('clicked');
            let files = e.target.files,
              filesLength = files.length;
            for (let i = 0; i < filesLength; i++) {
              let f = files[i];
              let fileReader = new FileReader();
              fileReader.onload = (function(e) {
                let file = e.target;
            
                  let showImg = $( "<img class=\"imageThumb\" width='100px' height='auto' src=\"" + e.target.result + "\" />");
                  $(".img_display").html(showImg);     
              });
              fileReader.readAsDataURL(f);
            }
          });
        } else {
          alert("Error");
        }

        $(".close_btn").click(function () {
          $(".right_action_box").removeClass("active");
          $(".fixed_bg").fadeOut(1000);
       })
       $(".fixed_bg").click(function () {
          $(".right_action_box").removeClass("active");
          $(".fixed_bg").fadeOut(1000);
       })

      

       const dataLoader = `
<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <span class='loader' style='border: 4px solid var(--brand_color)'></span>
</div>
`;

      




});