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

?>

<h3><?php echo elgg_echo('reply');?></h3>
  <?php
  $body =elgg_view('input/longtext', array('internalname' => 'attributes[reply]',));
  if(!in_array(get_loggedin_user()->email, (array)$vars['topic']->emails_to_notify)) {
    $body .= IzapBase::input('checkboxes', array('internalname' => 'attributes[notify_me]', 'value' => 'yes', 'options' => array('Notify me the updates of this thread' => 'yes')));
  }
  $body .=elgg_view('input/hidden', array('internalname' => 'attributes[topic_guid]', 'value' => $vars['subtopic']->guid));
  $body .=elgg_view('input/securitytoken');
  $body .= elgg_view('input/submit', array('value' => elgg_echo('reply')));


    echo IzapBase::input('form',array(
        'body'=>$body,
        'action' => IzapBase::getFormAction('post',GLOBAL_IZAP_FORUM_PLUGIN)));