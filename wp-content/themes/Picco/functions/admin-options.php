<?php

// THIS IS THE DIFFERENT FIELDS
$options[] = array(	"name" => "General Settings",
					"type" => "heading");
						

$options[] = array(	"name" => "Custom Logo",
					"desc" => "Paste the full URL of your custom logo image, should you wish to replace our default logo e.g. 'http://www.yoursite.com/logo-trans.png'. <br />NOTE: You need to name the logo 'logoname-trans.png' to make it transparent in IE6 .",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "text");					 							    

$options[] = array(	"name" => "Custom Logo (Footer)",
					"desc" => "Paste the full URL of your custom logo image, should you wish to replace our default logo e.g. 'http://www.yoursite.com/logo-trans.png'. <br />NOTE: You need to name the logo 'logoname-trans.png' to make it transparent in IE6 .",
					"id" => $shortname."_logo_footer",
					"std" => "",
					"type" => "text");					 							    

$options[] = array(	"name" => "Google Analytics",
					"desc" => "Please paste your Google Analytics (or other) tracking code here.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");		

$options[] = array(	"name" => "Feedburner RSS URL",
					"desc" => "Enter your Feedburner URL here.",
					"id" => $shortname."_feedburner_url",
					"std" => "",
					"type" => "text");	


$options[] = array(	"name" => "Category Settings",
					"type" => "heading");


$options[] = array(	"name" => "Home Page Title",
					"desc" => "Home Page Title (title that will appear in navigation)",
					"id" => $shortname."_home_page_title",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Home Page Description",
					"desc" => "Home Page Description (description that will appear in navigation)",
					"id" => $shortname."_home_page_description",
					"std" => "",
					"type" => "text");	


$options[] = array(	"name" => "Portfolio Category ID:",
					"desc" => "Portfolio Category ID",
					"id" => $shortname."_portfolio_category",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Portfolio Page Title",
					"desc" => "Portfolio Page Title (title that will appear in navigation)",
					"id" => $shortname."_portfolio_page_title",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Portfolio Page Description",
					"desc" => "Portfolio Page Description (description that will appear in navigation)",
					"id" => $shortname."_portfolio_page_description",
					"std" => "",
					"type" => "text");	


$options[] = array(	"name" => "Services Category ID:",
					"desc" => "Services Category ID",
					"id" => $shortname."_services_category",
					"std" => "", 
					"type" => "text");

$options[] = array(	"name" => "Services Page Title",
					"desc" => "Services Page Title (title that will appear in navigation)",
					"id" => $shortname."_services_page_title",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Services Page Description",
					"desc" => "Services Page Description (description that will appear in navigation)",
					"id" => $shortname."_services_page_description",
					"std" => "",
					"type" => "text");  


$options[] = array(	"name" => "Blog Category ID:",
					"desc" => "Blog Category ID",
					"id" => $shortname."_blog_category",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Blog Page Title",
					"desc" => "Blog Page Title (title that will appear in navigation)",
					"id" => $shortname."_blog_page_title",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Blog Page Description",
					"desc" => "Blog Page Description (description that will appear in navigation)",
					"id" => $shortname."_blog_page_description",
					"std" => "",
					"type" => "text");	


$options[] = array(	"name" => "Which pages should be included in the navigation?",
					"desc" => "Beside Home, Services, Portfolio, Blog which pages should be included in the navigation?",
					"id" => $shortname."_pages_included",
					"std" => "",
					"type" => "text");


$options[] = array(	"name" => "Featured Category ID:",
					"desc" => "Featured Category ID (Home Page Slider)",
					"id" => $shortname."_featured_category",
					"std" => "",
					"type" => "text");


$options[] = array(	"name" => "Image Resizer",
					"type" => "heading");


$options[] = array(	"name" => "Thumbnail Image Width",
					"desc" => "<strong>Default: 220px</strong>. Enter an integer value i.e. 250 for the desired width which will be used when dynamically creating the images.",
					"id" => $shortname."_thumb_width",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Thumbnail Image Height",
					"desc" => "<strong>Default: 132px</strong>. Enter an integer value i.e. 180 for the desired height which will be used when dynamically creating the images.",
					"id" => $shortname."_thumb_height",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Disable Single Post",
					"desc" => "Check this if you don't want to display the thumbnail on the single posts.",
					"id" => $shortname."_image_single",
					"std" => "false",
					"type" => "checkbox");																

$options[] = array(	"name" => "Single Width",
					"desc" => "<strong>Default: 600px</strong>. Enter an integer value i.e. 150 for the desired height which will be used when dynamically creating the images. ",
					"id" => $shortname."_single_width",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Single Height",
					"desc" => "<strong>Default: 300px</strong>. Enter an integer value i.e. 150 for the desired height which will be used when dynamically creating the images. ",
					"id" => $shortname."_single_height",
					"std" => "",
					"type" => "text");																			    								

 
$options[] = array(	"name" => "Sub Boxes",
					"type" => "heading");


