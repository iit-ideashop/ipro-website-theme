
<div id="sidebar">		
		
	<!--SHOW "Sidebar: Deliverable Due Dates" Table-->
		<?php 
		query_posts('page_id=76'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
		<br />
		
	<div class="box">
		<a href="https://ipro.iit.edu/deliverables/logo-library"><img src="<?php echo 'https://ipro.iit.edu/wp-content/themes/ipro/images/logo_library.png'; ?>" class="sidebar_img_left" alt="" /></a>
		<h1>Logo Library</h1>
		<p>Make your posters, abstracts, or brochures crisp by using high-resolution IPRO and IIT logos.</p>
		<span class="button"><a href="https://ipro.iit.edu/deliverables/logo-library">Visit Logo Library &raquo;</a></span>
    </div>
	
	<!--Show "Sidebar: Contact - General"-->
	<div class="box">
		<?php 
		query_posts('page_id=132'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
	</div>
	
</div>
