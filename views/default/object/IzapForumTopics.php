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
if (elgg_instanceof($topic, 'object', GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE, GLOBAL_IZAP_FORUM_TOPIC_CLASS)) {
  $sticky_class = ($topic->sticky_topic == 'yes') ? 'style="background-color: #FFE9E9;"' : '';
?>
  <div class="izap_forum_topic" <?php echo $sticky_class ?>>

      <div class="izap-forum-icon">
      <?php echo elgg_view('profile/icon', array('entity' => $topic->getOwnerEntity(), 'size' => 'small', 'override' => true)); ?>
    </div>
   <div class="title">

    <a href="<?php echo $topic->getURL(); ?>" title ="<?php echo $topic->title ?>">
      <b><?php echo ucfirst($topic->getTitle(array('mini' => true, 'max_length' => 50))); ?></b>
    </a>
    <?php if ($topic->canedit(elgg_get_logged_in_user_guid())) {
    ?>
        <a href ="<?php
        echo IzapBase::setHref(array(
            'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
            'action' => 'add_topic',
            'vars' => array($topic->guid),
            'page_owner' => false
        ));
    ?>">
       <img src="<?php echo $vars['url'] . 'mod/' . GLOBAL_IZAP_FORUM_PLUGIN . '/_graphics/edit.png' ?>" />
     </a>
    <?php
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
    ?>
      <div class="izap-forum-desc">
      <?php
      echo $topic->getDescription(array('mini' => TRUE, 'max_length' => 75));
      ?>
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
      }
    ?>
    </div>

    <div class="stats image" style="width: 17%">
    <?php
      $user = get_user($topic->last_post_by);
      if ($user) {
 ?>
        <a href="<?php echo $user->getURL() ?>" >
          <img src="<?php echo $user->getIconURL('small'); ?>" alt="<?php echo $user->name?>"/>
    </a><br />
    <?php
        echo elgg_view_friendly_time($topic->last_post_at);
      }
    ?>
    </div>

    <div class="clearfloat"></div>
  </div>
<?php
    }