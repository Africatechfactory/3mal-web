$(document).ready(function () {
   const skeleton = "<div class='skeleton' id='skeleton'></div>";
   $(".close_btn").click(function () {
      $(".right_action_box").removeClass("active");
      $(".fixed_bg").fadeOut(1000);
   })
   $(".fixed_bg").click(function () {
      $(".right_action_box").removeClass("active");
      $(".fixed_bg").fadeOut(1000);
   })


   $(document).on('click', '.btn-outline-', function (e) {
      var loader = "<span class='loader'></span>";
      var form = $('.appointment_form');
      var formData = new FormData(form[0]);
      if (formData != "") {
         $.ajax({
            url: "../model/post_request.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
               $('.btn-outline-').html(loader);
            },
            complete: function () {
               $('.btn-outline-').html("Send");
            },
            success: function (data) {
               var message = $.trim(data);
               if (message == 'successful') {
                  $(".alert p").html("Message sent successfully, our friendly customer care team will be in touch.");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(10000).fadeOut();
                  $(".raw_input").val(null);
                  $("#get_appointment").modal("hide");
               } else {
                  $(".alert p").html(message);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
               }

            }
         });
      }
      e.preventDefault();
   });

   $(document).on('click', '.post_appointment', function (e) {
      var loader = "<span class='loader'></span>";
      var form = $('.appointment_form');
      var formData = new FormData(form[0]);
      if (formData != "") {
      $.ajax({
         url: "/models/post_appointment.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
               $('.post_appointment').html(loader);
            },
            complete: function () {
               $('.post_appointment').html("Submit");
            },
            success: function (data) {
               var message = $.trim(data);
               alert(message);
               if (message == 'successful') {
                  $(".alert p").html("Message sent successfully, our friendly customer care team will be in touch.");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(10000).fadeOut();
                  $(".raw_input").val(null);
                  $("#get_appointment").modal("hide");
               } else {
                  alert(message);
                  $(".alert p").html(message);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
               }

            }
         });
      }
      e.preventDefault();
   });

   $(document).on('click', '.contact_submit_btn', function (e) {
      var loader = "<span class='loader'></span>";
      var form = $('.contact_form');
      var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
      $('#ctimezone').val(timezone);
      var formData = new FormData(form[0]);
      if (formData != "") {
         $.ajax({
            url: "/models/post_contact.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
               $('.contact_submit_btn').html(loader);
            },
            complete: function () {
               $('.contact_submit_btn').html("Send");
            },
            success: function (data) {
               var message = $.trim(data);
               alert(message);
               if (message == 'successful') {
                  $(".alert p").html("Message sent successfully, our friendly customer care team will be in touch.");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(10000).fadeOut();
                  $(".form_input").val(null);
               } else {
                  alert(message);
                  $(".alert p").html(message);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
               }

            }
         });
      }
      e.preventDefault();
   });


   function fetchCaseStudy() {
      const fetch_caseStudy_home = 'fetch_caseStudy_home=caseStudy_home';
     
      $.ajax({
         url: '/models/fetch_data.php?' + fetch_caseStudy_home,
         type: 'GET',
         dataType: 'json',
         beforeSend: function () {
            $('#caseStudyContainer').html(`
                <div class="row horizontal_row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-12">${skeleton}</div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-12">${skeleton}</div>
                </div>
            `);
            $(`#caseStudyContainer .skeleton`).css({
               'height': '150px',
               'width': '100%'
            }).show();
         },
         success: function (response) {
            if (response && response.length > 0) {
               var eventHTML = '<div class="row">';
               $.each(response, function (index, data) {
                  var imageUrl = data.image_url;
                  var data_id = data.data_id;
                  var title = data.title;
                  var tag = data.tag;
                  var header_title = data.formated_title;
                  var dataCard = `
                         <div class="col-sm-12 col-12 col-md-6 col-lg-6 col-xl-6" data-aos="fade-up">
                     <div class="item_box">
                     <a href="/case_study/${data_id}_${header_title}">
                        <div class="img_box">
                           <img src="${imageUrl}" alt="${title}" class="img-fluid">
                        </div>
                        <div class="text_box">
                           <!--<span class="tagline">${tag}</span>-->
                           <h2>${title}</h2>
                           <a href="/case_study/${data_id}_${header_title}"><span>View case study</span> <span class="icon-box"><i class="bi bi-arrow-up-right"></i></span></a>
                        </div>
                        </a>
                     </div>
                  </div>`;
                  eventHTML += dataCard;
               });
               eventHTML += '</div>';
               $('#caseStudyContainer').html(eventHTML);
            } else {
               $('#caseStudyContainer').html('<p>No case study found</p>');
            }
         },
         error: function (xhr, status, error) {
            console.error('Error fetching case study:', error);
             $('#caseStudyContainer').html(`<p>${xhr.responseText}</p>`);
         }
      });

      const filterCategory = $("#get_category").val();
   let ajaxUrl = '/models/fetch_data.php?';
    
    if (filterCategory !== "") {
        ajaxUrl += 'filterCategory=' + filterCategory;
    } else {
        ajaxUrl += 'fetch_all_caseStudy=caseStudy_all';
    }

    $.ajax({
        url: ajaxUrl,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $('#allCaseStudyContainer').html(`
                <div class="row horizontal_row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-12">${skeleton}</div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-12">${skeleton}</div>
                </div>
            `);
            $(`#allCaseStudyContainer .skeleton`).css({
               'height': '150px',
               'width': '100%'
            }).show();
        },
        success: function (response) {
            if (response && response.length > 0) {
                let eventHTML = '<div class="row">';
                $.each(response, function (index, data) {
                    const imageUrl = data.image_url;
                    const data_id = data.data_id;
                    const title = data.title;
                    const header_title = data.formated_title;
                    const dataCard = `
                        <div class="col-sm-12 col-12 col-md-6 col-lg-6 col-xl-6" data-aos="fade-up">
                            <div class="item_box">
                                <a href="/case_study/${data_id}_${header_title}">
                                    <div class="img_box">
                                        <img src="${imageUrl}" alt="${title}" class="img-fluid">
                                    </div>
                                    <div class="text_box">
                                        <h2>${title}</h2>
                                        <a href="/case_study/${data_id}_${header_title}"><span>View case study</span> <span class="icon-box"><i class="bi bi-arrow-up-right"></i></span></a>
                                    </div>
                                </a>
                            </div>
                        </div>`;
                    eventHTML += dataCard;
                });
                eventHTML += '</div>';
                $('#allCaseStudyContainer').html(eventHTML);
            } else {
                $('#allCaseStudyContainer').html('<p>No case studies found</p>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching case studies:', error);
            $('#allCaseStudyContainer').html(`<p>${xhr.responseText}</p>`);
        }
    });
   }

   function fetchBlog() {
      const fetch_posts_home = 'fetch_posts_home=posts_home';
      const fetch_all_posts = 'fetch_all_posts=posts_all';
      $.ajax({
         url: '/models/fetch_data.php?' + fetch_posts_home,
         type: 'GET',
         dataType: 'json',
         beforeSend: function () {
            $('#homePostContainer').html(`
                <div class="row horizontal_row">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-12">${skeleton}</div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-12">${skeleton}</div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-12">${skeleton}</div>
                </div>
            `);
            $(`#homePostContainer .skeleton`).css({
               'height': '150px',
               'width': '100%'
            }).show();
         },
         success: function (response) {
            if (response && response.length > 0) {
               var dataOutput = '<div class="row">';
               $.each(response, function (index, data) {
                  var imageUrl = data.image_url;
                  var title = data.title;
                  var createdDate = data.created_date;
                  var header_title = data.formated_title;
                  var dataCard = `
                  <div class="col-sm-12 col-12 col-md-6 col-lg-4 col-xl-4" data-aos="fade-up">
                     <div class="box_wrapper">
                        <div class="img_box"><img src="${imageUrl}" alt="${title}" class="img-fluid"></div>
                        <div class="text_box">
                          <p class="date">${createdDate}</p>
                           <h2>${title}</h2>
                          <a href="/article/${data.blog_id}_${header_title}">Read more <span><i class="bi bi-arrow-up-right"></i></span></a>
                        </div>
                     </div>
                  </div>
                       `;
                  dataOutput += dataCard;
               });
               dataOutput += '</div>';
               $('#homePostContainer').html(dataOutput);
            } else {
               $('#homePostContainer').html('<p>No Post found</p>');
            }
         },
         error: function (xhr, status, error) {
            console.error('Error fetching posts:', error);
             $('#homePostContainer').html(`<p>${xhr.responseText}</p>`);
         }
      });

      $.ajax({
         url: '/models/fetch_data.php?' + fetch_all_posts,
         type: 'GET',
         dataType: 'json',
         beforeSend: function () {
            $('#postContainer').html(`
                <div class="row horizontal_row">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-12">${skeleton}</div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-12">${skeleton}</div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-12">${skeleton}</div>
                </div>
            `);
            $(`#postContainer .skeleton`).css({
               'height': '150px',
               'width': '100%'
            }).show();
         },
         success: function (response) {
            if (response && response.length > 0) {
               var dataOutput = '<div class="row">';
               $.each(response, function (index, data) {
                  var imageUrl = data.image_url;
                  var title = data.title;
                  var createdDate = data.created_date;
                  var header_title = data.formated_title;
                  var dataCard = `
                   <div class="col-sm-12 col-12 col-md-6 col-lg-4 col-xl-4" data-aos="fade-up">
                     <div class="box_wrapper">
                        <div class="img_box"><img src="${imageUrl}" alt="${title}" class="img-fluid"></div>
                        <div class="text_box">
                          <p class="date">${createdDate}</p>
                           <h2>${title}</h2>
                          <a href="/article/${data.blog_id}_${header_title}">Read more <span><i class="bi bi-arrow-up-right"></i></span></a>
                        </div>
                     </div>
                  </div>
                       `;
                  dataOutput += dataCard;
               });
               dataOutput += '</div>';
               $('#postContainer').html(dataOutput);
            } else {
               $('#postContainer').html('<p>No Post found</p>');
            }
         },
         error: function (xhr, status, error) {
            console.error('Error fetching posts:', error);
             $('#postContainer').html(`<p>${xhr.responseText}</p>`);
         }
      });
   }


   $('.card-header').click(function () {
      $(this).find('.card_header_icon').toggleClass('rotate');
      $('.card-header').not(this).find('.card_header_icon').removeClass('rotate');
   });

   var swiper = new Swiper('.client .swiper-container', {
      effect: 'coverflow',
      spaceBetween: 20,
      centeredSlides: false,
      loop: false,
      grabCursor: true,
      speed: 1500,
      slidesPerView: 'auto',
      coverflowEffect: {
         rotate: 0,
         stretch: 10,
         depth: 250,
         modifier: 0,
         slideShadows: false,
      },
      autoplay: {
         delay: 3500,
         disableOnInteraction: false,
      },
      keyboard: {
         enabled: true,
      },
      pagination: {
         el: '.swiper-pagination',
         clickable: true,
         dynamicBullets: true,
      },
      navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
      },
   });

   var swiper = new Swiper('.testimonial_wrapper .swiper-container', {
      effect: 'coverflow',
      // spaceBetween: 40,
      centeredSlides: false,
      loop: false,
      grabCursor: true,
      speed: 1500,
      slidesPerView: 'auto',
      coverflowEffect: {
         rotate: 0,
         stretch: 10,
         depth: 250,
         modifier: 0,
         slideShadows: false,
      },
      autoplay: {
         delay: 3500,
         disableOnInteraction: false,
      },
      keyboard: {
         enabled: true,
      },
      pagination: {
         el: '.swiper-pagination',
         clickable: true,
         dynamicBullets: true,
      },
      navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
      },
   });

   $(document).on('click', '.user_pack_select', function () {
      var id = $(this).attr("id");
      var target = $(this).attr("target");

      $(".post_select_pack").append(`
      <div class="form-check form-check-inline check_box_${id}">
        <input name="user_interest[]" checked type="checkbox" id="input_${target}" class="form-check-input raw_input new_input_val input_${id}" value="${target}">
        <label class="form-check-label" for="${target}">${target}</label>
      </div>
    `);

      $(this).addClass("active");
   });

   $(document).on('click', '.user_pack_select.active', function () {
      var id = $(this).attr("id");
      $(this).removeClass("active");

      $(`.input_${id}`).remove();
      $(`.check_box_${id}`).remove();
   });


   $(document).on('click', '.subscribe_btn', function (e) {
      var loader = "<span class='loader'></span>";
      var form = $('.newletter_request');
      var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
      $('#timezone').val(timezone);
      var formData = new FormData(form[0]);
      if (formData != "") {
         $.ajax({
            url: "/models/post_newsletter.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
               $('.subscribe_btn').html(loader);
            },
            complete: function () {
               $('.subscribe_btn').html("Subscribe");
            },
            success: function (data) {
               var message = $.trim(data);
               var myArray = message.split(" ");
               var success = myArray[0];
               let email = myArray[1];
               if (success == 'successful') {
                  $(".alert p").html(`Your mail ${email} has been submitted successfully.`);
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(10000).fadeOut();
                  $(".raw_input").val(null);
               } else {
                  $(".alert p").html(message);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
               }

            }
         });
      }
      e.preventDefault();
   });

   $(document).on('click', '.enq_btn', function () {
      $('.userReachForm').unbind('submit');
      var loader = '<span class="loader"></span>';
      var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
      $('#enqTimezone').val(timezone);
      $('.userReachForm').submit(function (event) {
         event.preventDefault();
         $.ajax({
            url: "/models/post_enquiry.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
               $('.enq_btn').html(loader);
            },
            complete: function () {
               $('.enq_btn').html("Send enquiry");
            },
            success: function (data) {
               var message = $.trim(data);
               if (message == "successful") {
                  $(".alert p").html("Enquiry sent successfully");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                  $(".raw_input").val(null);
                  $('.user_pack_select').removeClass("active");
                  $(".post_select_pack").empty();
               } else {
                  $(".alert p").html(message);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
               }
            }
         });
      });
   });

   fetchCaseStudy();
   fetchBlog();

});
