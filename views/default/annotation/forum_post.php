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

$img = $CONFIG->wwwroot . 'mod/' . GLOBAL_IZAP_FORUM_PLUGIN . '/_graphics/delete.png';

$delete_link = elgg_view('output/confirmlink', array(
                  'href' =>izapBase::getFormAction('delete', GLOBAL_IZAP_FORUM_PLUGIN) . "?id=" . $annotation->id ,
                  'text' => '<img src="'.$img.'" />'
              ));
?>
<div class="annotation_wrapper">
  
  <div class="annotation_sidebar">
    <div class="annotation_icon">
      <a href="<?php echo $user->getURL(); ?>">
        <img src="<?php echo $user->getIconURL('small'); ?>" alt="<?php echo $user->name ?>"/>
      </a>
    </div>
  </div>

  <div class="annotation_content" >
    <?php if (elgg_is_admin_logged_in ()): ?>
      <div style="float: right"><?php echo $delete_link; ?></div>
    <?php endif;?>
    <?php echo $annotation->value; ?>
      <div class="username" >
        <a href="<?php echo $user->getURL(); ?>"><?php echo $user->name;?></a>
              <span class="annotation_time">
        <?php echo elgg_get_friendly_time($annotation->time_created)?>
      </span>
      </div>
  </div>
  <div class="clearfloat"></div>
</div>


