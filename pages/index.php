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

$title = forum_echo('index');
$area2 = elgg_view_title($title);
$area2 .= func_izap_bridge_view('forum/index');
$body = elgg_view_layout('two_column_left_sidebar', '', $area2);
page_draw($title, $body);
