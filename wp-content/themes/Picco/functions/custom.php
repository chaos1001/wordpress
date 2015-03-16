<?php 

// Custom fields for WP write panel
// This code is protected under Creative Commons License: http://creativecommons.org/licenses/by-nc-nd/3.0/

$krones_metaboxes = array(
		"image" => array (
			"name"		=> "image",
			"default" 	=> "",
			"label" 	=> "Image",
			"type" 		=> "text",
			"desc"      => "Enter the URL for image to be used by the Dynamic Image resizer."
		),
	);
	
function kroxigo_meta_box_content() {
	global $post, $krones_metaboxes;
	echo '<table>'."\n";
	foreach ($krones_metaboxes as $krones_metabox) {
		$krones_metaboxvalue = get_post_meta($post->ID,$krones_metabox["name"],true);
		if ($krones_metaboxvalue == "" || !isset($krones_metaboxvalue)) {
			$krones_metaboxvalue = $krones_metabox['default'];
		}
		echo "\t".'<tr>';
		echo "\t\t".'<th style="text-align: right;"><label for="'.$krones_metabox.'">'.$krones_metabox['label'].':</label></th>'."\n";
		echo "\t\t".'<td><input size="70" type="'.$krones_metabox['type'].'" value="'.$krones_metaboxvalue.'" name="kroxigo_'.$krones_metabox["name"].'" id="'.$krones_metabox.'"/></td>'."\n";
		echo "\t".'</tr>'."\n";
		echo "\t\t".'<tr><td></td><td><span style="font-size:11px">'.$krones_metabox['desc'].'</span></td></tr>'."\n";				
	}
	echo '</table>'."\n\n";
}

function kroxigo_metabox_insert($pID) {
	global $krones_metaboxes;
	foreach ($krones_metaboxes as $krones_metabox) {
		$var = "kroxigo_".$krones_metabox["name"];
		if (isset($_POST[$var])) {			
			if( get_post_meta( $pID, $krones_metabox["name"] ) == "" )
				add_post_meta($pID, $krones_metabox["name"], $_POST[$var], true );
			elseif($_POST[$var] != get_post_meta($pID, $krones_metabox["name"], true))
				update_post_meta($pID, $krones_metabox["name"], $_POST[$var]);
			elseif($_POST[$var] == "")
				delete_post_meta($pID, $krones_metabox["name"], get_post_meta($pID, $krones_metabox["name"], true));
		}
	}
}

function kroxigo_meta_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box('kroxigo-settings',$GLOBALS['themename'].' Custom Settings','kroxigo_meta_box_content','post','normal');
		add_meta_box('kroxigo-settings',$GLOBALS['themename'].' Custom Settings','kroxigo_meta_box_content','page','normal');
	}
}

add_action('admin_menu', 'kroxigo_meta_box');
add_action('wp_insert_post', 'kroxigo_metabox_insert');
?>