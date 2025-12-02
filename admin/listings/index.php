<?php include "../../components/admin-header.php" ?>
<title>Admin Listings</title>
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
               <li class="active"><a href="https://3malgroup.com/admin/listings/"><i class="bi bi-list-check"></i> Listings</a></li>
               <li><a href="https://3malgroup.com/admin/case-study/"><i class="bi bi-border-style"></i> Case studies</a></li>
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
                     <h2>Business listings</h2>
                  </div>
                  <div class="col-sm-4">
                     <div class="search_input"><input placeholder="Search..." type="text" class="form-control"></div>
                  </div>
                  <div class="col-sm-4">
                     <div class="cta_btn text-right add_listing_cta"><button class="btn">Add listing</button></div>
                  </div>
               </div>
            </div>
            <div class="tab-box">
               <div class="d-flex inner_flex">
                  <ul class="nav nav-mobile-role" role="tablist">
                     <li class="nav-item ">
                        <a href="#published" id="bg_inner_1" target="published" class="nav-link active active_listing_tab_published "  aria-selected="false" 
                           data-toggle="tab" role="tab">Published</a>
                     </li>
                     <li class="nav-item">
                        <a href="#archived" id="bg_inner_2" target="archive" class="nav-link active_listing_tab_archive " aria-selected="false" 
                           data-toggle="tab" role="tab">Archive</a>
                     </li>
                     <li class="nav-item">
                        <a href="#trash" id="bg_inner_3" target="trash" class="nav-link active_listing_tab_trash " aria-selected="false" 
                           data-toggle="tab" role="tab">Trash</a>
                     </li>
                  </ul>
               </div>
               <div class="post_data">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="tab-content">
                           <div class="tab-pane fade show active published" id="published" aria-labelledby="bg_inner_1" role="tabpanel" >
                              <div class="innerContent main_innerContent published_listing" > 
                              </div>
                           </div>
                           <div class="tab-pane fade archive" id="archived" aria-labelledby="bg_inner_2" role="tabpanel" >
                              <div class="innerContent main_innerContent archived_listing" > 
                              </div>
                           </div>
                           <div class="tab-pane fade trash" id="trash" aria-labelledby="bg_inner_3" role="tabpanel" >
                              <div class="innerContent main_innerContent trashed_listing" > 
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
    $(document).on('click', '.add_listing_cta', function(){
    $(".right_action_box").addClass("active");
    $(".fixed_bg").fadeIn(1000);
    $(".add_title").html('Add listing');
    $('.right_action_box .form_box').html(
      `<form class="addListing">
      <div class="form-group">
          <label for="store_name">Store name</label>
          <input type="text" id="store_name" name="store_name" placeholder="E.g. Marks Stores" class="form-control raw_input">
      </div>
      <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="E.g. store_username" class="form-control raw_input">
  </div>

      <div class="form-group">
          <label for="address">Address</label>
          <input type="text" id="address" name="address" placeholder="E.g. 128 Tetlow Road, Owerri, Imo State." class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="E.g. markstore@mymail.com" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="phone">Phone</label>
          <input type="tel" id="phone" name="phone" placeholder="E.g +234-81---" class="form-control raw_input">
          <input id="listingTimeZone" type="hidden" name="timezone" >
          </div>
      <div class="form-group">
          <label for="images">Upload store images</label>
          <input type="file" hidden id="images" name="images[]" accept="image/*" multiple size="10" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="open_time">Open time</label>
          <input type="time" id="open_time" name="open_time" class="form-control raw_input">
      </div>
      <div class="form-group">
      <label for="closing_time">Closing time</label>
      <input type="time" id="closing_time" name="closing_time" class="form-control raw_input">
  </div>
      <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" id="description" class="description_box form-control raw_input" rows="2"></textarea>
      </div>
      <div class="form-group mb-0">
          <button type="submit" class="repond_active btn form-control add_listing_btn">Submit</button>
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

  $(document).on('click', '.add_listing_btn', function () {
    $('.addListing').unbind('submit');
    var loader = '<span class="loader"></span>';  
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $('#listingTimeZone').val(timezone);
    $('.addListing').submit(function (event) {
       event.preventDefault();
       $.ajax({
          url: "https://3malgroup.com/admin/models/add_listing.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          beforeSend: function () {
           $('.add_listing_btn').html(loader);
          },
          complete: function () {
             $('.add_listing_btn').html("Submit");
          },
          success: function (response) {
            $.trim(response);
            if (response == 'successful') {
                $(".alert p").html("Lisiting submited successfully");
                $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                $(".raw_input").val(null);
                $(".ck-content").empty();
                $(".right_action_box").removeClass("active");
                $(".fixed_bg").fadeOut(1000);
                fetchListing('published', '.published_listing');
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

    const listingDropdownItems = (postType, dataId) => {
        let items = '';
    
        if (postType === 'archived') {
            items += `<a class="dropdown-item publish_listing_btn" target="${dataId}">Publish</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item trash_listing_btn" target="${dataId}">Move to trash</a>`;
        } else if (postType === 'published') {
            items += `<a class="dropdown-item archive_listing_btn" target="${dataId}">Send to archive</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item trash_listing_btn" target="${dataId}">Move to trash</a>`;
        } else if (postType === 'trashed') {
            items += `<a class="dropdown-item publish_listing_btn" target="${dataId}">Publish</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item archive_listing_btn" target="${dataId}">Send to archive</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item delete_listing_btn" target="${dataId}">Delete listing</a>`;
        }
    
        return items;
    };

    function fetchListing(postType, containerClass) {
        $.ajax({
            url: `https://3malgroup.com/admin/models/fetch_listing.php?fetch_all_listing=${postType}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function(){
                 $(containerClass).html('<p>Fetching data...</p>');
            },
            success: function (response) {
                if (response && response.length > 0) {
                    let dataOutput = '<div class="row">';
                    response.forEach(data => {
                        const { image_url: imageUrl, store_name: title, created_date: createdDate, store_id: dataId, formated_title: headerTitle } = data;
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
                                                    <a class="dropdown-item edit_listing_btn" target="${dataId}">Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item share_listing_btn" target="${dataId}">Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item view_btn" target="_blank" href="https://3malgroup.com/store/${dataId}_${headerTitle}">View</a>
                                                    <div class="dropdown-divider"></div>
                                                   ${listingDropdownItems(postType, dataId)}
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
                    $(containerClass).html('<p>No Listing found</p>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching listings:', error);
                 $(containerClass).html('<p>No Listing found</p>');
            }
        });
    }
    
    function fetchListingAction() {
        fetchListing('published', '.published_listing');
    
        $(document).on('click', '.active_listing_tab_published', function () {
            fetchListing('published', '.published_listing');
        });
    
        $(document).on('click', '.active_listing_tab_archive', function () {
            fetchListing('archived', '.archived_listing');
        });
    
        $(document).on('click', '.active_listing_tab_trash', function () {
            fetchListing('trashed', '.trashed_listing');
        });
    }
    fetchListingAction();
    
    
    $(document).on('click', '.edit_listing_btn', function(){
        const store_id = $(this).attr('target');
        $(".right_action_box").addClass("active");
        $(".fixed_bg").fadeIn(1000);
        $(".add_title").html('Update listing');
        
        $.ajax({
            url: 'https://3malgroup.com/admin/models/edit_listing_data.php',
            type: 'GET',
            dataType: 'json',
            data: { store_id: store_id },
             beforeSend: function () {
             $('.right_action_box .form_box').html('Fetching data...');
            },
            success: function (response) {
                if (response) {
                    const { image_url: imageUrl, store_name: title, username: userName, store_id: dataId, open_time: openTime, closing_time: closingTime, address, email, phone, description } = response;
                    $('.right_action_box .form_box').html(
                        `<form class="updateListing">
                        <div class="form-group">
                            <label for="store_name">Store name</label>
                            <input type="text" id="store_name" value="${title}" name="store_name" placeholder="E.g. Marks Stores" class="form-control raw_input">
                        </div>
                        <!--<div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="${userName}" placeholder="E.g. store_username" class="form-control raw_input">
                    </div>-->
              
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="${address}" placeholder="E.g. 128 Tetlow Road, Owerri, Imo State." class="form-control raw_input">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="${email}" placeholder="E.g. markstore@mymail.com" class="form-control raw_input">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" value="${phone}" placeholder="E.g +234-81---" class="form-control raw_input">
                            <input id="" class="timezone" type="hidden" name="timezone" >
                            <input id="" class="" value="${dataId}" type="hidden" name="store_id" >
                            </div>
                      <!-- <div class="form-group">
                            <label for="images">Upload store images</label>
                            <input type="file" hidden id="images" name="images[]" accept="image/*" multiple size="10" class="form-control raw_input">
                        </div>  -->
                        <div class="form-group">
                            <label for="open_time">Open time</label>
                            <input type="time" id="open_time" value="${openTime}" name="open_time" class="form-control raw_input">
                        </div>
                        <div class="form-group">
                        <label for="closing_time">Closing time</label>
                        <input type="time" id="closing_time" value="${closingTime}" name="closing_time" class="form-control raw_input">
                    </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="description_box form-control raw_input" rows="2">${description}</textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="repond_active btn form-control update_listing_btn">Submit</button>
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
                    console.error('No listing found');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching listing:', error);
            }
        });
    });
    
    
    $(document).on('click', '.update_listing_btn', function () {
        $('.updateListing').unbind('submit');
        var loader = '<span class="loader"></span>';
        var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        $('.timezone').val(timezone);
        $('.updateListing').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "https://3malgroup.com/admin/models/update_listing.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.update_listing_btn').html(loader);
                },
                complete: function () {
                    $('.update_listing_btn').html("Update");
                },
                success: function (response) {
                    $.trim(response);
                    if (response == 'successful') {
                        $(".alert p").html("Listing updated successfully");
                        $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                        $(".raw_input").val(null);
                        $(".ck-content").empty();
                        $(".right_action_box").removeClass("active");
                        $(".fixed_bg").fadeOut(1000);
                        fetchListing('published', '.published_listing');
                    } else {
                        $(".alert p").html(response);
                        $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error posting data:', error);
                    $(".alert p").html("An error occurred while updating listing.");
                    $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
                }
            });
        });
    });
    
    
    $(document).on('click', '.archive_listing_btn', function(){
        const store_id = $(this).attr('target');
        $.ajax({
            url: 'https://3malgroup.com/admin/models/update_post_status.php',
            type: 'GET',
            dataType: 'json',
            data: { archive_listing: store_id },
            success: function (response) {
                if (response.success) {
                    $(`.data_id_${store_id}`).css({
                        'background': '#fff'
                    }).fadeOut(700);
                    $(".alert p").html("Listing sent to archive successfully");
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
    
    $(document).on('click', '.publish_listing_btn', function(){
        const store_id = $(this).attr('target');
        $.ajax({
            url: 'https://3malgroup.com/admin/models/update_post_status.php',
            type: 'GET',
            dataType: 'json',
            data: { publish_listing: store_id },
            success: function (response) {
                if (response.success) {
                    $(`.data_id_${store_id}`).css({
                        'background': '#fff'
                    }).fadeOut(700);
                    $(".alert p").html("Listing published successfully");
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
    
    $(document).on('click', '.trash_listing_btn', function(){
        const store_id = $(this).attr('target');
        $.ajax({
            url: 'https://3malgroup.com/admin/models/update_post_status.php',
            type: 'GET',
            dataType: 'json',
            data: { trash_listing: store_id },
            success: function (response) {
                if (response.success) {
                    $(`.data_id_${store_id}`).css({
                        'background': '#fff'
                    }).fadeOut(700);
                    $(".alert p").html("Listing sent to trash successfully");
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
    
    $(document).on('click', '.delete_listing_btn', function () {
        var loader = "<span class='loader'></span>";
        $("#dataModal").modal("show");
        const store_id = $(this).attr('target');
        $("#dataModal .modal-title").html('Delete lisitng');
        $("#dataModal .modal-body").html('<p>Are you sure you want to delete this business listing? </p>');
        $("#dataModal .modal-footer").html(`
        <button type="button" class="btn  close_modal_btn" data-dismiss="modal" aria-label="Close">Close</button>
        <button type="button" target="${store_id}" class="btn main_delete_action">Delete</button>
        `);
        $(".main_delete_action").click(function () {
           const data_id = $(this).attr('target')
           $.ajax({
              url: "https://3malgroup.com/admin/models/delete.php",
              method: "GET",
              data: { delete_listing: data_id },
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
                     $(".alert p").html("Listing deleted successfully");
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