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

gatekeeper();
global $IZAPTEMPLATE;
$query_params = get_input('qry');
$topic = get_entity($query_params[0]);
$array_2_send = array();
if($topic) {
  $array_2_send['parent'] = $topic;
  $extra_title = ' ('.$topic->title.')';
}

$title = forum_echo('topic:add');
$form = elgg_view_title($title . $extra_title);
$form .= $IZAPTEMPLATE->render('forms/_partial', $array_2_send);
$IZAPTEMPLATE->drawPage(array(
  'title' => $title,
  'area2' => $form,
));