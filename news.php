<?php
 

/* Template Name: News
*/ 

/**
 * @package WordPress
 * @subpackage IPRO Theme
 */

get_header(); ?>

<div id="content">

<div id="main">

<h1>IPRO News</h1>

	<?php
	$lastposts = get_posts();
	foreach($lastposts as $post) :
    setup_postdata($post);
	?>
	<h3><a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a></h3>
	<?php the_date('','<small>','</small>'); ?>
	<?php the_excerpt(); ?> <a href="<?php the_permalink(); ?>">Read More &raquo;</a>
	<?php endforeach; ?>
</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
