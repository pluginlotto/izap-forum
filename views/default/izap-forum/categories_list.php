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

$categories = elgg_extract('categories', $vars);
?>
<table class="category_table">
  <caption class="category_caption">
    <?php echo elgg_echo('izap_forum:category_forum'); ?>
    <a href="<?php
    echo IzapBase::setHref(array(
        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
        'action' => 'add_category',
    )); ?>">
      <?php echo elgg_echo('izap_forum:add_new_Cat') ?></a>

  </caption>
  <tr>
    <th>
      <?php echo elgg_echo('izap-forum:categories_title'); ?>
    </th>
  </tr>
  <?php
      foreach ($categories as $category):
  ?>
        <tr class="decorate">
          <td <?php echo ((int) $vars['current_category']->guid == $category->guid) ? 'class="selected"' : '' ?>>
<?php echo $category->getLink(array('text' => $category->title . ' - ' . (int)$category->total_topics)); ?>
          </td>
        </tr>

<?php
        endforeach;
?>
</table>