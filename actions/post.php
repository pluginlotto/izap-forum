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

gatekeeper();
$izapForumTopics = new IzapForumTopics($CONFIG->post_byizap->attributes['topic_guid']);
if($izapForumTopics) {
  $izapForumTopics->annotate('forum_post', $CONFIG->post_byizap->attributes['reply'], $izapForumTopics->access_id);
  if(get_loggedin_userid() != $izapForumTopics->owner_guid) {
    notify_user($izapForumTopics->owner_guid, get_loggedin_userid(), forum_echo('notify:replied'), sprintf(forum_echo('notify:post_message'), $izapForumTopics->getUrl()));
  }
  add_to_river(func_get_template_path_byizap(array('plugin' => 'izap-forum', 'type' => 'river')).'reply_posted', 'posted', get_loggedin_userid(), $izapForumTopics->guid);
  system_message(forum_echo('message:post'));
}else {
  register_error(forum_echo('error:post'));
}
forward($_SERVER['HTTP_REFERER']);
exit;
