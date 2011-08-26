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

$izapForumTopic = elgg_extract('topic', $vars);
$post = elgg_extract('post', $vars);
$user = get_entity($izapForumTopic->owner_guid);

$message = 'There is new reply on topic: <a href="' . $izapForumTopic->getUrl() . '#forum_post_' . $post->id . '"><b>' . $izapForumTopic->title . '</b></a>
    created by: <a href="' . $user->getUrl() . '" >' . $user->name . '</a><p>"' . $post->value . '"</p> Visit : ' . $izapForumTopic->getUrl();
echo $message;