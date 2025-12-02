<?php include "../../components/admin-header.php" ?>
<title>Admin Events</title>
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
               <li ><a href="<?= $adminBase ?>blog/"><i class="bi bi-info-circle"></i> Blog</a></li>
               <li><a href="<?= $adminBase ?>listings/"><i class="bi bi-list-check"></i> Listings</a></li>
               <li><a href="<?= $adminBase ?>case-study/"><i class="bi bi-border-style"></i> Case studies</a></li>
               <li class="active"><a href="<?= $adminBase ?>events/"><i class="bi bi-calendar-event"></i> Events</a></li>
               <li><a href="<?= $adminBase ?>webforms/"><i class="bi bi-ui-checks"></i> Webforms </a></li>
               <li><a href="<?= $adminBase ?>settings/"><i class="bi bi-gear"></i> Settings</a></li>
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
                     <h2>Events</h2>
                  </div>
                  <div class="col-sm-4">
                     <div class="search_input"><input placeholder="Search..." type="text" class="form-control"></div>
                  </div>
                  <div class="col-sm-4">
                     <div class="cta_btn text-right add_event_cta"><button class="btn">Add event</button></div>
                  </div>
               </div>
            </div>
            <div class="tab-box">
               <div class="d-flex inner_flex">
                  <ul class="nav nav-mobile-role" role="tablist">
                     <li class="nav-item ">
                        <a href="#published" id="bg_inner_1" target="published" class="nav-link active active_event_tab_published "  aria-selected="false" 
                           data-toggle="tab" role="tab">Published</a>
                     </li>
                     <li class="nav-item">
                        <a href="#archive" id="bg_inner_2" target="archive" class="nav-link active_event_tab_archive " aria-selected="false" 
                           data-toggle="tab" role="tab">Archive</a>
                     </li>
                     <li class="nav-item">
                        <a href="#trash" id="bg_inner_3" target="trash" class="nav-link active_event_tab_trash " aria-selected="false" 
                           data-toggle="tab" role="tab">Trash</a>
                     </li>
                  </ul>
               </div>
               <div class="post_data">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="tab-content">
                           <div class="tab-pane fade show active published" id="published" aria-labelledby="bg_inner_1" role="tabpanel" >
                              <div class="innerContent main_innerContent published_event" > 
                              </div>
                           </div>
                           <div class="tab-pane fade archive" id="archive" aria-labelledby="bg_inner_2" role="tabpanel" >
                              <div class="innerContent main_innerContent archived_event" > 
                              </div>
                           </div>
                           <div class="tab-pane fade trash" id="trash" aria-labelledby="bg_inner_3" role="tabpanel" >
                              <div class="innerContent main_innerContent trashed_event" > 
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


<?php 
include "../../components/admin-addData.php";
include "../../components/modal.php";
include "../../components/admin-footer.php";
?>

