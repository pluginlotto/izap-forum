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
        <div class="title">
          <?php echo elgg_view(GLOBAL_IZAP_FORUM_PLUGIN.'/icon', array('entity' => $topic,'size' => 'small'));?>
            <a href="<?php if($topic->forum_main_topics=='yes'){
                echo IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'list_sub_topics',
                'vars' => array($topic->guid,$topic->title)
            ));}
            else if($topic->forum_main_topics=='no'){
               echo IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'discussion',
                'vars' => array($topic->guid,$topic->title)
            )); 
            }?>">
            <b><?php
            echo ucfirst($topic->title); ?></b>
            </a>    
        <?php if (elgg_is_admin_logged_in ()) {
        ?>

            <a href="<?php
            echo IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'add_topic',
                'vars' => array($topic->parent_guid, $topic->guid)
            )) ?>">
               <?php echo elgg_echo('izap-forum:add_topic:edit') ?>
        </a>
        <?php
               echo IzapBase::deleteLink(array(
                   'guid' => $topic->guid
               ));
           }
        ?>
           <br />
        <?php $max_len = 200;
           echo substr(filter_var($topic->description, FILTER_SANITIZE_STRING), 0, $max_len) . ((strlen($topic->description) > $max_len) ? ' ...' : ''); ?>
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
           }
      else {
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
               echo elgg_view('profile/icon', array('entity' => $user, 'size' => 'tiny', 'override' => TRUE));
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