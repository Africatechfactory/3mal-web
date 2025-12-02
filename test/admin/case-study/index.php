<?php include "../../components/admin-header.php" ?>
<title>Admin Case Study</title>
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
               <li><a href="https://3malgroup.com/admin/dashboard/"><i class="bi bi-grid"></i> Dashboard</a></li>
               <li ><a href="https://3malgroup.com/admin/blog/"><i class="bi bi-info-circle"></i> Blog</a></li>
               <li><a href="https://3malgroup.com/admin/listings/"><i class="bi bi-list-check"></i> Listings</a></li>
               <li class="active"><a href="https://3malgroup.com/admin/case-study/"><i class="bi bi-border-style"></i> Case studies</a></li>
               <li><a href="https://3malgroup.com/admin/events/"><i class="bi bi-calendar-event"></i> Events</a></li>
               <li><a href="https://3malgroup.com/admin/webforms/"><i class="bi bi-ui-checks"></i> Webforms </a></li>
               <li><a href="https://3malgroup.com/admin/settings/"><i class="bi bi-gear"></i> Settings</a></li>
            </ul>
            <ul class="logout_btn">
               <li>
                  <a href="https://3malgroup.com/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
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
                     <h2>Case Study</h2>
                  </div>
                  <div class="col-sm-4">
                     <div class="search_input"><input placeholder="Search..." type="text" class="form-control"></div>
                  </div>
                  <div class="col-sm-4">
                     <div class="cta_btn text-right add_caseStudy_cta"><button class="btn">Add case study</button></div>
                  </div>
               </div>
            </div>
            <div class="tab-box">
               <div class="d-flex inner_flex">
                  <ul class="nav nav-mobile-role" role="tablist">
                     <li class="nav-item ">
                        <a href="#published" id="bg_inner_1" target="published" class="nav-link active active_casestudy_tab_publish "  aria-selected="false" 
                           data-toggle="tab" role="tab">Published</a>
                     </li>
                     <li class="nav-item">
                        <a href="#archive" id="bg_inner_2" target="archive" class="nav-link active_casestudy_tab_archive " aria-selected="false" 
                           data-toggle="tab" role="tab">Archive</a>
                     </li>
                     <li class="nav-item">
                        <a href="#trash" id="bg_inner_3" target="trash" class="nav-link active_casestudy_tab_trash " aria-selected="false" 
                           data-toggle="tab" role="tab">Trash</a>
                     </li>
                  </ul>
               </div>
               <div class="post_data">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="tab-content">
                           <div class="tab-pane fade show active published" id="published" aria-labelledby="bg_inner_1" role="tabpanel" >
                              <div class="innerContent main_innerContent published_casestudy" > 
                              </div>
                           </div>
                           <div class="tab-pane fade archive" id="archive" aria-labelledby="bg_inner_2" role="tabpanel" >
                              <div class="innerContent main_innerContent archived_casestudy" > 
                              </div>
                           </div>
                           <div class="tab-pane fade trash" id="trash" aria-labelledby="bg_inner_3" role="tabpanel" >
                              <div class="innerContent main_innerContent trashed_casestudy" > 
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
    $(document).on('click', '.add_caseStudy_cta', function(){
    $(".right_action_box").addClass("active");
    $(".fixed_bg").fadeIn(1000);
    $(".add_title").html('Add Case Study');
    $('.right_action_box .form_box').html(
      `<form class="addCaseStudy">
      <div class="form-group">
          <label for="title">Project Title</label>
          <input type="text" id="title" name="title" placeholder="E.g Mobile app development for XYZ" class="form-control raw_input">
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
          <label for="tags">Tags</label>
          <input type="text" id="tags" name="tags" placeholder="E.g Branding, UI/UX" class="form-control raw_input">
          <input id="caseStudyTimeZone" type="hidden" name="timezone" >
          </div>
      <div class="form-group">
          <label for="images">Upload Image</label>
          <input type="file" hidden id="images" name="images[]" accept="image/*" multiple size="10" class="form-control raw_input">
      </div>
      <div class="form-group">
      <label for="start_date">Start date</label>
      <input type="date" id="start_date" name="start_date" class="form-control raw_input">
  </div>
  <div class="form-group">
  <label for="end_date">End date</label>
  <input type="date" id="end_date" name="end_date" class="form-control raw_input">
  </div>
  <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" class="description_box form-control raw_input" rows="2"></textarea>
  </div>
      <div class="form-group mb-0">
          <button type="submit" class="repond_active btn form-control add_caseStudy_btn">Submit</button>
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
  
  $(document).on('click', '.add_caseStudy_btn', function () {
    $('.addCaseStudy').unbind('submit');
    var loader = '<span class="loader"></span>';  
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $('#caseStudyTimeZone').val(timezone);
    $('.addCaseStudy').submit(function (event) {
       event.preventDefault();
       $.ajax({
          url: "https://3malgroup.com/admin/models/add_case_study.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          beforeSend: function () {
           $('.add_caseStudy_btn').html(loader);
          },
          complete: function () {
             $('.add_caseStudy_btn').html("Submit");
          },
          success: function (response) {
              $.trim(response);
              if (response == 'successful') {
                  $(".alert p").html("Case study submited successfully");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                  $(".raw_input").val(null);
                  $(".ck-content").empty();
                  $(".right_action_box").removeClass("active");
                  $(".fixed_bg").fadeOut(1000);
                  fetchCaseStudy('published', '.published_casestudy');
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

  const casestudyDropdownItems = (postType, dataId) => {
    let items = '';

    if (postType === 'archived') {
        items += `<a class="dropdown-item publish_casestudy_btn" target="${dataId}">Publish</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item trash_casestudy_btn" target="${dataId}">Move to trash</a>`;
    } else if (postType === 'published') {
        items += `<a class="dropdown-item archive_casestudy_btn" target="${dataId}">Send to archive</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item trash_casestudy_btn" target="${dataId}">Move to trash</a>`;
    } else if (postType === 'trashed') {
        items += `<a class="dropdown-item publish_casestudy_btn" target="${dataId}">Publish</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item archive_casestudy_btn" target="${dataId}">Send to archive</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item delete_casestudy_btn" target="${dataId}">Delete case study</a>`;
    }

    return items;
};

function fetchCaseStudy(postType, containerClass) {
    $.ajax({
        url: `https://3malgroup.com/admin/models/fetch_casestudy.php?fetch_all_casestudy=${postType}`,
        type: 'GET',
        dataType: 'json',
        beforeSend: function (){
            $(containerClass).html('<p>Fetching data...</p>');
        },
        success: function (response) {
            if (response && response.length > 0) {
                let dataOutput = '<div class="row">';
                response.forEach(data => {
                    const { image_url: imageUrl, title, created_date: createdDate, data_id: dataId, formated_title: headerTitle } = data;
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
                                                <a class="dropdown-item edit_casestudy_btn" target="${dataId}">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item share_casestudy_btn" target="${dataId}">Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item view_btn" target="_blank" href="https://3malgroup.com/store/${dataId}_${headerTitle}">View</a>
                                                <div class="dropdown-divider"></div>
                                               ${casestudyDropdownItems(postType, dataId)}
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
                $(containerClass).html('<p>No case study found</p>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching case study:', error);
            $(containerClass).html('<p>No case study found </p>');
        }
    });
}

function fetchCaseStudyAction() {
    fetchCaseStudy('published', '.published_casestudy');

    $(document).on('click', '.active_casestudy_tab_publish', function () {
        fetchCaseStudy('published', '.published_casestudy');
    });

    $(document).on('click', '.active_casestudy_tab_archive', function () {
        fetchCaseStudy('archived', '.archived_casestudy');
    });

    $(document).on('click', '.active_casestudy_tab_trash', function () {
        fetchCaseStudy('trashed', '.trashed_casestudy');
    });
}
fetchCaseStudyAction(); 


$(document).on('click', '.edit_casestudy_btn', function(){
    const data_id = $(this).attr('target');
    $(".right_action_box").addClass("active");
    $(".fixed_bg").fadeIn(1000);
    $(".add_title").html('Update case study');
    
    $.ajax({
        url: 'https://3malgroup.com/admin/models/edit_casestudy_data.php',
        type: 'GET',
        dataType: 'json',
        data: { data_id: data_id },
         beforeSend: function () {
         $('.right_action_box .form_box').html('<p>Fetching data...</p>');
        },
        success: function (response) {
            if (response) {
                const { image_url: imageUrl, title, body, data_id: dataId, start_date, end_date, status, client, tag} = response;
                 $('.right_action_box .form_box').html(
    `<form class="updateCaseStudy">
    <div class="form-group">
        <label for="title">Project Title</label>
        <input type="text" id="title" name="title" value="${title}" placeholder="E.g Mobile app development for XYZ" class="form-control raw_input">
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
        <input type="text" id="tags" name="tags" value="${tag}" placeholder="E.g Branding, UI/UX" class="form-control raw_input">
        <input class="timezone" type="hidden" name="timezone" >
        <input  type="hidden" name="data_id" value="${dataId}" >
        </div>
    <!--<div class="form-group">
        <label for="images">Upload Image</label>
        <input type="file" hidden id="images" name="images[]" accept="image/*" multiple size="10" class="form-control raw_input">
    </div> -->
    <div class="form-group">
    <label for="start_date">Start date</label>
    <input type="date" id="start_date" value="${start_date}" name="start_date" class="form-control raw_input">
</div>
<div class="form-group">
<label for="end_date">End date</label>
<input type="date" id="end_date" name="end_date" value="${end_date}" class="form-control raw_input">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="description_box form-control raw_input" rows="2">${body}</textarea>
</div>
    <div class="form-group mb-0">
        <button type="submit" class="repond_active btn form-control update_caseStudy_btn">Submit</button>
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
                console.error('No case study found');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching case study:', error);
        }
    });
});


$(document).on('click', '.update_caseStudy_btn', function () {
    $('.updateCaseStudy').unbind('submit');
    var loader = '<span class="loader"></span>';
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $('.timezone').val(timezone);
    $('.updateCaseStudy').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "https://3malgroup.com/admin/models/update_casestudy.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.update_caseStudy_btn').html(loader);
            },
            complete: function () {
                $('.update_caseStudy_btn').html("Update");
            },
            success: function (response) {
                $.trim(response);
                if (response == 'successful') {
                    $(".alert p").html("Case study updated successfully");
                    $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                    $(".raw_input").val(null);
                    $(".ck-content").empty();
                    $(".right_action_box").removeClass("active");
                    $(".fixed_bg").fadeOut(1000);
                    fetchCaseStudy('published', '.published_casestudy');
                } else {
                    $(".alert p").html(response);
                    $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error posting data:', error);
                $(".alert p").html("An error occurred while updating case study.");
                $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
            }
        });
    });
});


$(document).on('click', '.archive_casestudy_btn', function(){
    const data_id = $(this).attr('target');
    $.ajax({
        url: 'https://3malgroup.com/admin/models/update_post_status.php',
        type: 'GET',
        dataType: 'json',
        data: { archive_casestudy: data_id },
        success: function (response) {
            if (response.success) {
                $(`.data_id_${data_id}`).css({
                    'background': '#fff'
                }).fadeOut(700);
                $(".alert p").html("Case study sent to archive successfully");
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

$(document).on('click', '.publish_casestudy_btn', function(){
    const data_id = $(this).attr('target');
    $.ajax({
        url: 'https://3malgroup.com/admin/models/update_post_status.php',
        type: 'GET',
        dataType: 'json',
        data: { publish_casestudy: data_id },
        success: function (response) {
            if (response.success) {
                $(`.data_id_${data_id}`).css({
                    'background': '#fff'
                }).fadeOut(700);
                $(".alert p").html("Case study published successfully");
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

$(document).on('click', '.trash_casestudy_btn', function(){
    const data_id = $(this).attr('target');
    $.ajax({
        url: 'https://3malgroup.com/admin/models/update_post_status.php',
        type: 'GET',
        dataType: 'json',
        data: { trash_casestudy: data_id },
        success: function (response) {
            if (response.success) {
                $(`.data_id_${data_id}`).css({
                    'background': '#fff'
                }).fadeOut(700);
                $(".alert p").html("Case study sent to trash successfully");
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

$(document).on('click', '.delete_casestudy_btn', function () {
    var loader = "<span class='loader'></span>";
    $("#dataModal").modal("show");
    const data_id = $(this).attr('target');
    $("#dataModal .modal-title").html('Delete case study');
    $("#dataModal .modal-body").html('<p>Are you sure you want to delete this case study? </p>');
    $("#dataModal .modal-footer").html(`
    <button type="button" class="btn  close_modal_btn" data-dismiss="modal" aria-label="Close">Close</button>
    <button type="button" target="${data_id}" class="btn main_delete_action">Delete</button>
    `);
    $(".main_delete_action").click(function () {
       const data_id = $(this).attr('target')
       $.ajax({
          url: "https://3malgroup.com/admin/models/delete.php",
          method: "GET",
          data: { delete_casestudy: data_id },
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
                 $(".alert p").html("Case study deleted successfully");
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