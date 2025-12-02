<?php include "../../components/admin-header.php" ?>
<title>Admin Blog</title>
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
               <li class="active"><a href="<?= $adminBase ?>blog/"><i class="bi bi-info-circle"></i> Blog</a></li>
               <li><a href="<?= $adminBase ?>listings/"><i class="bi bi-list-check"></i> Listings</a></li>
               <li><a href="<?= $adminBase ?>case-study/"><i class="bi bi-border-style"></i> Case studies</a></li>
               <li><a href="<?= $adminBase ?>events/"><i class="bi bi-calendar-event"></i> Events</a></li>
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
                     <h2>Blog</h2>
                  </div>
                  <div class="col-sm-4">
                     <div class="search_input"><input placeholder="Search..." type="text" class="form-control"></div>
                  </div>
                  <div class="col-sm-4">
                     <div class="cta_btn text-right add_post_cta"><button class="btn">Add post</button></div>
                  </div>
               </div>
            </div>
            <div class="tab-box">
               <div class="d-flex inner_flex">
                  <ul class="nav nav-mobile-role" role="tablist">
                     <li class="nav-item ">
                        <a href="#published" id="bg_inner_1" target="published" class="nav-link active active_post_tab_published "  aria-selected="false" 
                           data-toggle="tab" role="tab">Published</a>
                     </li>
                     <li class="nav-item">
                        <a href="#draft" id="bg_inner_2" target="draft" class="nav-link active_post_tab_draft " aria-selected="false" 
                           data-toggle="tab" role="tab">Draft</a>
                     </li>
                     <li class="nav-item">
                        <a href="#trash" id="bg_inner_3" target="trash" class="nav-link active_post_tab_trash " aria-selected="false" 
                           data-toggle="tab" role="tab">Trash</a>
                     </li>
                  </ul>
               </div>
               <div class="post_data">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="tab-content">
                           <div class="tab-pane fade show active published" id="published" aria-labelledby="bg_inner_1" role="tabpanel" >
                              <div class="innerContent main_innerContent published_post" > 
                              </div>
                           </div>
                           <div class="tab-pane fade draft" id="draft" aria-labelledby="bg_inner_2" role="tabpanel" >
                              <div class="innerContent main_innerContent draft_post" > 
                              </div>
                           </div>
                           <div class="tab-pane fade trash" id="trash" aria-labelledby="bg_inner_3" role="tabpanel" >
                              <div class="innerContent main_innerContent trashed_post" > 
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
//Add Post Trigger
$(document).on('click', '.add_post_cta', function(){
    $(".right_action_box").addClass("active");
    $(".fixed_bg").fadeIn(1000);
    $(".add_title").html('Add Post');
    $('.right_action_box .form_box').html(
      `<form class="addBlogPost">
      <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" name="title" placeholder="Title" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="author">Author</label>
          <input type="text" id="author" name="author" placeholder="E.g. John Doe" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="category">Category</label>
          <input type="text" id="category" name="category" placeholder="E.g. Business" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="keywords">Keywords</label>
          <input type="text" id="keywords" name="keywords" placeholder="E.g Pets, Dogs, Cats" class="form-control raw_input">
          <input id="postTimeZone" type="hidden" name="timezone" >
          </div>
      <div class="form-group">
          <label for="images">Upload Image</label>
          <input type="file" hidden id="images" name="images[]" accept="image/*" multiple size="10" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="image_caption">Image caption</label>
          <input type="text" id="image_caption" name="image_caption" placeholder="E.g Photo credit BBC" class="form-control raw_input">
      </div>
      <div class="form-group">
          <label for="post">Post</label>
          <textarea name="post" id="post" class="story_box form-control raw_input" rows="2"></textarea>
      </div>
      <div class="form-group mb-0">
          <button type="submit" class="repond_active btn form-control add_post_btn">Submit</button>
      </div>
  </form>
      `
    )
    ClassicEditor
    .create( document.querySelector( '.story_box' ) )
    .catch( error => {
    console.error( error );
    } );
  });

  //Add Post
  $(document).on('click', '.add_post_btn', function () {
    $('.addBlogPost').unbind('submit');
    var loader = '<span class="loader"></span>';  
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $('#postTimeZone').val(timezone);
    $('.addBlogPost').submit(function (event) {
       event.preventDefault();
       $.ajax({
          url: "../models/add_post.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          beforeSend: function () {
           $('.add_post_btn').html(loader);
          },
          complete: function () {
             $('.add_post_btn').html("Submit");
          },
          success: function (response) {
              $.trim(response);
              if (response == 'successful') {
                  $(".alert p").html("Post submited successfully");
                  $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                  $(".raw_input").val(null);
                  $(".ck-content").empty();
                  $(".right_action_box").removeClass("active");
                  $(".fixed_bg").fadeOut(1000);
                   fetchPosts('published', '.published_post');
              } else {
                  $(".alert p").html(response);
                  $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
              }
          },
          error: function (xhr, status, error) {
              console.error('Error posting data:', error);
              $(".alert p").html("An error occurred while posting to DB. " + error);
              $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
          }
       });
    });
 });
 
 // Post Dropdown
 const postDropdownItems = (postType, dataId) => {
    let items = '';
    if (postType === 'draft') {
        items += `
                <a class="dropdown-item publish_post_btn" target="${dataId}">Publish post</a>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item trash_post_btn" target="${dataId}">Move to trash</a>`;
    } else if (postType === 'published') {
        items += `
                <a class="dropdown-item draft_post_btn" target="${dataId}">Send to draft</a>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item trash_post_btn" target="${dataId}">Move to trash</a>`;
    } else if (postType === 'trashed') {
        items += `<a class="dropdown-item publish_post_btn" target="${dataId}">Publish post</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item draft_post_btn" target="${dataId}">Send to draft</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item delete_post_btn" target="${dataId}">Delete post</a>`;
    }
    return items;
};

 //Fetch Post
