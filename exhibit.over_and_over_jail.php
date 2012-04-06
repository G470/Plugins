<?php if (!defined('SITE')) exit('No direct script access allowed');

/**
* Over and over
*
* Exhbition format
* 
* @version 1.0
* @author Vaska 
*/

// defaults from the general libary - be sure these are installed
$exhibit['dyn_css'] = dynamicCSS();
// ** load some javascript files from the lib **//
$exhibit['lib_js'] = array('jail-min.js');
// ** load dynamic javascript  **//
$exhibit['dyn_js'] = dynamicJS();

$exhibit['exhibit'] = createExhibit();

function dynamicJS()
{
return "
$(function(){
 $('img.lazy').jail({
	 effect: 'fadeIn',
     speed: 'slow', 
				   });  
});";
}





function createExhibit()
{
	$OBJ =& get_instance();
	global $rs;
	
	$pages = $OBJ->db->fetchArray("SELECT * 
		FROM ".PX."media, ".PX."objects_prefs 
		WHERE media_ref_id = '$rs[id]' 
		AND obj_ref_type = 'exhibit' 
		AND obj_ref_type = media_obj_type 
		ORDER BY media_order ASC, media_id ASC");
		
	// ** DON'T FORGET THE TEXT ** //
	$s = $rs['content'];
	$s .= "\n<div class='cl'><!-- --></div>\n";

	if (!$pages) return $s;
	
	$i = 1; $a = '';
	
	// people will probably want to customize this up
	foreach ($pages as $go)
	{
		$text = ($go['media_title'] == '') ? '' : $go['media_title'];
		$text .= ($go['media_caption'] == '') ? '&nbsp;' : ': ' . $go['media_caption'];
		
		$a .= "<p>
				<img class='lazy' data-href='" . BASEURL . GIMGS . "/$go[media_file]' width='".$go['media_x']."' height='".$go['media_y']."' src='" . BASEURL . "/ndxz-studio/site/img/blank.gif' alt='$go[media_caption]' />
				<noscript>
    			<img class='lazy' src='" . BASEURL . GIMGS . "/$go[media_file]' alt='$go[media_caption]' />
    			</noscript>
				
				<br />\n<span>$text</span>\n</p>
	\n";
		$i++;
	}
	
	// images
	$s .= "<div id='img-container'>\n";
	$s .= $a;
	$s .= "</div>\n";
		
	return $s;
}


function dynamicCSS()
{
	return "#img-container p { margin-bottom: 18px; }\n#img-container p span { line-height: 18px; }";
}



?>