<?php
require_once('../../private/initialize.php');

log_out_admin(); //kill session for admins;
redirect_to(url_for('/staff/login.php'));

?>
