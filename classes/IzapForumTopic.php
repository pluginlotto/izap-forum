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

class IzapForumTopic extends IzapObject {

    public function __construct($guid = null) {
        parent::__construct($guid);
    }

    public function initializeAttributes() {
        parent::initializeAttributes();
    }

    public function getAttributesArray() {
        return array(
            'title' => array(),
            'description' => array(),
            'category_guid' => array(),
            'parent_guid' =>array(),
            'tags' => array(),
            'access_id' => array(),
            'sticky' => array()
        );
    }

    public function isMainTopic() {
    if($this->forum_main_topics == 'yes') {
      return TRUE;
    }

    return FALSE;
  }

  public function delete() {
      IzapBase::loadlib(array(
          'plugin' => GLOBAL_IZAP_FORUM_PLUGIN,
          'lib' => 'izap-forum'
      ));
    // decrease total count, from parent
if($this->parent_guid != $this->category_guid){
    $parent = get_entity($this->parent_guid);
    izap_decrease_total_topics_byizap($parent);
}
    // decrease total count, from category
    $category = get_entity($this->category_guid);
    izap_decrease_total_topics_byizap($category);

    // decrease total post count
    IzapBase::updateMetadata(array(
            'entity' => $parent,
            'metadata' => array(
                    'total_posts' => (int)$parent->total_posts - $this->countAnnotations(),
            ),
    ));

parent::delete();
  }

}