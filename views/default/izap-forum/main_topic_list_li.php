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

$topics = elgg_extract('topics', $vars);

?>
<div class="main_topic_title">
  <?php echo elgg_echo('izap-forum:list_topics')?>
</div>
<?php foreach($topics as $topic):
  $sticky_class = ($topic->sticky_topic == 'yes' && (int) $vars['current_topic']->guid != $topic->guid) ? 'style="background-color: #FFE9E9;"' : '';?>
<div class="topic_list <?php echo ((int) $vars['current_topic']->guid == $topic->guid) ? 'selected' : '' ?>"<?php echo $sticky_class?>  >
  <div class="topic_img">
<?php echo elgg_view_entity_icon($topic->getOwnerEntity(),'tiny',array('hover'=>false)); ?>
    </div>
  <div class="topic_title">
    <?php echo $topic->getLink(array(
              'text' => $topic->getTitle(array(
                  'mini' => true,
                  'max_length' => 15)) . ' - ' . (int) $topic->total_topics,
              'title' => $topic->title
          ));
    if ($topic->canEdit(elgg_get_logged_in_user_guid())) :
    ?>
  </div>
  
  <div class="topic_edit_link">

    <a href ="<?php
            echo IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'add_topic',
                'vars' => array($topic->guid),
                'page_owner' => false
            ))
      ?>">
           <img src="<?php echo $vars['url'] . 'mod/' . GLOBAL_IZAP_FORUM_PLUGIN . '/_graphics/edit.png' ?>" />
         </a>
    <?php
    if ($topic->total_topics <= 0) {
              $link_img = '<img src="' . $vars['url'] . 'mod/' . GLOBAL_IZAP_FORUM_PLUGIN . '/_graphics/delete.png" />';
              echo elgg_view('output/confirmlink', array(
                  'href' => IzapBase::deleteLink(array(
                      'guid' => $topic->guid,
                      'rurl' => IzapBase::setHref(array(
                          'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                          'action' => 'index'
                      )),
                      'only_url' => true
                  )),
                  'text' => $link_img
              ));
            }
 endif;    ?>
  </div>

  <div class="clearfloat"></div>
</div>
<?php

 endforeach;?>