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

class IzapForumTopics extends IzapObject {
  function __construct($guid = 0, $params = array()) {
    parent::__construct($guid, $params);
  }

  protected function initialise_attributes() {
    parent::initialise_attributes();
  }

  public function get_attributes_array() {
    return array(
      'title' => array('required' => TRUE, 'type' => 'string'),
      'description' => array('required' => TRUE, 'type' => 'text'),
      'access_id' => array('required' => TRUE, 'type' => 'numerical', 'default' => ACCESS_DEFAULT),
      'tags' => array('required' => FALSE, 'type' => 'string'),
      'parent_guid' => array('required' => TRUE, 'type' => 'numerical', 'default' => 0),
      'category_guid' => array('required' => TRUE, 'type' => 'numerical', 'default' => 0),
      'forum_main_topics' => array('required' => TRUE, 'type' => 'string', 'default' => 'no'),
    );
  }

  public function getForumParams() {
   $forum_params = array_keys($this->get_attributes_array());

    $return = new stdClass();
    $return->guid = $this->guid;
    foreach($forum_params as $param) {
      $return->$param = $this->$param;
    }

    return $return;
  }

  public function getFormParams() {
   $forum_params = array_keys($this->get_attributes_array());

    $return = new stdClass();
    $return->guid = $this->guid;
    foreach($forum_params as $param) {
      $return->$param = $this->$param;
    }

    return $return;
  }

  public function getUrl() {
    global $CONFIG;
    $initial_url = $CONFIG->wwwroot . 'pg/forum/';
    if($this->forum_main_topics == 'yes') {
      return $initial_url . 'list/' . $this->category_guid . '/' . $this->guid . '/' . friendly_title($this->title);
    }else{
      return $initial_url . 'topic/' . $this->category_guid . '/' . $this->parent_guid . '/' . $this->guid . '/' . friendly_title($this->title);
    }
  }

  public function isMainTopic() {
    if($this->forum_main_topics == 'yes') {
      return TRUE;
    }

    return FALSE;
  }
}

