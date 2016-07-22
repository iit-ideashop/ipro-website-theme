<div id="sidebar">
	        
    <!--Show Social Media Links-->
		<div class="box"> 
		<?php
		query_posts('page_id=1713'); 
		while (have_posts()) : the_post(); 
			the_content(); 
		endwhile; 
		?>
		</div>
		
	<div class="box">
		<img src="<?php echo 'https://ipro.iit.edu/wp-content/themes/ipro/images/idea_lightbulb_green.png'; ?>" class="sidebar_img_left" alt="Light bulb" /> 
		<h1>Have an Idea?</h1>
		<p>You can propose an IPRO project for an upcoming semester!</p>
		<a href="/project-listings/propose-a-project" class="button">Learn More &raquo;</a>
    </div>
	
	<!--Show Skype Status-->

	<!--<div class="box">-->
	<!--Skype 'My status' button http://www.skype.com/go/skypebuttons-->
		<!--<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>-->
		<!--<a href="skype:ipro.iit?call"><img src="http://mystatus.skype.com/bigclassic/ipro%2Eiit" style="border: none;" width="182" height="44" alt="My status" /></a>-->
		<!--<p>Have a question? Give us a call!</p>-->
	<!--</div>-->
	
	
</div>
