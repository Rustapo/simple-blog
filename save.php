<?php

define("PHPUNIT_TESTING", true);

include_once("../../index.php");

$Wcms = new Wcms();
$Wcms->init();

$SimpleBlog = new SimpleBlog(false);
$SimpleBlog->init();

if(!$Wcms->loggedIn
    && $_SESSION['token'] === $_POST['token']
    && $Wcms->hashVerify($_POST['token']))
    die("Please login first.");

if(!isset($_POST["key"], $_POST["value"], $_POST["page"])) die("Please specify key and value");

$key = $Wcms->slugify($_POST["key"]);
$page = $Wcms->slugify($_POST["page"]);
$value = $_POST["value"];

if(empty($key) || empty($page) || empty($value)) die("Please specify all the fields");

if($key == "title") $value = strip_tags($value);

$SimpleBlog->set("posts", $page, $key, $value);

?>
