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


global $CONFIG;

if(!$CONFIG->post_byizap->form_validated){
  register_error(forum_echo('error:missing_required_fields'));
  forward($_SERVER['HTTP_REFERER']);
}

$izapForumTopics = new IzapForumTopics($CONFIG->post_byizap->attributes['guid'], array('post'=>&$CONFIG->post_byizap));
if($izapForumTopics->save()) {
  // if category is supplied, the it is most probably the main topic
  if($izapForumTopics->category_guid > 0) {
    $izapForumTopics->forum_main_topics = 'yes';
    $izapForumTopics->parent_guid = $izapForumTopics->category_guid;
    func_update_total_topics_byizap(get_entity($izapForumTopics->category_guid));
  }elseif($izapForumTopics->parent_guid > 0){
    $parent = new IzapForumTopics($izapForumTopics->parent_guid);
    $izapForumTopics->category_guid = $parent->category_guid;
    $izapForumTopics->forum_main_topics = 'no';
    $izapForumTopics->annotate('forum_post', $izapForumTopics->description, $izapForumTopics->access_id);
    func_update_total_topics_byizap($parent);
  }

  system_message(forum_echo('message:topic_saved'));
}

unset($_SESSION['postArray']);
forward($izapForumTopics->getUrl());
exit;