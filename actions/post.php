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

gatekeeper();
$izapForumTopics = new IzapForumTopics($CONFIG->post_byizap->attributes['topic_guid']);
if($izapForumTopics) {
  $izapForumTopics->annotate('forum_post', $CONFIG->post_byizap->attributes['reply'], $izapForumTopics->access_id);
  func_izap_update_metadata(array('entity' => $izapForumTopics, 'metadata' => array('updation_time' => time()))); // set the updation time for sorting
  $parent = new IzapForumTopics($izapForumTopics->parent_guid);
  func_izap_update_metadata(array('entity' => $parent, 'metadata' => array('updation_time' => time()))); // set the updation time for sorting

  // get currnet anotation's id
  $latest_comment = $izapForumTopics->getAnnotations('forum_post', 1, 0, 'time_created DESC');
  // add email id to the notify array
  if($CONFIG->post_byizap->attributes['notify_me'][0] == 'yes') {
    $email_array = (array) $izapForumTopics->emails_to_notify;
    $email_array[] = get_loggedin_user()->email;
    $new_array = array_unique($email_array);
    func_izap_update_metadata(array('entity' => $izapForumTopics, 'metadata' => array('emails_to_notify' => $new_array)));
    // end notificaions
  }
  if(is_array($izapForumTopics->emails_to_notify) && sizeof($izapForumTopics->emails_to_notify)) {
    $email_ids = $izapForumTopics->emails_to_notify;
    foreach($email_ids as $email) {
      $send_array['subject'] = 'There is new reply on topic: ' . $izapForumTopics->title;
      $send_array['to'] = $email;
      $send_array['from_username'] = $CONFIG->site->name;
      $send_array['from'] = $CONFIG->site->email;
      $send_array['msg'] = "
          There is new reply on topic: <a href=\"".$izapForumTopics->getUrl()."#forum_post_".$latest_comment->id."\"><b>".$izapForumTopics->title."</b></a>
            by: <a href=\"".get_loggedin_user()->getUrl()."\" >".get_loggedin_user()->name."</a><p>\"" . $CONFIG->post_byizap->attributes['reply'] . "\"</p> Visit : " . $izapForumTopics->getUrl();

      $send_array['msg'] = elgg_view('izap-skin/email_template', array('msg' => $send_array['msg']));
      func_send_mail_byizap($send_array);
    }
  }
  add_to_river(func_get_template_path_byizap(array('plugin' => 'izap-forum', 'type' => 'river')).'reply_posted', 'posted', get_loggedin_userid(), $izapForumTopics->guid, '', '', $latest_comment[0]->id);
  system_message(forum_echo('message:post'));
}else {
  register_error(forum_echo('error:post'));
}
forward($_SERVER['HTTP_REFERER']);
exit;
