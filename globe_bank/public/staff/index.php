<?php require_once('../../private/initialize.php'); ?>

<?php // unset($_SESSION['admin_id']); ?>
<?php require_login() ?>

<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/staff/subjects/index.php'); ?>">Subjects</a></li>
      <!-- <li><a href="<?php // echo url_for('/staff/pages/index.php'); ?>">Pages</a></li> NESTED RESOURCE-->
      <li><a href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a></li>
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
