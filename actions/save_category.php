<?php
/**************************************************
* iZAP Web Solutions                              *
* Copyrights (c) 2005-2009. iZAP Web Solutions.   *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Kumar<tarun@izap.in>"
 */


admin_gatekeeper();
global $CONFIG;

if(!$CONFIG->post_byizap->form_validated) {
  register_error(forum_echo('error:title_blank'));
  forward($_SERVER['HTTP_REFERER']);
}

$izap_forum_categories = new ElggObject($CONFIG->post_byizap->attributes['guid']);
$izap_forum_categories->access_id = ACCESS_PUBLIC;
$izap_forum_categories->subtype = 'IzapForumCategories';
$izap_forum_categories->title = $CONFIG->post_byizap->attributes['title'];
$izap_forum_categories->description = $CONFIG->post_byizap->attributes['description'];

if($izap_forum_categories->save()) {
  system_message(forum_echo('message:category_saved'));
  forward($CONFIG->wwwroot . 'pg/forums/categories_list/');
}else{
  register_error(forum_echo('error:category_not_saved'));
  forward($_SERVER['HTTP_REFERER']);
}
exit;