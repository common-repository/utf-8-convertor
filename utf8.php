<?php
/*
Plugin Name: UTF-8 Convertor
Plugin URI: http://www.zambesc.com/utf-8-convertor-un-plugin-pentru-wordpress/
Description: This plugin is design to convert all the characters that appear on your blog posts to UTF-8 English text only
Author: Andrei
Version: 0.2
Author URI: http://www.zambesc.com
*/



function curata_utf8($content) 
{
require_once("class.utf8.php");
$object = new prepare_string();
$content = $object -> remove_special_chars ( $content );
return $content;
}

add_filter('single_post_title','curata_utf8');
add_filter('the_title','curata_utf8');
add_filter('the_content','curata_utf8');


?>