<script>
const adminBase = "<?= $adminBase ?>";

    $(document).on('click', '.add_event_cta', function(){
    $(".right_action_box").addClass("active");
    $(".fixed_bg").fadeIn(1000);
    $(".add_title").html('Add Event');
    $('.right_action_box .form_box').html(
      `<form class="addEvent">
      <div class="form-group">
          <label for="title">Event Title</label>
          <input type="text" id="title" name="title" placeholder="E.g Lagos Business Week" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="client">Client</label>
          <input type="text" id="client" name="client" placeholder="E.g. John Doe" class="form-control raw_input">
      </div>
      <div class="form-group">
      <label for="client">Project status</label>
     <select name="status" class="custom-select raw_input">
      <option>In-progress</option>
      <option>Completed</option>
      <option>Pending</option>
     </select>
  </div>
      <div class="form-group">
          <label for="location">Location</label>
          <input type="text" id="location" name="location" placeholder="E.g De Range Event Center, Owerri" class="form-control raw_input">
          <input id="eventTimeZone" type="hidden" name="timezone" >
          </div>
      <div class="form-group">
          <label for="images">Upload Image</label>
          <input type="file" hidden id="images" name="images[]" accept="image/*" multiple size="10" class="form-control raw_input">
      </div>
      <div class="form-group">
      <label for="event_date">Event date</label>
      <input type="date" id="event_date" name="event_date" class="form-control raw_input">
  </div>
  
  <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" class="description_box form-control raw_input" rows="2"></textarea>
  </div>
      <div class="form-group mb-0">
          <button type="submit" class="repond_active btn form-control add_event_btn">Submit</button>
      </div>
  </form>
      `
    )
    ClassicEditor
    .create( document.querySelector( '.description_box' ) )
    .catch( error => {
    console.error( error );
    } );
  });
  
  $(document).on('click', '.add_event_btn', function () {
    $('.addEvent').unbind('submit');
    var loader = '<span class="loader"></span>';  
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $('#eventTimeZone').val(timezone);
    $('.addEvent').submit(function (event) {
       event.preventDefault();
       $.ajax({
          url: `${adminBase}models/add_event.php`,
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          beforeSend: function () {
           $('.add_event_btn').html(loader);
          },
          complete: function () {
             $('.add_event_btn').html("Submit");
          },
          success: function (response) {
              $.trim(response);
              if (response == 'successful') {
                  $(".alert p").html("Event submited successfully");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                  $(".raw_input").val(null);
                  $(".ck-content").empty();
                  $(".right_action_box").removeClass("active");
                  $(".fixed_bg").fadeOut(1000);
                  fetchEvents('published', '.published_event');
              } else {
                  $(".alert p").html(response);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
              }
          },
          error: function (xhr, status, error) {
              console.error('Error posting data:', error);
              $(".alert p").html("An error occurred while posting to DB.");
              $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
          }
       });
    });
  });
  
  
   const eventDropdownItems = (postType, dataId) => {
      let items = '';
  
      if (postType === 'archived') {
          items += `<a class="dropdown-item publish_event_btn" target="${dataId}">Publish</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item trash_event_btn" target="${dataId}">Move to trash</a>`;
      } else if (postType === 'published') {
          items += `<a class="dropdown-item archive_event_btn" target="${dataId}">Send to archive</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item trash_event_btn" target="${dataId}">Move to trash</a>`;
      } else if (postType === 'trashed') {
          items += `<a class="dropdown-item publish_event_btn" target="${dataId}">Publish</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item archive_event_btn" target="${dataId}">Send to archive</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item delete_event_btn" target="${dataId}">Delete event</a>`;
      }
  
      return items;
  }; 
   
   function fetchEvents(postType, containerClass) {
      $.ajax({
          url: `${adminBase}models/fetch_event.php?fetch_all_event=${postType}`,
          type: 'GET',
          dataType: 'json',
          beforeSend: function() {
            $(containerClass).html('<p>Fetching data...</p>');
          },
          success: function (response) {
              if (response && response.length > 0) {
                  let dataOutput = '<div class="row">';
                  response.forEach(data => {
                      const { image_url: imageUrl, title, created_date: createdDate, event_id: dataId, formated_title: headerTitle } = data;
                      const dataCard = `
                          <div class="col-sm-12">
                              <div class="box_wrapper data_id_${dataId}">
                                  <div class="d-flex">
                                      <div class="item_box_1">
                                          <div class="d-flex">
                                              <div class="check_box"><input type="checkbox"></div>
                                              <div class="img_box"><img src="${imageUrl}" alt="" class="img-fluid"></div>
                                              <div class="text_box">
                                                  <h2>${title}</h2>
                                                  <h3>Published by: Admin</h3>
                                                  <p>${createdDate}</p>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="item_box_2">
                                          <div class="dropdown dropleft">
                                              <a class="btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                  <i class="bi bi-three-dots-vertical"></i>
                                              </a>
                                              <div class="dropdown-menu">
                                                  <a class="dropdown-item edit_event_btn" target="${dataId}">Edit</a>
                                                  <div class="dropdown-divider"></div>
                                                  <a class="dropdown-item share_share_btn" target="${dataId}">Share</a>
                                                  <div class="dropdown-divider"></div>
                                                  <a class="dropdown-item view_btn" target="_blank" href="/store/${dataId}_${headerTitle}">View</a>
                                                  <div class="dropdown-divider"></div>
                                                 ${eventDropdownItems(postType, dataId)}
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      `;
                      dataOutput += dataCard;
                  });
                  dataOutput += '</div>';
                  $(containerClass).html(dataOutput);
              } else {
                  $(containerClass).html('<p>No event found</p>');
              }
          },
          error: function (xhr, status, error) {
              console.error('Error fetching event:', error);
              $(containerClass).html('<p>No event found</p>');
          }
      });
  }
  
  function fetchEventAction() {
      fetchEvents('published', '.published_event');
  
      $(document).on('click', '.active_event_tab_publish', function () {
          fetchEvents('published', '.published_event');
      });
  
      $(document).on('click', '.active_event_tab_archive', function () {
          fetchEvents('archived', '.archived_event');
      });
  
      $(document).on('click', '.active_event_tab_trash', function () {
          fetchEvents('trashed', '.trashed_event');
      });
  }
  fetchEventAction(); 
  
  
  $(document).on('click', '.edit_event_btn', function(){
      const data_id = $(this).attr('target');
      $(".right_action_box").addClass("active");
      $(".fixed_bg").fadeIn(1000);
      $(".add_title").html('Update case study');
      
      $.ajax({
          url: `${adminBase}models/edit_event_data.php`,
          type: 'GET',
          dataType: 'json',
          data: { data_id: data_id },
           beforeSend: function () {
           $('.right_action_box .form_box').html('<p>Fetching data...</p>');
          },
          success: function (response) {
              if (response) {
                  const { image_url: imageUrl, title, body, event_id: dataId, event_date, status, client, location} = response;
                   $('.right_action_box .form_box').html(
      `<form class="updateEvent">
      <div class="form-group">
          <label for="title">Event Title</label>
          <input type="text" id="title" name="title" value="${title}" placeholder="E.g Lagos business week" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="client">Client</label>
          <input type="text" id="client" name="client" value="${client}" placeholder="E.g. John Doe" class="form-control raw_input">
      </div>
      <div class="form-group">
      <label for="client">Project status</label>
     <select name="status" class="custom-select raw_input">
     <option selected disabled>${status}</option>
      <option>In-progress</option>
      <option>Completed</option>
      <option>Pending</option>
     </select>
  </div>
      <div class="form-group">
          <label for="tags">Tags</label>
          <input type="text" id="tags" name="location" value="${location}" placeholder="E.g Owerri" class="form-control raw_input">
          <input class="timezone" type="hidden" name="timezone" >
          <input  type="hidden" name="data_id" value="${dataId}" >
          </div>
      <!--<div class="form-group">
          <label for="images">Upload Image</label>
          <input type="file" hidden id="images" name="images[]" accept="image/*" multiple size="10" class="form-control raw_input">
      </div> -->
      <div class="form-group">
      <label for="start_date">Event date</label>
      <input type="date" id="start_date" value="${event_date}" name="event_date" class="form-control raw_input">
  </div>
  <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" class="description_box form-control raw_input" rows="2">${body}</textarea>
  </div>
      <div class="form-group mb-0">
          <button type="submit" class="repond_active btn form-control update_event_btn">Submit</button>
      </div>
  </form>
     `
    )
    ClassicEditor
    .create( document.querySelector( '.description_box' ) )
    .catch( error => {
    console.error( error );
    } );
              } else {
                  console.error('No event found');
              }
          },
          error: function (xhr, status, error) {
              console.error('Error fetching event:', error);
          }
      });
  });
  
  
  $(document).on('click', '.update_event_btn', function () {
      $('.updateEvent').unbind('submit');
      var loader = '<span class="loader"></span>';
      var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
      $('.timezone').val(timezone);
    $('.updateEvent').submit(function (event) {
       event.preventDefault();
       $.ajax({
              url: `${adminBase}models/update_event.php`,
              method: "POST",
              data: new FormData(this),
              contentType: false,
              processData: false,
              beforeSend: function () {
                  $('.update_event_btn').html(loader);
              },
              complete: function () {
                  $('.update_event_btn').html("Update");
              },
              success: function (response) {
                  $.trim(response);
                  if (response == 'successful') {
                      $(".alert p").html("Event updated successfully");
                      $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                      $(".raw_input").val(null);
                      $(".ck-content").empty();
                      $(".right_action_box").removeClass("active");
                      $(".fixed_bg").fadeOut(1000);
                      fetchEvents('published', '.published_event');
                  } else {
                      $(".alert p").html(response);
                      $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
                  }
              },
              error: function (xhr, status, error) {
                  console.error('Error posting data:', error);
                  $(".alert p").html("An error occurred while updating event.");
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
              }
          });
      });
  });
  
  
  $(document).on('click', '.archive_event_btn', function(){
    const data_id = $(this).attr('target');
    $.ajax({
        url: `${adminBase}models/update_post_status.php`,
          type: 'GET',
          dataType: 'json',
          data: { archive_event: data_id },
          success: function (response) {
              if (response.success) {
                  $(`.data_id_${data_id}`).css({
                      'background': '#fff'
                  }).fadeOut(700);
                  $(".alert p").html("Event sent to archive successfully");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
              } else {
                  $(".alert p").html(response.error);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
              }
          },
          error: function (xhr, status, error) {
              console.error('Error posting data:', error);
              $(".alert p").html("An error occurred while updating the post status.");
              $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
          }
      });
  });
  
