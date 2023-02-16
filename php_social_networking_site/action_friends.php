<?php
require 'core.inc.php';
$action = $_GET['action'];
$other_id = $_GET['id'];

if($action == 'accept'){
    on_action_accept($link,$other_id);
}

if($action=='reject'){
    on_action_reject($link,$other_id);
}

if($action == 'unfriend'){
    on_action_unfriend($link,$other_id);
}
?>