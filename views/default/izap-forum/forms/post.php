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

?>
<br />
<h3><?php echo forum_echo('reply');?></h3>
<form action="<?php echo func_get_actions_path_byizap()?>post" method="post">
  <?php
  echo elgg_view('input/longtext', array('internalname' => 'attributes[reply]'));
  if(!in_array(get_loggedin_user()->email, (array)$vars['topic']->emails_to_notify)) {
    echo elgg_view('input/checkboxes', array('internalname' => 'attributes[notify_me]', 'value' => 'yes', 'options' => array('Notify me the updates of this thread' => 'yes')));
  }
  echo elgg_view('input/hidden', array('internalname' => 'attributes[topic_guid]', 'value' => $vars['topic']->guid));
  echo elgg_view('input/securitytoken');
  echo elgg_view('input/submit', array('value' => forum_echo('reply')));
  ?>
</form>