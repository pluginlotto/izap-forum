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

//  echo (int)$izap_topic->category_guid;
//  echo $izap_topic->parent_guid;
//  exit;
//  
  if ($izap_topic->parent_guid == $izap_topic->category_guid || ((int)$izap_topic->parent_guid == 0 && (int) $izap_topic->category_guid > 0)) {
    $izap_topic->forum_main_topics = 'yes';
    $izap_topic->updation_time = time();
    if (!$izap_topic->parent_guid) {
      $izap_topic->parent_guid = $izap_topic->category_guid;
    }
    if (!$posted_array['guid']) {
      izap_update_total_topics_byizap(get_entity($izap_topic->category_guid));
    }
  }

  if ($izap_topic->parent_guid > 0 && $izap_topic->parent_guid != $izap_topic->category_guid) {
//    echo 'child';
//    exit;
    $parent = new IzapForumTopic($izap_topic->parent_guid);
    IzapBase::updateMetadata(array('entity' => $parent, 'metadata' => array('updation_time' => time())));
    //  $izap_topic->category_guid = $parent->category_guid;
    $izap_topic->forum_main_topics = 'no';
    $izap_topic->updation_time = time();
    if (!$posted_array['guid']) {
      $izap_topic->annotate('forum_post', $izap_topic->description, $izap_topic->access_id);
      izap_update_total_topics_byizap($parent);
    }
  }

  elgg_clear_sticky_form(GLOBAL_IZAP_FORUM_PLUGIN);
  system_message(elgg_echo('izap-forum:add_topic:topic_successfull'));
  if ($izap_topic->forum_main_topics == 'yes') {
    forward(IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'list_sub_topics',
                'vars' => array($izap_topic->guid, $izap_topic->title)
                    )
            )
    );
  } else {
    forward(IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'discussion',
                'vars' => array($izap_topic->guid, $izap_topic->title)
                    )
            )
    );
  }
}

