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
$annotation = $vars['annotation'];
$user = get_entity($annotation->owner_guid);
//c($entity = get_entity($annotation->entity_guid));
?>
<div class="annotation_wrapper">
  
  <div class="annotation_sidebar">
    <div class="annotation_icon">
      <a href="<?php echo $user->getURL(); ?>">
        <img src="<?php echo $user->getIconURL('large'); ?>" alt="<?php echo $user->name ?>" height="140" width="138"/>
      </a>
      <span class="username">
        <a href="<?php echo $user->getURL(); ?>"><?php echo $user->name?></a>
      </span><span class="annotation_time">
        <?php echo elgg_get_friendly_time(get_entity($vars['guid'])->last_post_at)?>
      </span>
    </div>
  </div>

  <div class="annotation_content">
    <?php echo $annotation->value; ?>
  </div>
  <div class="clearfloat"></div>
</div>


