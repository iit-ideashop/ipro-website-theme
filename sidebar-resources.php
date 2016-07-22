<?php
include("sidebar-common.php");
?>
<div id="sidebar">
		
	<!--SHOW IPRO COURSE FAQ-->
	<div class="box">
		<?php 
		query_posts('page_id=532'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
	</div>

	<?php
	render_gallery(4,130,85);
	render_quotes();
	?>
	
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
