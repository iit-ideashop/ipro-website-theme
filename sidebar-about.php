<?php
include("sidebar-common.php");
?>

<div id="sidebar">

	<!--SHOW "Learn More about the IPRO"-->
	<div class="box">
		<?php 
		$page = get_page_by_title('Sidebar About');
		$pages = get_pages('include='.$page->ID.''); 
		foreach ($pages as $pagg) {
		echo $pagg->post_content;
		}
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
