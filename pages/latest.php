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

$title = forum_echo('latest');
$area2 = elgg_view_title($title);
$options['limit'] = 20;
$entities = func_get_latest_forum_topics($options);
$entities = elgg_view_entity_list($entities['entities'], $entities['count'], get_input('offset', 0), $options['limit'], FALSE, FALSE);
if(get_input('view') == 'rss') {
  $area2 .= $entities;
}else {
  $area2 .= func_izap_bridge_view('forum/latest', array('entities' => $entities));
}
$body = elgg_view_layout('two_column_left_sidebar', '', $area2);
page_draw($title, $body);