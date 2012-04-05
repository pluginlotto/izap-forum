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
?>

<?php
/**
 *  post listing and reply form
 */
?>
<div class="discussions">
  <div class="discussions_list">
    <table>
      <?php echo $vars['discussion_list']; ?>
    </table>
  </div>

  <div class="reply_form">
    <?php echo $vars['form']; ?>
  </div>
</div>