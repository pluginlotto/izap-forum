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

$query = get_input('qry');
/* in this case $query is defined as
 * $query[0] -> category_guid
 * $query[1] -> parent_guid
 * $query[2] -> topic_guid
 */

$title_links = '<a href="'.$CONFIG->wwwroot.'pg/forum/"  style="color: #FFFFFF">'.forum_echo('index').'</a>';
$default_forward_url = $CONFIG->wwwroot . 'pg/forum/';
$category = get_entity((int) $query[0]);
if($category) {
  $array_2_send['category'] = $category;
  $title = $category->title;
  $title_links .= ' > <a href="'.$CONFIG->wwwroot.'pg/forum/list/'.$category->guid.'/'.friendly_title($category->title).'/" style="color: #FFFFFF">'.$category->title.'</a>';
}else{
  forward($default_forward_url);
}

$main_topic = get_entity((int) $query[1]);
if($main_topic) {
  $array_2_send['parent'] = $main_topic;
  $title .= ' - ' . $main_topic->title;
  $title_links .= ' > <a href="'.$CONFIG->wwwroot.'pg/forum/list/'.$category->guid.'/'. $main_topic->guid . '/' .friendly_title($main_topic->title).'/" style="color: #FFFFFF">'.$main_topic->title.'</a>';
}else{
  forward($default_forward_url);
}

$topic = get_entity((int) $query[2]);
if($topic) {
  $array_2_send['topic'] = $topic;
  $title .= ' - ' . $topic->title;
  $title_links .= ' > <b>'.$topic->title.'</b>';
}else{
  forward($default_forward_url);
}


if(!is_array($array_2_send)){
  forward($CONFIG->wwwroot.'pg/forum/');
}

$array_2_send['navigation'] = $title_links;
$area2 .= func_izap_bridge_view('forum/action_bar', $array_2_send);
$area2 .= '<div class="izap_froum_category_wrapper contentWrapper blue_back">';
$area2 .= func_izap_bridge_view('forum/topic', $array_2_send);
$area2 .= '</div>';
$body = elgg_view_layout('two_column_left_sidebar', '', $area2);
page_draw($title, $body);
func_increment_views_byizap($topic);