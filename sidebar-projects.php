<?php
include("sidebar-common.php");
?>
<div id="sidebar">
		
	<!--SHOW IPRO COURSE FAQ-->
	<div class="box">
		<?php 
		query_posts('page_id=50'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
	</div>
	
	
	<div class="box">
		<img src="<?php echo 'https://ipro.iit.edu/wp-content/themes/ipro/images/idea_lightbulb_green.png'; ?>" class="sidebar_img_left" alt="Light bulb" /> 
		<h1>Have an Idea?</h1>
		<p>You can propose an IPRO project for an upcoming semester!</p>
		<span class="button"><a href="/project-listings/propose-a-project">Learn More &raquo;</a></span>
    </div>
	
	<?php
	render_quotes();
	?>	
	<!--Show Quote Box through Widgets-->
	<?php //if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Quotes") ) : ?>
	<?php //endif; ?>
	
	<!--SHOW IPRO COURSE FAQ-->
	<div class="box">
		<?php 
		query_posts('page_id=106'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
	</div>
	
</div>
