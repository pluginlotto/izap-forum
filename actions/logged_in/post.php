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

IzapBase::gatekeeper();

$posted_data = IzapBase::getPostedAttributes();
$subtopic_post = new IzapForumTopic($posted_data['topic_guid']);

if($subtopic_post){
    $subtopic_post->annotate('forum_post', $posted_data['reply'],$subtopic_post->access_id);
    //updates the updation time of the post
    IzapBase::updateMetadata(array('entity' => $subtopic_post,'metadata' => array('updatation_time' => time())));
    $parent = new IzapForumTopic($subtopic_post->parent->guid);
    //updates the updation time of the parent
    IzapBase::updateMetadata(array('entity' => $parent,'metadata' => array('updatation_time' => time())));
    $latest_comment = $subtopic_post->getAnnotations('forum_post',1,0, 'time_created DESC');
    //bunch all the users involed in the post for email_notification
    if($posted_data['notify_me'][0]=='yes'){
        $email_array = (array)$subtopic_post->emails_to_notify;
        $email_array[] = get_loggedin_user()->email;
        $new_array = array_unique($email_array);
        IzapBase::updateMetadata(array('entity' => $subtopic_post,'metadata' => array('emails_to_notify' => $new_array)));

        //send emails to all the involved users about the post
        if($subtopic_post->emails_to_notify && sizeof($subtopic_post->emails_to_notify)){
            $email_ids = $subtopic_post->emails_to_notify;

            foreach($email_ids as $email) {
      $send_array['subject'] = 'There is new reply on topic: ' . $izapForumTopics->title;
      $send_array['to'] = $email;
      $send_array['from_username'] = $CONFIG->site->name;
      $send_array['from'] = $CONFIG->site->email;
      $send_array['msg'] = "
          There is new reply on topic: <a href=\"".$izapForumTopics->getUrl()."#forum_post_".$latest_comment->id."\"><b>".$izapForumTopics->title."</b></a>
            by: <a href=\"".get_loggedin_user()->getUrl()."\" >".get_loggedin_user()->name."</a><p>\"" . $CONFIG->post_byizap->attributes['reply'] . "\"</p> Visit : " . $izapForumTopics->getUrl();

      $send_array['msg'] = elgg_view('izap-skin/email_template', array('msg' => $send_array['msg']));
      IzapBase::sendMail($send_array);
    }

        }
    }
}