$options[] = array(	"name" => "Disable Sub Boxes",
					"desc" => "Check this if you don't want to display Sub Boxes",
					"id" => $shortname."_footer_block",
					"std" => "false",
					"type" => "checkbox");																

$options[] = array(	"name" => "Sub Box Title 1",
					"desc" => "Sub Box Title 1",
					"id" => $shortname."_footer_block_title1",
					"std" => "Business title one",
					"type" => "text");																			    								

$options[] = array(	"name" => "Sub Box Sub Title 1",
					"desc" => "Sub Box Sub Title 1",
					"id" => $shortname."_footer_block_sub_title1",
					"std" => "Business title one detail..",
					"type" => "text");																			    								

$options[] = array(	"name" => "Sub Box Text 1",
					"desc" => "Sub Box Text 1",
					"id" => $shortname."_footer_block_text1",
					"std" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum is simply dummy. ",
					"type" => "textarea");																			    								

$options[] = array(	"name" => "Sub Box Read More Link 1",
					"desc" => "Sub Box Read More Link 1",
					"id" => $shortname."_footer_block_link1",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Sub Box Image 1",
					"desc" => "Sub Box Image 1",
					"id" => $shortname."_footer_block_img1",
					"std" => "http://yoursite.com/images/briefcase.png",
					"type" => "text");																			    								

$options[] = array(	"name" => "Sub Box Title 2",
					"desc" => "Sub Box Title 2",
					"id" => $shortname."_footer_block_title2",
					"std" => "Business title two",
					"type" => "text");																			    								

$options[] = array(	"name" => "Sub Box Sub Title 2",
					"desc" => "Sub Box Sub Title 2",
					"id" => $shortname."_footer_block_sub_title2",
					"std" => "Business title one detail..",
					"type" => "text");																			    								

$options[] = array(	"name" => "Sub Box Text 2",
					"desc" => "Sub Box Text 2",
					"id" => $shortname."_footer_block_text2",
					"std" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum is simply dummy. ",
					"type" => "textarea");																			    								

$options[] = array(	"name" => "Sub Box Read More Link 2",
					"desc" => "Sub Box Read More Link 2",
					"id" => $shortname."_footer_block_link2",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Sub Box Image 2",
					"desc" => "Sub Box Image 2",
					"id" => $shortname."_footer_block_img2",
					"std" => "http://yoursite.com/images/cart.png",
					"type" => "text");																			    								


$options[] = array(	"name" => "Sub Box Title 3",
					"desc" => "Sub Box Title 3",
					"id" => $shortname."_footer_block_title3",
					"std" => "Business title three",
					"type" => "text");																			    								

$options[] = array(	"name" => "Sub Box Sub Title 3",
					"desc" => "Sub Box Sub Title 3",
					"id" => $shortname."_footer_block_sub_title3",
					"std" => "Business title one detail..",
					"type" => "text");																			    								

$options[] = array(	"name" => "Sub Box Text 3",
					"desc" => "Sub Box Text 3",
					"id" => $shortname."_footer_block_text3",
					"std" => "",
					"type" => "textarea");	

$options[] = array(	"name" => "Sub Box Read More Link 3",
					"desc" => "Sub Box Read More Link 3",
					"id" => $shortname."_footer_block_link3",
					"std" => "",
					"type" => "text");	

$options[] = array(	"name" => "Sub Box Image 3",
					"desc" => "Sub Box Image 3",
					"id" => $shortname."_footer_block_img3",
					"std" => "http://yoursite.com/images/world.png",
					"type" => "text");		


$options[] = array(	"name" => "Blog Feed's and Share",
					"type" => "heading");


$options[] = array(	"name" => "Disable Blog Feed's and Share",
					"desc" => "Check this if you don't want to display Blog Feed's and Share",
					"id" => $shortname."_blog_feed",
					"std" => "false",
					"type" => "checkbox");																

$options[] = array(	"name" => "Blog Feed's and Share - FaceBook Link",
					"desc" => "Blog Feed's and Share - FaceBook Link",
					"id" => $shortname."_blog_feed_facebook",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Blog Feed's and Share - Twitter Link",
					"desc" => "Blog Feed's and Share - Twitter Link",
					"id" => $shortname."_blog_feed_twitter",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Blog Feed's and Share - Technorati Link",
					"desc" => "Blog Feed's and Share - Technorati Link",
					"id" => $shortname."_blog_feed_technorati",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Blog Feed's and Share - Mi Link",
					"desc" => "Blog Feed's and Share - Mi Link",
					"id" => $shortname."_blog_feed_mi",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Potfolio - Blog SideBar",
					"type" => "heading");


$options[] = array(	"name" => "Disable Potfolio - Blog SideBar",
					"desc" => "Check this if you don't want to display Potfolio in Blog SideBar",
					"id" => $shortname."_portofolio",
					"std" => "false",
					"type" => "checkbox");																

?>