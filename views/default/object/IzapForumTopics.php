<?php
/**************************************************
* iZAP Web Solutions                              *
* Copyrights (c) 2005-2009. iZAP Web Solutions.   *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Kumar<tarun@izap.in>"
 */

$topic = $vars['entity'];
if($topic instanceof IzapForumTopics) {
  $sticky_class = ($topic->sticky_topic == 'yes') ? 'style="background-color: #E0E0E0;"' : '';
  ?>
<div class="izap_forum_topic" <?php echo $sticky_class?>>
  <div class="title">
    <a href="<?php echo $topic->getUrl(); ?>">
      <b><?php echo ucfirst($topic->getTitle()); ?></b>
    </a>
      <?php
      if(isadminloggedin()) {
        echo ' - <a href="'.$vars['url'].'pg/forums/edit_topic/'.$topic->guid.'">'.forum_echo('topic:edit').'</a> - ';
        echo elgg_view('output/confirmlink', array(
        'text' => elggb_echo('delete'),
        'href' => func_izap_bridge_default_delete_action($topic->guid),
        ));
      }
      ?>
    <br />
      <?php $max_len = 200; echo substr(filter_var($topic->description, FILTER_SANITIZE_STRING), 0, $max_len) . ((strlen($topic->getDescription()) > $max_len) ? ' ...' : ''); ?>
  </div>

  <div class="stats">
      <?php
      if($topic->isMainTopic()) {
        echo (int) $topic->total_topics;
      }else {
        echo (int) $topic->total_posts;
      }
      ?>
  </div>

  <div class="stats">
      <?php
      if($topic->isMainTopic()) {
        echo (int) $topic->total_posts;
      }else {
        echo (int) func_get_views_byizap($topic);
      }?>
  </div>

  <div class="stats" style="width: 18%">
      <?php
      $user = get_user($topic->last_post_by);
      if($user) {
        echo '<a href="'.$user->getURL().'" title="'.$user->name.'">';
        echo elgg_view('profile/icon', array('entity' => $user, 'size' => 'tiny', 'override' => TRUE));
        echo '</a>';

        echo '<p><a href="'.$user->getURL().'">' . $user->name . '</a>';
        echo '<br />' . friendly_time($topic->last_post_at).'</p>';
      }
      ?>
  </div>

  <div class="clearfloat"></div>
</div>
  <?php
}