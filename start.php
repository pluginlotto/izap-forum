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

define('GLOBAL_IZAP_FORUM_PLUGIN', 'izap-forum');

function izap_forum_init() {
  if(is_plugin_enabled('izap-elgg-bridge')) {
    func_init_plugin_byizap(array('plugin' => array('name' => 'izap-forum')));
  }else{
    register_error('This plugin needs izap-elgg-bridge');
    disable_plugin('izap-forum');
  }
}

register_elgg_event_handler('init', 'system', 'izap_forum_init');