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
$title = forum_echo('categories:category_list');
$area2 = elgg_view_title($title);
$area2 .= elgg_list_entities(array('type' => 'object', 'subtype' => 'IzapForumCategories', 'offset' => get_input('offset')));
$IZAPTEMPLATE->drawPage(array(
  'title' => $title,
  'area2' => $area2,
));
