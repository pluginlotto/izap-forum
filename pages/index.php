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
$title = forum_echo('index');
$area2 = elgg_view_title($title);
$area2 .= $IZAPTEMPLATE->render('forum/index');
global $autofeed;
$autofeed = FALSE;
$IZAPTEMPLATE->drawPage(array(
  'area2' => $area2,
  'title' => $title,
));
