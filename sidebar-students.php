<?php
include("sidebar-common.php");
?>
<div id="sidebar">

	<!--SHOW "Learn More about the IPRO"-->
	<div class="box">
		<?php 
		$page = get_page_by_title('Sidebar Students');
		$pages = get_pages('include='.$page->ID.''); 
		foreach ($pages as $pagg) {
		echo $pagg->post_content;
		}
		?>
	</div>
	
     <!--Show Social Media Links-->
	<div class="box">
		<?php 
		query_posts('page_id=1713'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
	</div>
        
	<!--SHOW RANDOM PICS-->
	<?php
	render_gallery(4,130,85);
	render_quotes();
	?>
	
	<div class="box">
		<?php 
		$page = get_page_by_title('Sidebar Contact: General');
		$pages = get_pages('include='.$page->ID.''); 
		foreach ($pages as $pagg) {
		echo $pagg->post_content;
		}
		?>
	</div> 
	
</div>
