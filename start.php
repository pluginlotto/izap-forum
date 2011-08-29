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

define('GLOBAL_IZAP_FORUM_PLUGIN', 'izap-forum');
define('GLOBAL_IZAP_FORUM_PAGEHANDLER', 'forum');
define('GLOBAL_IZAP_FORUM_CATEGORY_SUBTYPE', 'IzapForumCategories');
define('GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE','IzapForumTopics');
define('GLOBAL_IZAP_FORUM_TOPIC_CLASS','IzapForumTopic');
// This will escape us from fatal error occure when izap-bridge got deactivated after forum plugin activation
 if (elgg_is_active_plugin(GLOBAL_IZAP_ELGG_BRIDGE)) {
    elgg_register_event_handler('init', 'system', 'izap_forum_init');
  } else {
    register_error('This plugin needs izap-elgg-bridge');
    disable_plugin(GLOBAL_IZAP_FORUM_PLUGIN);
  }


function izap_forum_init() {
    global $CONFIG;
  izap_plugin_init(GLOBAL_IZAP_FORUM_PLUGIN);
  elgg_register_page_handler(GLOBAL_IZAP_FORUM_PAGEHANDLER, GLOBAL_IZAP_PAGEHANDLER);

  $menu_item = new ElggMenuItem('forum', elgg_Echo('izap-forum:forum'), IzapBase::setHref(array(
          'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
          'action' => 'index',
          'page_owner' => FALSE
  )));

  elgg_register_menu_item('site', $menu_item);
  elgg_register_event_handler('create', 'annotation', 'izap_forum_post_hook');
  elgg_register_event_handler('delete', 'annotation', 'izap_forum_post_delete_hook');
  }

/**
 * this will run on activation of plugin and push the class name with the subtype
 */
function izap_forum_post_hook($event, $object_type, $object) {
  $entity = get_entity($object->entity_guid);
  if($entity instanceof IzapForumTopic) {
    function tmp_func($entity) {
        IzapBase::updateMetadata(array(
            'entity' => $entity,
            'metadata' => array(
                'total_posts' => (int)$entity->total_posts + 1,
                'last_post_by' => elgg_get_logged_in_user_guid(),
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

function izap_forum_post_delete_hook($event, $object_type, $object) {
  $entity = get_entity($object->entity_guid);
  if($entity instanceof IzapForumTopic) {
    function tmp_func($entity) {
        IzapBase::updateMetadata(array(
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


