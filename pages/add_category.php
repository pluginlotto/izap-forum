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
global $IZAPTEMPLATE;
$query_params = get_input('qry');
if(isset($query_params[0]) && ($entity = get_entity($query_params[0]))) {
  $IzapForumCategory = $entity;
}
$title = forum_echo('categories:add_category');
$form = elgg_view_title($title);
$form .= $IZAPTEMPLATE->render('forms/add_category', array('entity' => $IzapForumCategory));
$IZAPTEMPLATE->drawPage(array(
  'title' => $title,
  'area2' => $form,
));