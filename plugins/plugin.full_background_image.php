<?PHP 

/*==================================================*/
/*======= Indexhibit full background image =========*/
/*=======        Plugin version 1.0        =========*/
/*==================================================*/

/*  @author Steffen Görg aka G470 http://gatonet.de */

/*===================== USAGE ======================*/
/*==================================================*/
/*== Upload your background image to your server, 
/*== add the plugin code with your image url to 
/*== your exhibit   
/*== <plug:full_background_image 'http://yourdomain.com/yourimage.jpeg' /> 
/*==================================================*/



function full_background_image($url=false){
	$bgscript = "<script type=\"text/javascript\">$(function(){
	 $('body').append(\"<div id='bg' style='position: fixed;top: 0;left: 0;z-index: -1;width: 100%;height: 100%;overflow: hidden;'><div id='img' style='position: relative;width: 200%;height: 200%;top: -50%;left: -50%;overflow: hidden;'><img src='".$url."' alt='' style='display: inline-block;position: relative;min-width: 75% !important;min-height: 75% !important; max-width:inherit !important;' /></div></div>\"); });</script> ";
	return $bgscript;
	};
?>
 
