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

if(!$CONFIG->post_byizap->form_validated) {
  register_error(forum_echo('error:missing_required_fields'));
  forward($_SERVER['HTTP_REFERER']);
}

//c($CONFIG->post_byizap->attributes);exit;


$izapForumTopics = new IzapForumTopics($CONFIG->post_byizap->attributes['guid'], array('post'=>&$CONFIG->post_byizap));
if($izapForumTopics->save()) {

  // check if sticky_topic
  if(isset($CONFIG->post_byizap->attributes['sticky_topic'][0]) && $CONFIG->post_byizap->attributes['sticky_topic'][0] == 'yes') {
    $izapForumTopics->sticky_topic = 'yes';
  }else {
    $izapForumTopics->sticky_topic = 'no';
  }
  // if category is supplied, the it is most probably the main topic
  if($izapForumTopics->category_guid > 0) {
    $izapForumTopics->forum_main_topics = 'yes';
    $izapForumTopics->updation_time = time();
    // in case there is no parent id, then category is the parent
    if(! (int) $izapForumTopics->parent_guid) {
      $izapForumTopics->parent_guid = $izapForumTopics->category_guid;
    }
    if(!$CONFIG->post_byizap->attributes['guid']) {
      func_update_total_topics_byizap(get_entity($izapForumTopics->category_guid));
    }
  }

  if($izapForumTopics->parent_guid > 0 && $izapForumTopics->parent_guid != $izapForumTopics->category_guid) {
    $parent = new IzapForumTopics($izapForumTopics->parent_guid);
    func_izap_update_metadata(array('entity' => $parent, 'metadata' => array('updation_time' => time()))); // set the updation time for sorting
    $izapForumTopics->category_guid = $parent->category_guid;
    $izapForumTopics->updation_time = time();
    $izapForumTopics->forum_main_topics = 'no';
    if(!$CONFIG->post_byizap->attributes['guid']) {
      $izapForumTopics->annotate('forum_post', $izapForumTopics->description, $izapForumTopics->access_id);
      func_update_total_topics_byizap($parent);
    }
  }

  system_message(forum_echo('message:topic_saved'));
}

unset($_SESSION['postArray']);
forward($izapForumTopics->getUrl());
exit;