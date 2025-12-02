<?php include "../../components/admin-header.php" ?>
<title>Admin Webforms</title>
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
                <li><a href="<?= $adminBase ?>events/"><i class="bi bi-calendar-event"></i> Events</a></li>
                <li class="active"><a href="<?= $adminBase ?>webforms/"><i class="bi bi-ui-checks"></i> Webforms </a></li>
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
                <h2>Webforms</h2>
            </div>
            <!-- <div class="col-sm-4">
                <div class="search_input"><input placeholder="Search..." type="text" class="form-control"></div>
            </div>
            <div class="col-sm-4">
                <div class="cta_btn text-right"><button class="btn">Add listing</button></div>
            </div> -->
        </div>
       </div>

       <div class="tab-box">

<div class="d-flex inner_flex">
<ul class="nav nav-mobile-role" role="tablist">  
<li class="nav-item ">
<a href="#published" id="bg_inner_1" target="published" class="nav-link active active_tab_published "  aria-selected="false" 
data-toggle="tab" role="tab">Contact form</a>
</li>
<li class="nav-item">
<a href="#archive" id="bg_inner_2" target="archive" class="nav-link active_tab_archive " aria-selected="false" 
data-toggle="tab" role="tab">Newsletter</a>
</li> 
<li class="nav-item">
<a href="#trash" id="bg_inner_3" target="trash" class="nav-link active_tab_trash " aria-selected="false" 
data-toggle="tab" role="tab">Quote</a>
</li> 
</ul>
</div>


<div class="post_data">
<div class="row">
<div class="col-sm-12">
<div class="tab-content">
<div class="tab-pane fade show active published" id="published" aria-labelledby="bg_inner_1" role="tabpanel" >
<div class="filter_bar">
   <div class="row align-items-end">
      <div class="col-sm-4 mb-2">
         <label class="mb-1">Search</label>
         <input type="text" class="form-control contact_search" placeholder="Search name, email, phone, message">
      </div>
      <div class="col-sm-4 mb-2">
         <label class="mb-1">Sort</label>
         <select class="form-control contact_order">
            <option value="desc">Newest first</option>
            <option value="asc">Oldest first</option>
         </select>
      </div>
      <div class="col-sm-2 mb-2">
         <label class="mb-1">From</label>
         <input type="date" class="form-control contact_from">
      </div>
      <div class="col-sm-2 mb-2">
         <label class="mb-1">To</label>
         <input type="date" class="form-control contact_to">
      </div>
   </div>
</div>
<div class="innerContent main_innerContent " ></div>
</div>
<div class="tab-pane fade archive" id="archive" aria-labelledby="bg_inner_2" role="tabpanel" >
<div class="filter_bar">
   <div class="row align-items-end">
      <div class="col-sm-4 mb-2">
         <label class="mb-1">Search</label>
         <input type="text" class="form-control newsletter_search" placeholder="Search email">
      </div>
      <div class="col-sm-4 mb-2">
         <label class="mb-1">Sort</label>
         <select class="form-control newsletter_order">
            <option value="desc">Newest first</option>
            <option value="asc">Oldest first</option>
         </select>
      </div>
      <div class="col-sm-2 mb-2">
         <label class="mb-1">From</label>
         <input type="date" class="form-control newsletter_from">
      </div>
      <div class="col-sm-2 mb-2">
         <label class="mb-1">To</label>
         <input type="date" class="form-control newsletter_to">
      </div>
   </div>
</div>
<div class="innerContent main_innerContent" ></div>
</div>
<div class="tab-pane fade trash" id="trash" aria-labelledby="bg_inner_3" role="tabpanel" >
<div class="innerContent main_innerContent " > 

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

<?php include "../../components/admin-footer.php" ?>

<script>
const adminBase = "<?= $adminBase ?>";
let contactData = [];
let newsletterData = [];

const contactFilters = { search: '', order: 'desc', from: '', to: '' };
const newsletterFilters = { search: '', order: 'desc', from: '', to: '' };

const skeletonRow = `
<div class="row">
  <div class="col-sm-12">
    <div class="box_wrapper">
      <div class="d-flex">
        <div class="item_box_1" style="width:100%">
          <div class="skeleton" style="height:80px; width:100%"></div>
        </div>
      </div>
    </div>
  </div>
</div>`;

const parseDateValue = (value) => {
  if (!value) return null;
  const ts = Date.parse(value.replace(/-/g, '/'));
  return isNaN(ts) ? null : new Date(ts);
};

const withinRange = (dateVal, from, to) => {
  if (!dateVal) return false;
  if (from && dateVal < from) return false;
  if (to && dateVal > to) return false;
  return true;
};

