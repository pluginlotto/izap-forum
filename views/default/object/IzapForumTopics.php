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
?>
<div class="izap_forum_topic">
  <div class="title">
    <a href="<?php echo $topic->getUrl(); ?>">
      <b><?php echo $topic->title; ?></b>
    </a>
    <br />
    <?php echo $topic->description; ?>
    <!--
    <?php echo elggb_echo('by'); $owner = get_user($topic->owner_guid);?>: <a href="<?php echo $owner->getURL();?>"><?php echo $owner->name ?></a>
    -->
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

      echo '<p>'.friendly_time($topic->last_post_at).'</p>';
    }
    ?>
  </div>

  <div class="clearfloat"></div>
</div>
<?php
}