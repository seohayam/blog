<?php
require_once('blogFunction.php');
$blog = new blog();

$data = $_POST;

$blog->checkVali($data);

$blog->updata($data);







?>