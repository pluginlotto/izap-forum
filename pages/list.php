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

global $IZAPTEMPLATE;
$query = get_input('qry');
/* in this case $query is defined as
 * $query[0] -> category_guid
 * $query[1] -> topic_guid
*/

$title_links = '<a href="'.$CONFIG->wwwroot.'pg/forums/">'.forum_echo('index').'</a>';

$category = get_entity((int) $query[0]);
if($category) {
  $array_2_send['category'] = $category;
  $title = $category->title;
  $title_links .= ' > <a href="'.$CONFIG->wwwroot.'pg/forums/list/'.$category->guid.'/'.friendly_title($category->title).'/">'.$category->title.'</a>';
}

$topic = get_entity((int) $query[1]);
if($topic) {
  $array_2_send['topic'] = $topic;
  $title .= ' - ' . $topic->title;
  $title_links .= ' > <a href="'.$CONFIG->wwwroot.'pg/forums/list/'.$category->guid.'/'. $topic->guid . '/' .friendly_title($topic->title).'/">'.$topic->title.'</a>';
  $array_2_send['add_action'] = TRUE;
  $array_2_send['paging'] = TRUE;
}

if(!is_array($array_2_send)) {
  forward($CONFIG->wwwroot.'pg/forums/');
}

$array_2_send['navigation'] = $title_links;
$area2 .= $IZAPTEMPLATE->render('forum/action_bar', $array_2_send);
$array_2_send['print_header'] = TRUE;
$array_2_send['limit'] = 20;
$area2 .= $IZAPTEMPLATE->render('forum/list_topics', $array_2_send);
global $autofeed;
$autofeed = FALSE;
$IZAPTEMPLATE->drawPage(array(
  'title' => $title,
  'area2' => $area2
));