$(document).on('click', '.publish_event_btn', function(){
    const data_id = $(this).attr('target');
    $.ajax({
        url: `${adminBase}models/update_post_status.php`,
          type: 'GET',
          dataType: 'json',
          data: { publish_event: data_id },
          success: function (response) {
              if (response.success) {
                  $(`.data_id_${data_id}`).css({
                      'background': '#fff'
                  }).fadeOut(700);
                  $(".alert p").html("Event published successfully");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
              } else {
                  $(".alert p").html(response.error);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
              }
          },
          error: function (xhr, status, error) {
              console.error('Error posting data:', error);
              $(".alert p").html("An error occurred while updating the post status.");
              $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
          }
      });
  });
  
$(document).on('click', '.trash_event_btn', function(){
    const data_id = $(this).attr('target');
    $.ajax({
        url: `${adminBase}models/update_post_status.php`,
          type: 'GET',
          dataType: 'json',
          data: { trash_event: data_id },
          success: function (response) {
              if (response.success) {
                  $(`.data_id_${data_id}`).css({
                      'background': '#fff'
                  }).fadeOut(700);
                  $(".alert p").html("Event sent to trash successfully");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
              } else {
                  $(".alert p").html(response.error);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
              }
          },
          error: function (xhr, status, error) {
              console.error('Error posting data:', error);
              $(".alert p").html("An error occurred while updating the post status.");
              $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
          }
      });
  });
  
  $(document).on('click', '.delete_event_btn', function () {
      var loader = "<span class='loader'></span>";
      $("#dataModal").modal("show");
      const data_id = $(this).attr('target');
      $("#dataModal .modal-title").html('Delete event');
      $("#dataModal .modal-body").html('<p>Are you sure you want to delete this event? </p>');
      $("#dataModal .modal-footer").html(`
      <button type="button" class="btn  close_modal_btn" data-dismiss="modal" aria-label="Close">Close</button>
      <button type="button" target="${data_id}" class="btn main_delete_action">Delete</button>
      `);
    $(".main_delete_action").click(function () {
       const data_id = $(this).attr('target')
       $.ajax({
            url: `${adminBase}models/delete.php`,
            method: "GET",
            data: { delete_event: data_id },
            beforeSend: function () {
               $('.main_delete_action').html(loader);
            },
            complete: function () {
               $('.main_delete_action').html("Delete");
            },
            success: function (response) {
                $.trim(response);
              if (response == 'successful') {
                  $(`.data_id_${data_id}`).css({
                      'background': '#fff'
                   }).fadeOut(700);
                   $("#dataModal").modal("hide");
                   $(".alert p").html("Event deleted successfully");
                   $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
              } else {
                  $(".alert p").html(response);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
              }
          },
          error: function (xhr, status, error) {
              console.error('Error deleting data:', error);
              $(".alert p").html("An error occurred while deleting data.");
              $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
          }
         });
      })
   });
  
</script>
