<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="HD2M7rPrITFpJm_xT4ohYjhGMsUJuT8COb5WEkJkQZs" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<?php wp_head(); ?>

<!--[if gt IE 6]>
	<style type="text/css">
			#main ul.domtabs li{
			font-size:.8em;
			float:left;
			padding:0 .5em 0 0;
			margin-left:0px;
			margin-bottom:-20px;
			list-style:none;
			border-bottom: none;
		}
	</style>
<![endif]-->
  
</head>


<body>

<div id="header">

<div id="logo_holder">
	<a href="https://ipro.iit.edu"><img src="/wp-content/themes/ipro/images/IPRO-Logo-blk_100.gif" alt="Interprofessional Projects Program" /></a><br />
	<div class="blogname"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></div>
	<div class="tagline"><?php bloginfo('description'); ?></div>
	<!-- dynsidebar -->
    <div class="logo_iit"><a href="http://iit.edu"><img src="/wp-content/themes/ipro/images/IIT_Logo_horiz_white-320x62.gif" alt="Illinois Institute of Technology" /></a></div>
</div>

<div id="nav">
	<ul>
	<li><a href="/index.php">Home</a></li>
	<li><a href="/about">About</a></li>
	<li><a href="/news">News</a></li>
	<!--<li><a href="/calendar">Calendar</a></li>-->
	<li><a href="/project-listings/current-projects">IPRO Projects</a></li>
	<!--<li><a href="/deliverables">Deliverables</a></li>-->
	<li><a href="/ipro-day">IPRO Day</a></li>
	<!--<li><a href="/resources">Resources</a></li>-->
	<li><a href="/sponsors">Sponsors</a></li>
	<li><a href="/contact">Contact</a></li>
	<li><a href="/students">Students</a></li>
	<li><a href="/videos">Videos</a></li>
	<li><a style="display:block;background: none repeat scroll 0 0 #E21D38;font-weight: normal;font-family:Verdana,Arial,Sans-Serif; border: 1px solid #990000" href="https://secure.touchnet.com/C20090_ustores/web/store_main.jsp?STOREID=5&SINGLESTORE=true">Donate Today</a></li>
	<!--<li class="search">
   <form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
		<input type="text" name="s" id="s" size="15" />
		<input type="submit" value="<?php _e('Search'); ?>" />
	</li>-->
	</ul>
</div>
<?php if ((is_front_page()) and (!is_paged())) { ?>
<?php } ?>
<div class="breadcrumb">
<?php
if (!is_home()) {
    
	if(function_exists('bcn_display'))
	{
		bcn_display();
	}
}
?>
</div>

</div>
