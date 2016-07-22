<?php
function render_gallery($npics,$width,$height){
	if(class_exists("C_Widget")){
		$gw = new C_Widget();
		echo('<div class="box">
				<h1>From the IPRO Gallery</h1>
				<center>
				');

		$gw->echo_widget_random($npics,$width,$height);
		echo('
				</center><br />
				<span class="button"><a href="/photo-gallery">More IPRO Photos &raquo;</a></span>
				</div>
				');
	}
}

function render_quotes(){
	if(function_exists('quotescollection_quote')){
		echo('	<div class="box">
				<h1>Student Testimonials</h1>
				');
		quotescollection_quote(array( 'ajax_refresh' => 0 ));
		echo('	<span class="button"><a href="/about/quotes">More Testimonials &raquo;</a></span>
			</div> ');	
	}
}

?>
