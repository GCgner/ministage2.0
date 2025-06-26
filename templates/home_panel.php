<?php 
    $content = '';
    $loader = '';
    $script = '';
if (!isset($user)) {
    $user = null;
}
if (!isset($isAdmin)) {
    $isAdmin = false;
}
    require_once('panel_layout.php');