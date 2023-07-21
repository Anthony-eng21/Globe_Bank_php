<?php require_once('../../../private/initialize.php'); ?>

<!-- GREAT PRACTICE FOR EACH DIR TO HAVE AN INDEX LIKE THIS WHEN WE HAVE NO REAL PAGE FOR IT I.E NESTED ROUTE -->
<?php
 require_login();

 redirect_to(url_for('/staff/index.php'));
?>
