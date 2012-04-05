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

class IzapForumCategories extends IzapObject {

  public function __construct($guid = null) {
    parent::__construct($guid);
  }

  /*
   * add attributes 
   */

  public function initializeAttributes() {
    parent::initializeAttributes();
  }

  /*
   * get attributes
   */

  public function getAttributesArray() {
    return array(
        'title' => array(),
        'description' => array(),
        'access_id' => array(),
    );
  }

  /*
   * get url
   */

  public function getURL() {
    $url = IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'index',
                'page_owner' => FALSE,
                'vars' => array($this->guid, elgg_get_friendly_title($this->title)),
                'trailing_slash' => FALSE
            ));

    return $url;
  }

}

