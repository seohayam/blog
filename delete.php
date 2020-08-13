<?php

require_once('blogFunction.php');
$blog = new blog();


$id = $_GET['id'];

$blog->delete($id);



?>