function fetchPosts(postType, containerClass) {
    var loader = "<span class='loader'></span>";
    $.ajax({
        url: `../models/fetch_posts.php?fetch_all_post=${postType}`,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $(containerClass).html('<p>Fetching data...</p>');
        },
        success: function (response) {
            if (response && response.length > 0) {
                let dataOutput = '<div class="row">';
                response.forEach(data => {
                    const { image_url: imageUrl, title, created_date: createdDate, blog_id: dataId, formated_title: headerTitle } = data;
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
                                                <a class="dropdown-item edit_post_btn" target="${dataId}">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item share_post_btn" target="${dataId}">Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item view_btn" target="_blank" href="/article/${dataId}_${headerTitle}">View</a>
                                                <div class="dropdown-divider"></div>
                                               ${postDropdownItems(postType, dataId)}
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
                $(containerClass).html('<p>No posts found</p>');
            }
        },
        error: function (xhr, status, error) {
            $(containerClass).html('<p>No post found' +'</p>');
        }
    });
}

function fetchBlog() {
    fetchPosts('published', '.published_post');
    $(document).on('click', '.active_post_tab_published', function () {
        fetchPosts('published', '.published_post');
    });

    $(document).on('click', '.active_post_tab_draft', function () {
        fetchPosts('draft', '.draft_post');
    });

    $(document).on('click', '.active_post_tab_trash', function () {
        fetchPosts('trashed', '.trashed_post');
    });
}
fetchBlog();


const dataLoader = `
<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <span class='' >Fetching data...</span>
</div>
`;

//Edit Post Trigger
$(document).on('click', '.edit_post_btn', function(){
    const blog_id = $(this).attr('target');
    $(".right_action_box").addClass("active");
    $(".fixed_bg").fadeIn(1000);
    $(".add_title").html('Update Blog post');
    $.ajax({
        url: '../models/edit_post_data.php',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
         $('.right_action_box .form_box').html(dataLoader);
        },
        data: { blog_id: blog_id },
        success: function (response) {
            if (response) {
                const { image_url: imageUrl, title, blog_id: dataId, author, category, keywords, image_caption, body } = response;
                $('.right_action_box .form_box').html(
                    `<form class="updateBlogPost">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" value="${title}" name="title" placeholder="Title" class="form-control raw_input">
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" id="author" value="${author}" name="author" placeholder="E.g. John Doe" class="form-control raw_input">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" id="category" value="${category}" name="category" placeholder="E.g. Business" class="form-control raw_input">
                        </div>
                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <input type="text" id="keywords" value="${keywords}" name="keywords" placeholder="E.g Pets, Dogs, Cats" class="form-control raw_input">
                        </div>
                        <input type="hidden" id="blog_id" value="${dataId}" name="blog_id" class="form-control raw_input">
                        <input id="updatePostTimeZone" type="hidden" name="timezone">
                        <!-- <div class="form-group">
                            <label for="images">Upload Image</label>
                            <input type="file" hidden id="images" name="images[]" accept="image/*" multiple size="10" class="form-control raw_input">
                        </div> -->
                        <div class="form-group">
                            <label for="image_caption">Image caption</label>
                            <input type="text" id="image_caption" value="${image_caption}" name="image_caption" placeholder="E.g Photo credit BBC" class="form-control raw_input">
                        </div>
                        <div class="form-group">
                            <label for="post">Post</label>
                            <textarea name="post" id="post" class="update_story_box form-control raw_input" rows="2">${body}</textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="repond_active btn form-control update_post_btn">Update</button>
                        </div>
                    </form>`
                );
                ClassicEditor
                    .create(document.querySelector('.update_story_box'))
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error('No post found');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching post:', error);
        }
    });
});


// Update Post
$(document).on('click', '.update_post_btn', function () {
    $('.updateBlogPost').unbind('submit');
    var loader = '<span class="loader"></span>';  
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $('#updatePostTimeZone').val(timezone);
    $('.updateBlogPost').submit(function (event) {
       event.preventDefault();
       $.ajax({
          url: "../models/update_post.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          beforeSend: function () {
           $('.update_post_btn').html(loader);
          },
          complete: function () {
             $('.update_post_btn').html("Update");
          },
        success: function (response) {
           if (response == 'successful') {
               fetchPosts('published', '.published_post');
                $(".alert p").html("Blog post updated successfully");
                $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                $(".raw_input").val(null);
                $(".ck-content").empty();
                $(".right_action_box").removeClass("active");
                $(".fixed_bg").fadeOut(1000);
            } else {
                $(".alert p").html(response.error);
                $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error posting data:', error);
            $(".alert p").html("An error occurred while updating post.");
            $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
        }
       });
    });
  });


  // Draft Post
  $(document).on('click', '.draft_post_btn', function(){
    const blog_id = $(this).attr('target');
    $.ajax({
        url: '../models/update_post_status.php',
        type: 'GET',
        dataType: 'json',
        data: { draft_post: blog_id },
        success: function (response) {
            if (response.success) {
                $(`.data_id_${blog_id}`).css({
                    'background': '#fff'
                }).fadeOut(700);
                $(".alert p").html("Post sent to draft successfully");
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


// Publish Post
$(document).on('click', '.publish_post_btn', function(){
    const blog_id = $(this).attr('target');
    $.ajax({
        url: '../models/update_post_status.php',
        type: 'GET',
        dataType: 'json',
        data: { publish_post: blog_id },
        success: function (response) {
            if (response.success) {
                $(`.data_id_${blog_id}`).css({
                    'background': '#fff'
                }).fadeOut(700);
                $(".alert p").html("Post published successfully");
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


// Trash Post
$(document).on('click', '.trash_post_btn', function(){
    const blog_id = $(this).attr('target');
    $.ajax({
        url: '../models/update_post_status.php',
        type: 'GET',
        dataType: 'json',
        data: { trash_post: blog_id },
        success: function (response) {
            if (response.success) {
                $(`.data_id_${blog_id}`).css({
                    'background': '#fff'
                }).fadeOut(700);
                $(".alert p").html("Post sent to trash successfully");
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

// Delete post
$(document).on('click', '.delete_post_btn', function () {
    var loader = "<span class='loader'></span>";
    $("#dataModal").modal("show");
    const blog_id = $(this).attr('target');
    $("#dataModal .modal-title").html('Delete post');
    $("#dataModal .modal-body").html('<p>Are you sure you want to delete this post? </p>');
    $("#dataModal .modal-footer").html(`
    <button type="button" class="btn  close_modal_btn" data-dismiss="modal" aria-label="Close">Close</button>
    <button type="button" target="${blog_id}" class="btn main_delete_action">Delete</button>
    `);
    $(".main_delete_action").click(function () {
       const data_id = $(this).attr('target')
       $.ajax({
          url: "../models/delete.php",
          method: "GET",
          data: { delete_post: data_id },
          beforeSend: function () {
             $('.main_delete_action').html(loader);
          },
          complete: function () {
             $('.main_delete_action').html("Delete");
          },
          success: function (response) {
            if (response == 'successful') {
                $(`.data_id_${data_id}`).css({
                    'background': '#fff'
                 }).fadeOut(700);
                 $("#dataModal").modal("hide");
                 $(".alert p").html("Post deleted successfully");
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
