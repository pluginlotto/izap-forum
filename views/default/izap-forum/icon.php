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

$topic = elgg_extract('entity',$vars);
$size = elgg_extract('size',$vars);
?>
<img src = "<?php echo IzapBase::setHref(array(
   'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
    'action' => 'icon',
    'page_owner' => FALSE,
    'vars' => array($topic->guid, $size, )
));?>default.jpg" />