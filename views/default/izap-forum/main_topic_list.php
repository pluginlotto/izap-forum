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
<table class="category_table" cellpadding="0" cellspacing="0">
  <caption class="category_caption">
<!--        <a href="<?php
//    echo IzapBase::setHref(array(
//        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
//        'action' => 'add_topic',
//    )); ?>" class="elgg-button elgg-button-action">
      <?php //echo elgg_echo('izap_forum:add_new_topic') ?></a>-->

  </caption>
  <tr>
    <th colspan="4">
      <?php echo elgg_echo('izap-forum:topic_title'); ?>
    </th>

  </tr>
  <?php
      if ($topics):
        foreach ($topics as $topic):
  ?>
  <tr class="decorate <?php echo ((int) $vars['current_topic']->guid == $topic->guid) ? 'selected' : '' ?>" style="padding: 0px; margin: 0px;">
    <td class="izap-forum-icon-main">
      <?php echo elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/icon', array('entity' => $topic, 'size' => 'tiny')); ?>
        </td >
        <td>
      <?php
          echo $topic->getLink(array(
              'text' => $topic->getTitle(array(
                  'mini' => true,
                  'max_length' => 40)) . ' - ' . (int) $topic->total_topics,
              'title' => $topic->title
          ));
          if ($topic->canEdit(elgg_get_logged_in_user_guid())) {
      ?></td>
          <td>
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
       </td>
       <td><?php
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
          }
      ?>
        </td>
      </tr>

  <?php
          endforeach;
        else:
  ?>
          <tr>
            <td>
      <?php echo elgg_echo('izap_forum_:index_no_main_topic'); ?>
        </td>
      </tr>
  <?php
          endif;
  ?>
</table>