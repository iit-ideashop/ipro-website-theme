<?php
include("sidebar-common.php");
?>
<div id="sidebar">
		
	<!--SHOW "Learn More about the IPRO"-->
	<div class="box">
		<?php 
		query_posts('page_id=1667'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
	</div>
	
	<!--SHOW RANDOM PICS-->
	<?php
	render_gallery(4,130,85);
	?>

	<!--SHOW "Sidebar Contact - General"-->
	<div class="box">
		<?php 
		query_posts('page_id=132'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
	</div>
	
</div>
