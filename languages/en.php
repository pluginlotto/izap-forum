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


$english = array(
  'item:object:IzapForumCategories' => 'Forum Categories',
  'item:object:IzapForumTopics' => 'Forum Topics',
  'izap-forum:save' => 'Save',
  'izap-forum:edit' => 'Edit',
  'izap-forum:index' => 'Forum index',
  'izap-forum:forum' => 'Forum',
  'izap-forum:reply' => 'Reply',
  'izap-forum:topics' => 'Topics',
  'izap-forum:posts' => 'Posts',
  'izap-forum:last_post' => 'Last post',
  'izap-forum:replies' => 'Replies',
  'izap-forum:views' => 'Views',


  // categories
  'izap-forum:categories:add' => 'Add forum Categories',
  'izap-forum:categories:title' => 'Title',
  'izap-forum:categories:description' => 'Description',
  'izap-forum:categories:add_category' => 'Add category',
  'izap-forum:categories:category_list' => 'Categories',
  'izap-forum:categories:list' => 'Forum categories',
  'izap-forum:total_toipcs' => 'Total topics',
  'izap-forum:' => '',
  'izap-forum:' => '',

  // topic
  'izap-forum:topic:add' => 'Add forum topic',
  'izap-forum:topic:title' => 'Title',
  'izap-forum:topic:description' => 'Description',
  'izap-forum:topic:category' => 'Category',
  'izap-forum:topic:tags' => 'Tags',
  'izap-forum:topic:access' => 'Access',
  'izap-forum:topic:' => '',

  // errors and messages
  'izap-forum:error:title_blank' => 'Title can\'t be left blank',
  'izap-forum:error:category_not_saved' => 'Error in saving the category.',
  'izap-forum:message:category_saved' => 'Category saved successfully',
  'izap-forum:error:missing_required_fields' => 'Missing required fields',
  'izap-forum:message:topic_saved' => 'Topic saved successfully',
  'izap-forum:message:post' => 'Reply posted successfully',
  'izap-forum:error:post' => 'Error while posting reply.',
  'izap-forum:' => '',
  'izap-forum:' => '',
  'izap-forum:' => '',
  'izap-forum:' => '',
  'izap-forum:' => '',
  'izap-forum:' => '',
  'izap-forum:' => '',

  // notify
  'izap-forum:notify:replied' => 'You have a new reply on your topic',
  'izap-forum:notify:post_message' => 'You have new reply, Please check here: %s',
  'izap-forum:' => '',
  'izap-forum:' => '',
  'izap-forum:' => '',
  'izap-forum:' => '',

  // river
  'izap-forum:post_river' => ' has replied on topic: '
);

add_translation('en', $english);
function forum_echo($key) {
  return elgg_echo('izap-forum:' . $key);
}