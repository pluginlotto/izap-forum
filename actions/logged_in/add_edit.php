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


IzapBase::loadlib(array(
            'plugin' => GLOBAL_IZAP_FORUM_PLUGIN,
            'lib' => 'izap-forum'
        ));

if (IzapBase::hasFormError()) {
  register_error(elgg_echo('izap-forum:add_topic_form_field_missing'));
  forward($_SERVER['HTTP_REFERER']);
}
$posted_array = IzapBase::getPostedAttributes();
$izap_topic = new IzapForumTopic($posted_array['guid']);
$izap_topic->setAttributes();
if ($izap_topic->save()) {
  if (isset($posted_array['sticky'][0]) && $posted_array['sticky'][0] == 'yes') {
  $izap_topic->sticky = 'yes';
  } else {
      $izap_topic->sticky = 'no';
  }

  if($izap_topic->parent_guid){
     $izap_topic->forum_main_topics = 'no';
     $izap_topic->updation_time = time();
     if (!$posted_array['guid']) {
      izap_update_total_topics_byizap(get_entity($izap_topic->parent_guid));
      $izap_topic->annotate('forum_post', $izap_topic->description, $izap_topic->access_id);
     }
  }else{
     $izap_topic->forum_main_topics = 'yes';
     $izap_topic->updation_time = time();
  }

  elgg_clear_sticky_form(GLOBAL_IZAP_FORUM_PLUGIN);

  if (isset($_FILES) && substr_count($_FILES['icon']['type'], 'image/')) {
    IzapBase::saveFile(array(
                'destination' => 'forumtopics/' . $izap_topic->guid . '/icon',
                'content' => file_get_contents($_FILES['icon']['tmp_name']),
                'owner_guid' => $izap_topic->owner_guid,
                'create_thumbs' => TRUE
            ));
  }else if($izap_topic->parent_guid){
    IzapBase::saveFile(array(
                'destination' => 'forumtopics/' . $izap_topic->guid . '/icon',
                'content' => IzapBase::getfile(array('source' => 'forumtopics/' . $izap_topic->parent_guid . '/icon.jpg','owner_id' => get_entity($izap_topic->parent_guid)->owner_guid)),
                'owner_guid' => $izap_topic->owner_guid,
                'create_thumbs' => TRUE
            ));
  
   
  }
  


  system_message(elgg_echo('izap-forum:add_topic:topic_successfull'));
  if ($izap_topic->forum_main_topics == 'yes') {
    forward(IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'index',
                'page_owner' => false,
                'vars' => array($izap_topic->guid, elgg_get_friendly_title($izap_topic->title))
                    )
            )
    );
  } else {
    forward(IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'discussion',
                'vars' => array($izap_topic->guid, elgg_get_friendly_title($izap_topic->title))
                    )
            )
    );
  }
}

