<?php
/* * ************************************************
 * iZAP Web Solutions                              *
 * Copyrights (c) 2005-2009. iZAP Web Solutions.   *
 * All rights reserved                             *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Kumar<tarun@izap.in>"
 */
$topic = $vars['entity'];
if (elgg_instanceof($topic, 'object', 'IzapForumTopic', 'IzapForumTopic')) {
  $sticky_class = ($topic->sticky == 'yes') ? 'style="background-color: #E0E0E0;"' : '';
?>
  <div class="izap_forum_topic" <?php echo $sticky_class ?>>
    <a href="<?php echo $topic->getURL(); ?>">
      <div class="izap-forum-icon">
      <?php echo elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/icon', array('entity' => $topic, 'size' => 'small')); ?>
    </div>
  </a>
  <div class="title">

    <a href="<?php echo $topic->getURL(); ?>">
      <b><?php echo ucfirst($topic->title); ?></b>
    </a>
    <div class="izap-forum-desc">
      <?php $max_len = 200;
      echo substr(filter_var($topic->description, FILTER_SANITIZE_STRING), 0, $max_len) . ((strlen($topic->description) > $max_len) ? ' ...' : ''); ?>
    </div>
  </div>

  <div class="stats">
    <?php
      if ($topic->isMainTopic()) {
        echo (int) $topic->total_topics;
      } else {
        echo (int) $topic->total_posts;
      }
    ?>
    </div>

    <div class="stats">
    <?php
      if ($topic->isMainTopic()) {
        echo (int) $topic->total_posts;
      } else {
        echo (int) IzapBase::getViews($topic);
        //func_get_views_byizap($topic);
      }
    ?>
    </div>

    <div class="stats" style="width: 18%">
    <?php
      $user = get_user($topic->last_post_by);
      if ($user) {
        echo '<a href="' . $user->getURL() . '" title="' . $user->name . '">';
        echo '</a>';

        echo '<p><a href="' . $user->getURL() . '">' . $user->name . '</a>';
        echo '<br />' . friendly_time($topic->last_post_at) . '</p>';
      }
    ?>
    </div>

    <div class="clearfloat"></div>
  </div>
<?php
    }