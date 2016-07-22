<?php
/**
 * @package WordPress
 * @subpackage IPRO_Theme
 */
//if ( function_exists('register_sidebar') )
	//register_sidebar(array(
		//'before_widget' => '<li id="%1$s" class="widget %2$s">',
		//'after_widget' => '</li>',
		//'before_title' => '',
		//'after_title' => '',
	//));
	

if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Quotes',
'before_widget' => '<div class="box">',
'after_widget' => '</div>',
'before_title' => '<h1>',
'after_title' => '</h1>',
));

if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Search',
'before_widget' => '<div class="search_box">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));

?>
