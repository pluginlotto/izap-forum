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
$main_topic = elgg_extract('parent',$vars);


?>
<table class="category_table"><caption class="category_caption"><?php echo elgg_echo('izap-forum:subtopics');
?>
    <a href="<?php echo IzapBase::setHref(array(
        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
        'action' => 'add_sub_topic',
        'vars' => array($main_topic->category_guid,$main_topic->guid)
    ))
    ?>">
<?php echo elgg_Echo('izap_forum:list_add_subtopic')?>
      </a>
  </caption>
  <tr class ="header_background">
    <th>
<?php
$header_array = array(
    array(
        'title' => elgg_echo('title')
    ),
    array(
        'title' => elgg_echo('replies')
    ),
    array(
        'title' => elgg_echo('views')
    ),
    array(
        'title' => elgg_echo('last_post')
    ),
);
echo elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/header', array('header_elements' => $header_array));
?>
    </th>
  </tr>
  <tr>
    <td>
<?php
echo $vars['subtopics'];
?>
    </td>
  </tr>

</table>

