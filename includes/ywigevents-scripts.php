<?php
	//add scripts
	function ywig_add_scripts(){
		//main css
		wp_enqueue_style( 'ywig-main-style', plugins_url(). '/ywigevents/css/style.css', array(), '1.0.0');
		//main js
		wp_enqueue_script( 'ywig-main-script', plugins_url(). '/ywigevents/js/main.js');
	}

	add_action('wp_enqueue_scripts', 'ywig_add_scripts');