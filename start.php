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
define('GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE','IzapForumTopic');

elgg_register_event_handler('init', 'system', 'izap_forum_init');

function izap_forum_init() {
  izap_plugin_init(GLOBAL_IZAP_FORUM_PLUGIN);
  elgg_register_page_handler(GLOBAL_IZAP_FORUM_PAGEHANDLER, GLOBAL_IZAP_PAGEHANDLER);

  $menu_item = new ElggMenuItem('forum', elgg_Echo('izap-forum:forum'), IzapBase::setHref(array(
          'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
          'action' => 'index',
          'page_owner' => FALSE
  )));

  elgg_register_menu_item('site', $menu_item);
}

/**
 * this will run on activation of plugin and push the class name with the subtype
 */
function izap_update_forum_subtype() {
  if(get_subtype_id('object', GLOBAL_IZAP_FORUM_CATEGORY_SUBTYPE)) {
    update_subtype('object', GLOBAL_IZAP_FORUM_CATEGORY_SUBTYPE, GLOBAL_IZAP_FORUM_CATEGORY_SUBTYPE);
  } else {
    add_subtype('object', GLOBAL_IZAP_FORUM_CATEGORY_SUBTYPE, GLOBAL_IZAP_FORUM_CATEGORY_SUBTYPE);
  }

  if(get_subtype_id('object', GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE)) {
    update_subtype('object', GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE, GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE);
  } else {
    add_subtype('object', GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE, GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE);
  }

}

