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

$owner = get_user($vars['item']->subject_guid);
$topic = new IzapForumTopics($vars['item']->object_guid);
$post_time = $vars['posted'];

?>
<div style="margin-left: 10px;">
  <div style="float: left; margin-right: 10px;">
    <?php echo elgg_view('profile/icon', array('entity' => $owner, 'size' => 'tiny'));?>
  </div>
  
  <?php echo forum_echo('post_river');?>
  <a href="<?php echo $topic->getUrl();?>"><?php echo $topic->title;?></a>
</div>