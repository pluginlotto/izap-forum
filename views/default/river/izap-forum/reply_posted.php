<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */
//c($vars['item']);

$description = get_annotation($vars['item']->annotation_id)->value;
$post = get_entity($vars['item']->object_guid)->title;
//$description = $post->description;


$string = "<div class=\"river_content_display\">";
$string .= ' has replied on  ' .$post;

$string .= '<br />'.$description;
$string .= '</div><div class="clearfloat"></div>';
echo $string;


