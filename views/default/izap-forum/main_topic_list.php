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

$topics = elgg_extract('topics', $vars);
?>
<table class="category_table">
  <caption class="category_caption">
    <?php echo elgg_echo('izap_forum:category_forum'); ?>
    <a href="<?php
    echo IzapBase::setHref(array(
        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
        'action' => 'add_topic',
    )); ?>">
      <?php echo elgg_echo('izap_forum:add_new_Cat') ?></a>

  </caption>
  <tr>
    <th>
      <?php echo elgg_echo('izap-forum:categories_title'); ?>
    </th>
  </tr>
  <?php
      foreach ($topics as $topic):
  ?>
        <tr class="decorate">
          <td <?php echo ((int) $vars['current_topic']->guid == $topic->guid) ? 'class="selected"' : '' ?>>
<?php echo $topic->getLink(array('text' => $topic->title . ' - ' . (int)$topic->total_topics)); ?>
          </td>
        </tr>

<?php
        endforeach;
?>
</table>