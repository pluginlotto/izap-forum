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
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));
?>
<div class ="elgg-col-1of1 izap-table-cols">
  <?php echo $nav?>
  <div class="elgg-col elgg-col-1of3">
<?php echo $vars['sidebar'];?>
  </div>

  <div class="elgg-col elgg-col-2of3">
<?php echo $vars['content'];?>
  </div>
</div>