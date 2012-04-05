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

/**
 * add discussion status widget
 */
$subtopic = elgg_extract('subtopic', $vars);
$info = array(
    array(
        'name' => elgg_echo('izap_forum:discussion_posts'),
        'value' => $subtopic->total_posts),
    array(
        'name' => elgg_echo('izap_forum:discussion_views'),
        'value' => IzapBase::getViews($subtopic)),
    array(
        'name' => elgg_echo('izap_forum:discussion_created_on'),
        'value' => elgg_get_friendly_time($subtopic->time_created)
    ),
    array(
        'name' => elgg_echo('izap_forum:discussion_created_by'),
        'value' => IzapBase::getOwnername($subtopic),
    )
);
?>
<div class="forum-widget">
  <h3><?php echo elgg_echo('izap_forum:discussion_info'); ?></h3>
  <ol>
    <?php foreach ($info as $key => $side_data): ?>
      <li class="<?php echo (!($key % 2)) ? 'odd' : 'even'; ?>" ><?php echo $side_data['name'] . $side_data['value']; ?></li>
    <?php endforeach; ?>
      <li><?php echo elgg_view('output/tags', array('value' => array_slice($subtopic->tags, 0, 5))); ?></li>
  </ol>
</div>