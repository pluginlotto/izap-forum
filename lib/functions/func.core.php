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

//function func_load_form_data_byizap(IzapForum $entity = null, $optional_data = null) {
//  $return =  new stdClass();
//  if(!is_null($optional_data)) {
//
//  }elseif($_SESSION['postArray']['plugin'] == 'izap-forum') {
//    foreach($_SESSION['postArray'] as $key => $val) {
//      $return->$key = $val;
//    }
//  }elseif(!is_null($entity)) {
//    $return = $entity->getForumParams();
//  }
//
//  return $return;
//}

function func_get_forum_categories($guid_title_array = TRUE, $provided = array()) {
  $default = array(
          'type' => 'object',
          'subtype' => 'IzapForumCategories',
  );

  $return = NULL;

  $working_array = func_get_working_array_byizap($default, $provided);
  $categories = elgg_get_entities($working_array);
  if($categories) {
    if($guid_title_array) {
      foreach($categories as $category) {
        $return[$category->guid] = $category->title;
      }
    }else {
      $return  = $categories;
    }
  }

  return $return;
}

function func_if_forum_category_has_topic(ElggObject $category) {
  return (int) $category->total_topics;
}

function func_update_total_topics_byizap($entity) {
  return func_izap_update_metadata(array(
          'entity' => $entity,
          'metadata' => array(
                  'total_topics' => ((int)$entity->total_topics + 1)
          )
          )
  );
}

function func_if_forum_have_subtopics(IzapForumTopics $forum) {
  return (int) $category->total_topics;
}

function func_izap_forum_post_hook($event, $object_type, $object) {
  $entity = get_entity($object->entity_guid);
  if($entity instanceof IzapForumTopics) {
    function tmp_func($entity) {
      func_izap_update_metadata(array(
            'entity' => $entity,
            'metadata' => array(
                'total_posts' => (int)$entity->total_posts + 1,
                'last_post_by' => get_loggedin_userid(),
                'last_post_at' => time(),
              ),
    ));
    }
    // update the post count
    tmp_func($entity);
    
    // if it was sub topic, then update the main topic as well
    if(!$entity->isMainTopic()) {
      $main_entity = get_entity($entity->parent_guid);
      tmp_func($main_entity);
    }
  }
  return TRUE;
}

function func_izap_forum_post_delete_hook($event, $object_type, $object) {
  $entity = get_entity($object->entity_guid);
  if($entity instanceof IzapForumTopics) {
    function tmp_func($entity) {
      func_izap_update_metadata(array(
            'entity' => $entity,
            'metadata' => array(
                'total_posts' => (int)$entity->total_posts - 1,
              ),
    ));
    }
    // update the post count
    tmp_func($entity);

    // if it was sub topic, then update the main topic as well
    if(!$entity->isMainTopic()) {
      $main_entity = get_entity($entity->parent_guid);
      tmp_func($main_entity);
    }
  }
  return TRUE;
}