<?php function woothemes_admin_head() { ?>
<style>

h2 { margin-bottom: 20px; }
.title { margin: 0px !important; background: #D4E9FA; padding: 10px; font-family: Georgia, serif; font-weight: normal !important; letter-spacing: 1px; font-size: 18px; }
.container { background: #EAF3FA; padding: 10px; }
.maintable { font-family:"Lucida Grande","Lucida Sans Unicode",Arial,Verdana,sans-serif; background: #EAF3FA; margin-bottom: 20px; padding: 10px 0px; }
.mainrow { padding-bottom: 10px !important; border-bottom: 1px solid #D4E9FA !important; float: left; margin: 0px 10px 10px 10px !important; }
.titledesc { font-size: 14px; font-weight:bold; width: 220px !important; margin-right: 20px !important; }
.forminp { width: 700px !important; valign: middle !important; }
.forminp input, .forminp select, .forminp textarea { margin-bottom: 9px !important; background: #fff; border: 1px solid #D4E9FA; width: 500px; padding: 4px; font-family:"Lucida Grande","Lucida Sans Unicode",Arial,Verdana,sans-serif; font-size: 12px; }
.forminp span { font-size: 10px !important; font-weight: normal !important; ine-height: 14px !important; }
.info { background: #FFFFCC; border: 1px dotted #D8D2A9; padding: 10px; color: #333; }
.forminp .checkbox { width:20px }
.info a { color: #333; text-decoration: none; border-bottom: 1px dotted #333 }
.info a:hover { color: #666; border-bottom: 1px dotted #666; }
.warning { background: #FFEBE8; border: 1px dotted #CC0000; padding: 10px; color: #333; font-weight: bold; }

</style>
<?php }

function woo_options(){
 // VARIABLES
 
$themename = "Fresh Folio";
$shortname = "woo";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/fresh-folio/';
$options = array();

$template_path = get_bloginfo('template_directory');

$layout_path = TEMPLATEPATH . '/layouts/'; 
$layouts = array();

$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

$ads_path = TEMPLATEPATH . '/images/ads/';
$ads = array();

$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

$woo_categories_obj = get_categories('hide_empty=0');
$woo_categories = array();

$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');
$woo_pages = array();

if ( is_dir($layout_path) ) {
	if ($layout_dir = opendir($layout_path) ) { 
		while ( ($layout_file = readdir($layout_dir)) !== false ) {
			if(stristr($layout_file, ".php") !== false) {
				$layouts[] = $layout_file;
			}
		}	
	}
}	

if ( is_dir($alt_stylesheet_path) ) {
	if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
		while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
			if(stristr($alt_stylesheet_file, ".css") !== false) {
				$alt_stylesheets[] = $alt_stylesheet_file;
			}
		}	
	}
}	

if ( is_dir($ads_path) ) {
	if ($ads_dir = opendir($ads_path) ) { 
		while ( ($ads_file = readdir($ads_dir)) !== false ) {
			if((stristr($ads_file, ".jpg") !== false) || (stristr($ads_file, ".png") !== false) || (stristr($ads_file, ".gif") !== false)) {
				$ads[] = $ads_file;
			}
		}	
	}
}

foreach ($woo_categories_obj as $woo_cat) {
	$woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;
}

foreach ($woo_pages_obj as $woo_page) {
	$woo_pages[$woo_page->ID] = $woo_page->post_name;
}

$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$categories_tmp = array_unshift($woo_categories, "Select a category:");
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");

// CATEGORY NAVIGATION

function category_nav($options) {

	$options[] = array(	"name" =>  "Category Navigation",
		"type" => "heading");	

	$cats = get_categories('hide_empty=0');

	foreach ($cats as $cat) {

			$options[] = array(	"name" =>  $cat->cat_name,
						"desc" => "Check this box if you wish to display this category link in the main navigation (top).",
						"id" => "woo_cat_nav_".$cat->cat_ID,
						"std" => "",
						"type" => "checkbox");					
	
	}

	return $options;
	
}

// CATEGORY LISTING (MIDDLE)

function category_middle($options) {		

	$cats = get_categories('hide_empty=0');

	foreach ($cats as $cat) {

			$options[] = array(	"name" =>  $cat->cat_name,
						"desc" => "Check this box if you wish to include this category in the middle panel category listings (homepage).",
						"id" => "woo_cat_mid_".$cat->cat_ID,
						"std" => "",
						"type" => "checkbox");					
	
	}

	return $options;
	
}

// THIS IS THE DIFFERENT FIELDS

$options[] = array(	"name" => "General Settings",
					"type" => "heading");
						
$options[] = array(	"name" => "Theme Stylesheet",
					"desc" => "Please select your colour scheme here.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array(	"name" => "Use Gravatars?",
					"desc" => "Check this box if you wish to use <a href='http://www.gravatar.com'>Gravatars</a> for Author & Commenter profiles.",
					"id" => $shortname."_gravatar",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array(	"name" => "Custom Logo",
					"desc" => "Paste the full URL of your custom logo image, should you wish to replace our default logo.",
					"id" => $shortname."_logo",
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
					
$options[] = array(	"name" => "About Page",
					"desc" => "Please select your about page.",
					"id" => $shortname."_about",
					"std" => "Select a page:",
					"type" => "select",
					"options" => $woo_pages);

$options[] = array(	"name" => "Archives Page",
					"desc" => "Please select your archive page. TIP: Add your archive by creating a new page (Write > Page), and selecting the 'Archive' page template.",
					"id" => $shortname."_archives",
					"std" => "Select a page:",
					"type" => "select",
					"options" => $woo_pages);

$options[] = array(	"name" => "Front page layout",
					"type" => "heading");					

$options[] = array( "name" => "Portfolio Category",
					"desc" => "Select the category that will hold your portfolio posts. The latest post from this category will be displayed on the front page.",
					"id" => $shortname."_pf_cat",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $woo_categories);

$options[] = array(	"name" => "Number of Normal Posts",
					"desc" => "Select the number of large posts you'd like to display on the homepage.",
					"id" => $shortname."_home_normal",
					"std" => "Select a number:",
					"type" => "select",
					"options" => $other_entries);					

$options[] = array(	"name" => "Show full post?",
					"desc" => "Check this to display the full post eg. use the_content() instead of the_excerpt().",
					"id" => $shortname."_home_excerpt",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array(	"name" => "Sidebar Components",
					"type" => "heading");
					
$options[] = array(	"name" => "Flickr ID",
					"desc" => "Use <a href='http://idgettr.com/'>idGettr to find it.",
					"id" => $shortname."_flickr_id",
					"std" => "",
					"type" => "text");											

$options[] = array(	"name" => "Number photos",
					"desc" => "Select the number of photos to display in flickr sidebar box. (3 per row)",
					"id" => $shortname."_flickr_entries",
					"std" => "Select a Number:",
					"type" => "select",
					"options" => $other_entries);	
					
$options[] = array(	"name" => "Image Resizer settings",
					"type" => "heading");

$options[] = array(	"name" => "Enable Portfolio",
					"desc" => "Image resizer will automatically resize the images you upload. You need to set wp-content/themes/themename/cache folder to CHMOD 777.",
					"id" => $shortname."_portfolio_resize",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array(	"name" => "Portfolio Image Width",
					"desc" => "<strong>Default = 515px</strong>. Enter an integer value i.e. 250 for the desired width which will be used when dynamically creating the images. ",
					"id" => $shortname."_portfolio_image_width",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Portfolio Image Height",
					"desc" => "<strong>Default = 180px</strong>. Enter an integer value i.e. 250 for the desired width which will be used when dynamically creating the images. ",
					"id" => $shortname."_portfolio_image_height",
					"std" => "",
					"type" => "text");																			    								

$options[] = array(	"name" => "Enable Thumbnails",
					"desc" => "Image resizer will automatically resize the images you upload. You need to set wp-content/themes/themename/cache folder to CHMOD 777.",
					"id" => $shortname."_thumb_resize",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array(	"name" => "Thumbnail Width",
					"desc" => "<strong>Default = 75px</strong>. Enter an integer value i.e. 250 for the desired width which will be used when dynamically creating the images. ",
					"id" => $shortname."_thumb_width",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Thumbnail Height",
					"desc" => "<strong>Default = 75px</strong>. Enter an integer value i.e. 250 for the desired width which will be used when dynamically creating the images. ",
					"id" => $shortname."_thumb_height",
					"std" => "",
					"type" => "text");																			    																																		

$options[] = array(	"name" => "Enable Posts",
					"desc" => "Image resizer will automatically resize the images you upload. You need to set wp-content/themes/themename/cache folder to CHMOD 777.",
					"id" => $shortname."_posts_resize",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array(	"name" => "Post Image Width",
					"desc" => "<strong>Default = 440px</strong>. Enter an integer value i.e. 250 for the desired width which will be used when dynamically creating the images. ",
					"id" => $shortname."_posts_image_width",
					"std" => "",
					"type" => "text");

$options[] = array(	"name" => "Post Image Height",
					"desc" => "<strong>Default = 150px</strong>. Enter an integer value i.e. 250 for the desired width which will be used when dynamically creating the images. ",
					"id" => $shortname."_posts_image_height",
					"std" => "",
					"type" => "text");																			    								

//Update Options

update_option('woo_template',$options);      
update_option('woo_themename',$themename);   
update_option('woo_shortname',$shortname);  
         
// Widgets
require_once ($includes_path . '/widgets.php');

}     

add_action('init','woo_options');   

require_once (TEMPLATEPATH . '/functions/custom.php');       

// ADMIN PANEL

function woothemes_add_admin() {

    $options =  get_option('woo_template');      
    $themename =  get_option('woo_themename');      
    $shortname =  get_option('woo_shortname');      

	
	if ( $_GET['page'] == basename(__FILE__) ) {	
        if ( 'save' == $_REQUEST['action'] ) {
	
                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;
							update_option($up_opt, $_REQUEST[$up_opt] );
						}
					}
				}

                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;						
							if( isset( $_REQUEST[ $up_opt ] ) ) { update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); } 
						}
					}
				}
						
				header("Location: admin.php?page=functions.php&saved=true");								
			
			die;

		} else if ( 'reset' == $_REQUEST['action'] ) {
			delete_option('sandbox_logo');
			
			header("Location: admin.php?page=functions.php&reset=true");
			die;
		}

	}

add_menu_page($themename." Options", $themename." Options", 'edit_themes', basename(__FILE__), 'woothemes_page');

}

function woothemes_page (){

		global  $manualurl;
        $options =  get_option('woo_template');      
        $themename =  get_option('woo_themename');      
        $shortname =  get_option('woo_shortname');      

		?>

<div class="wrap">

    			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

						<h2><?php echo $themename; ?> Options</h2>

						<?php if ( $_REQUEST['saved'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?>'s Options has been updated!</div><?php } ?>
						<?php if ( $_REQUEST['reset'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?>'s Options has been reset!</div><?php } ?>						
						
						<div style="clear:both;height:20px;"></div>
						
						<div class="info">
						
							<div style="width: 70%; float: left; display: inline;padding-top:4px;"><strong>Stuck on these options?</strong> <a href="<?php echo $manualurl; ?>" target="_blank">Read The Documentation Here</a> or <a href="http://forum.woothemes.com" target="blank">Visit Our Support Forum</a></div>
							<div style="width: 30%; float: right; display: inline;text-align: right;"><input name="save" type="submit" value="Save changes" /></div>
							<div style="clear:both;"></div>
						
						</div>	    			
						
						<!--START: GENERAL SETTINGS-->
     						
     						<table class="maintable">
     							
							<?php foreach ($options as $value) { ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<tr class="mainrow">
										<td class="titledesc"><?php echo $value['name']; ?></td>
										<td class="forminp">
		
									<?php } ?>		 
	
									<?php
										
										switch ( $value['type'] ) {
										case 'text':
		
									?>
									
		        							<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings($value['id']); } else { echo $value['std']; } ?>" />
		
									<?php
										
										break;
										case 'select':
		
									?>
		
	            						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                					<?php foreach ($value['options'] as $option) { ?>
	                						<option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                					<?php } ?>
	            						</select>
		
									<?php
		
										break;
										case 'textarea':
										$ta_options = $value['options'];
		
									?>
									
										<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="8"><?php  if( get_settings($value['id']) != "") { echo stripslashes(get_settings($value['id'])); } else { echo $value['std']; } ?></textarea>
		
									<?php
										
										break;
										case "radio":
		
 										foreach ($value['options'] as $key=>$option) { 
				
													$radio_setting = get_settings($value['id']);
													
													if($radio_setting != '') {
		    											
		    											if ($key == get_settings($value['id']) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
													
													} else {
													
														if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
									} ?>
									
	            					<input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
		
									<?php }
		 
										break;
										case "checkbox":
										
										if(get_settings($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }
									
									?>
		            				
		            				<input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
		
									<?php
		
										break;
										case "multicheck":
		
 										foreach ($value['options'] as $key=>$option) {
 										
	 											$woo_key = $value['id'] . '_' . $key;
												$checkbox_setting = get_settings($woo_key);
				
 												if($checkbox_setting != '') {
		    		
		    											if (get_settings($woo_key) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				
												} else { if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				
									} ?>
									
	            					<input type="checkbox" class="checkbox" name="<?php echo $woo_key; ?>" id="<?php echo $woo_key; ?>" value="true" <?php echo $checked; ?> /><label for="<?php echo $woo_key; ?>"><?php echo $option; ?></label><br />
									
									<?php }
		 
										break;
										case "heading":

									?>
									
										</table> 
		    							
		    									<h3 class="title"><?php echo $value['name']; ?></h3>
										
										<table class="maintable">
		
									<?php
										
										break;
										default:
										break;
									
									} ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<?php if ( $value['type'] <> "checkbox" ) { ?><br/><?php } ?><span><?php echo $value['desc']; ?></span>
										</td></tr>
	
									<?php } ?>		
	
							<?php } ?>	
							
							</table>	

							<p class="submit">
								<input name="save" type="submit" value="Save changes" />    
								<input type="hidden" name="action" value="save" />
							</p>							
							
							<div style="clear:both;"></div>		
						
						<!--END: GENERAL SETTINGS-->						
             
            </form>

</div><!--wrap-->

<div style="clear:both;height:20px;"></div>
 
 <?php

};

function woothemes_wp_head() { 
     $style = $_REQUEST[style];
     if ($style != '') {
          ?> <link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $style; ?>.css" rel="stylesheet" type="text/css" /><?php 
     } else { 
          $stylesheet = get_option('woo_alt_stylesheet');
          if($stylesheet != ''){
               ?><link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $stylesheet; ?>" rel="stylesheet" type="text/css" /><?php         
          }
     }     
}

add_action('wp_head', 'woothemes_wp_head');
add_action('admin_menu', 'woothemes_add_admin');
add_action('admin_head', 'woothemes_admin_head');	

// OTHER FUNCTIONS

if ( function_exists('register_sidebar') )
    register_sidebars(3,array(
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

$bm_trackbacks = array();
$bm_comments = array();

function split_comments( $source ) {

    if ( $source ) foreach ( $source as $comment ) {

        global $bm_trackbacks;
        global $bm_comments;

        if ( $comment->comment_type == 'trackback' || $comment->comment_type == 'pingback' ) {
            $bm_trackbacks[] = $comment;
        } else {
            $bm_comments[] = $comment;
        }
    }
} 



?>