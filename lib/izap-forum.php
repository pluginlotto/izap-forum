<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */

function izap_create_submenus(){
    $item_add_category=new ElggMenuItem('add_category', elgg_Echo('izap-forum:add_category'), IzapBase::setHref(array(
        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
        'action' => 'add_category'
    )));
    elgg_register_menu_item('page', $item_add_category);

    $item_list_category=new ElggMenuItem('list_category', elgg_Echo('izap-forum:list_category'), IzapBase::setHref(array(
        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
        'action' => 'list_category'
    )));
    elgg_register_menu_item('page', $item_list_category);

    $item_add_topic=new ElggMenuItem('add_topic', elgg_Echo('izap-forum:add_topic'), IzapBase::setHref(array(
        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
        'action' => 'add_topic'
    )));
    elgg_register_menu_item('page', $item_add_topic);

    $item_index=new ElggMenuItem('index', elgg_Echo('izap-forum:index'), IzapBase::setHref(array(
        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
        'action' => 'index'
    )));
    elgg_register_menu_item('page', $item_index);


}

function izap_get_forum_categories($guid_title_array = TRUE, $provided = array()){
    $default = array(
          'type' => 'object',
          'subtype' => 'IzapForumCategories',
  );

  $return = NULL;

  $working_array = array_merge($default, $provided);
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

function izap_update_total_topics_byizap($entity) {
  return IzapBase::updateMetadata(array(
          'entity' => $entity,
          'metadata' => array(
                  'total_topics' => ((int)$entity->total_topics + 1)
          )
          )
  );
}

function izap_if_forum_category_has_topic(ElggObject $category) {
  return (int) $category->total_topics;
}

function izap_decrease_total_topics_byizap($entity) {
  return IzapBase::updateMetadata(array(
          'entity' => $entity,
          'metadata' => array(
                  'total_topics' => ((int)$entity->total_topics - 1)
          )
          )
  );
}