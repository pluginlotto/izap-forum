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
$query_params = get_input('qry');
$topic = get_entity($query_params[0]);
$array_2_send = array();
if($topic) {
  $array_2_send['entity'] = $topic;
  $extra_title = ' ('.$topic->title.')';
}

$title = forum_echo('topic:add');
$form = elgg_view_title($title . $extra_title);
$form .= func_izap_bridge_view('forms/_partial', $array_2_send);
$body = elgg_view_layout('two_column_left_sidebar', '', $form);
page_draw($title, $body);