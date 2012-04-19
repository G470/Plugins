<?php if (!defined('SITE')) exit('No direct script access allowed');

function nextlink(){
$OBJ = get_instance();
global $rs;

$pages = $OBJ->db->fetchArray("SELECT id, url
FROM ".PX."objects, ".PX."sections
WHERE status = '1'
AND hidden != '1'
AND section_id = secid
ORDER BY sec_ord ASC, ord ASC");

if (!$pages) return 'Error with pages query';
foreach ($pages as $reord){
$order[$reord['sec_desc']][] = array(
'id' => $reord['id'],
'url' => $reord['url']);
}
$active = false;
foreach($order as $key => $out)
{
foreach($out as $page){
if ($active==true){
$nextlink=$page['url'];
$active = false;}
$active = ($rs['id'] == $page['id']) ? true : false;
}
$next .= "<a style='color:#fff' href='".BASEURL.ndxz_rewriter($nextlink)."'>&raquo; next</a>";
}
return $next;
}
?>