<?php
/* * ************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2010. iZAP                  *
 * All rights reserved                             *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */
$subtopic = elgg_extract('subtopic', $vars);
$info = array(
    array(
        'name' => elgg_echo('izap_forum:discussion_posts'),
        'value' => $subtopic->total_posts),
    array(
        'name' => elgg_echo('izap_forum:discussion_views'),
        'value' => IzapBase::getviews($subtopic)),
    array(
        'name' => elgg_echo('izap_forum:discussion_created_on'),
        'value' => elgg_get_friendly_time($subtopic->time_created)
    ),
    array(
        'name' => elgg_echo('izap_forum:discussion_created_by'),
        'value' => IzapBase::getOwnerUsername($subtopic),
    )
);
?>
<table class="discussion_info">
  <caption class="info_caption">
<?php echo elgg_echo('izap_forum:discussion_info');
?>
  </caption>
<?php foreach ($info as $side_data):
?>
  <tr class="info_decorate"><td>
<?php
  echo $side_data['name'] . ' ' . '<b>' . $side_data['value'] . '</b>';
?></td>
  </tr>
<?php endforeach; ?>
  <tr><td><?php echo elgg_view('output/tags', array('value' => $subtopic->tags)); ?></td>
  
  </tr>
</table>

