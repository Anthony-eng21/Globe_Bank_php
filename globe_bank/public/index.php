<?php require_once('../private/initialize.php');
/*http://127.0.0.1/advserver-side/globe_bank/public/staff/pages/index.php staffing
 http://127.0.0.1/advserver-side/globe_bank/public/index.php HomePage*/?>

<?php

$preview = false;
if(isset($_GET['preview'])) {
  //only logged in users can see these pages especially ones where visible is set to false
  $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false; //is_logged_in() fast check for login 
}
$visible = !$preview;

if (isset($_GET['id'])) {
  $page_id = $_GET['id'];
  $page = find_page_by_id($page_id,  ['visible' => $visible]);
  if (!$page) {
    redirect_to(url_for('/index.php'));
  }
  $subject_id = $page['subject_id']; //now we have it set then in our navigation we determinge if this will be set too

  $subject = find_subject_by_id($subject_id,  ['visible' => $visible]);
  if(!$subject) {
    redirect_to(url_for('/index.php'));
  }
} elseif(isset($_GET['subject_id'])) {
  //nothing: selected show the homepage
  $subject_id = $_GET['subject_id'];
  $subject = find_subject_by_id($subject_id,  ['visible' => $visible]);
  if(!$subject) {
    redirect_to(url_for('/index.php'));
  }
  $page_set = find_pages_by_subject_id($subject_id,  ['visible' => $visible]);
  $page = mysqli_fetch_assoc($page_set); //fetch the first page
  mysqli_free_result($page_set);
  if(!$page) {
    redirect_to(url_for('/index.php'));
  }
  $page_id = $page['id'];
} else {
  //nothing selected; show the homepage
}
?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <?php include(SHARED_PATH . '/public_navigation.php'); ?>

  <div id="page">
    <?php
    if (isset($page)) {
      //sow the page from the db
      //TODO add html escaping back again h()
      $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>'; //white list these tags for our content
      echo strip_tags($page['content'], $allowed_tags); //second arg is the content we want to allow for this site's page content
    } else {
      /*
        show the homepage
        the homepage content could:
        be static content here or in a shared file
        show first page from the nav
        be in the database but add code to hide in the nav
       */
      include(SHARED_PATH . '/static_homepage.php');
    }
    ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>