const applyFilters = (data, filters) => {
  const term = (filters.search || '').toLowerCase();
  const from = filters.from ? new Date(filters.from) : null;
  const to = filters.to ? new Date(filters.to) : null;
  if (to) { to.setHours(23, 59, 59, 999); }

  const filtered = data.filter(item => {
    const dateVal = parseDateValue(item.created_date);
    if (!withinRange(dateVal, from, to)) return false;
    if (!term) return true;
    return Object.values(item).some(val => (val || '').toString().toLowerCase().includes(term));
  });

  return filtered.sort((a, b) => {
    const dateA = parseDateValue(a.created_date);
    const dateB = parseDateValue(b.created_date);
    if (!dateA || !dateB) return 0;
    return filters.order === 'asc' ? dateA - dateB : dateB - dateA;
  });
};

const renderContactCard = (item) => `
  <div class="col-sm-12">
    <div class="box_wrapper">
      <div class="d-flex">
        <div class="item_box_1">
          <div class="d-flex">
            <div class="text_box">
              <h2>${item.name || 'Unknown'}</h2>
              <h3><a href="mailto:${item.email}">${item.email}</a> · <a href="tel:${item.phone}">${item.phone}</a></h3>
              <p>${item.created_date}</p>
              <p>${item.body}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>`;

const renderNewsletterCard = (item) => `
  <div class="col-sm-12">
    <div class="box_wrapper">
      <div class="d-flex">
        <div class="item_box_1" style="width:100%">
          <div class="d-flex">
            <div class="text_box" style="text-align:left; width:100%">
              <h2>${item.email}</h2>
              <p>Subscribed: ${item.created_date}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>`;

function renderContactList() {
  const target = '.published .innerContent';
  const filtered = applyFilters(contactData, contactFilters);
  if (filtered.length) {
    let html = '<div class="row">';
    filtered.forEach(item => { html += renderContactCard(item); });
    html += '</div>';
    $(target).html(html);
  } else {
    $(target).html('<p>No contact submissions found</p>');
  }
}

function renderNewsletterList() {
  const target = '.archive .innerContent';
  const filtered = applyFilters(newsletterData, newsletterFilters);
  if (filtered.length) {
    let html = '<div class="row">';
    filtered.forEach(item => { html += renderNewsletterCard(item); });
    html += '</div>';
    $(target).html(html);
  } else {
    $(target).html('<p>No newsletter subscriptions found</p>');
  }
}

function fetchContact() {
  const target = '.published .innerContent';
  $(target).html(skeletonRow);
  $.ajax({
    url: `${adminBase}models/fetch_contact.php`,
    method: 'GET',
    dataType: 'json',
    success: function (response) {
      contactData = response || [];
      renderContactList();
    },
    error: function (xhr) {
      $(target).html(`<p>Failed to load contact submissions: ${xhr.responseText || xhr.statusText}</p>`);
    }
  });
}

function fetchNewsletter() {
  const target = '.archive .innerContent';
  $(target).html(skeletonRow);
  $.ajax({
    url: `${adminBase}models/fetch_newsletter.php`,
    method: 'GET',
    dataType: 'json',
    success: function (response) {
      newsletterData = response || [];
      renderNewsletterList();
    },
    error: function (xhr) {
      $(target).html(`<p>Failed to load newsletter signups: ${xhr.responseText || xhr.statusText}</p>`);
    }
  });
}

// Initial load
fetchContact();
fetchNewsletter();

// Tab click reload
$(document).on('click', '.active_tab_published', fetchContact);
$(document).on('click', '.active_tab_archive', fetchNewsletter);

// Filters - contact
$(document).on('input', '.contact_search', function(){ contactFilters.search = $(this).val(); renderContactList(); });
$(document).on('change', '.contact_order', function(){ contactFilters.order = $(this).val(); renderContactList(); });
$(document).on('change', '.contact_from', function(){ contactFilters.from = $(this).val(); renderContactList(); });
$(document).on('change', '.contact_to', function(){ contactFilters.to = $(this).val(); renderContactList(); });

// Filters - newsletter
$(document).on('input', '.newsletter_search', function(){ newsletterFilters.search = $(this).val(); renderNewsletterList(); });
$(document).on('change', '.newsletter_order', function(){ newsletterFilters.order = $(this).val(); renderNewsletterList(); });
$(document).on('change', '.newsletter_from', function(){ newsletterFilters.from = $(this).val(); renderNewsletterList(); });
$(document).on('change', '.newsletter_to', function(){ newsletterFilters.to = $(this).val(); renderNewsletterList(); });
</script>
