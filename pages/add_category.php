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
set_context('admin');
$query_params = get_input('qry');
if(isset($query_params[0]) && ($entity = get_entity($query_params[0]))) {
  $IzapForumCategory = $entity;
}
$title = forum_echo('categories:add_category');
$form = elgg_view_title($title);
$form .= func_izap_bridge_view('forms/add_category', array('plugin' => 'izap-forum', 'entity' => $IzapForumCategory));
$body = elgg_view_layout('two_column_left_sidebar', '', $form);
page_draw($title, $body);
