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

$options = array(
        'type' => 'object',
        'subtype' => 'IzapForumTopic',
);
// if category is provided
if($vars['category']) {
  $options['metadata_name_value_pairs'][] = array('name' => 'category_guid', 'value' => $vars['category']->guid);
}

// if topic is also provied (parent)
if($vars['topic']) {
  $options['metadata_name_value_pairs'][] = array('name' => 'parent_guid', 'value' => $vars['topic']->guid);
}else {
  $options['metadata_name_value_pairs'][] = array('name' => 'parent_guid', 'value' => $vars['category']->guid);
}
$options['metadata_name_value_pairs'][] = array('name' => 'sticky', 'value' => 'no');
$options['count'] = TRUE;
$options['limit'] = $vars['limit'];
//$options['order_by_metadata'] = array(
//        array('name' => 'updation_time', 'direction' => 'DESC')
//);
$count = elgg_get_entities_from_metadata($options);

if($count) {
  unset($options['count']);
  $entities = elgg_get_entities_from_metadata($options);
  $list = elgg_view_entity_list($entities, $count, 0, ($vars['limit']) ? $vars['limit'] : 10, FALSE, FALSE, (isset($vars['paging'])) ? $vars['paging'] : TRUE);
}

// get sticky topics now
unset($options);
$options = array(
        'type' => 'object',
        'subtype' => 'IzapForumTopic',
);
// if category is provided
if($vars['category']) {
  $options['metadata_name_value_pairs'][] = array('name' => 'category_guid', 'value' => $vars['category']->guid);
}

// if topic is also provied (parent)
if($vars['topic']) {
  $options['metadata_name_value_pairs'][] = array('name' => 'parent_guid', 'value' => $vars['topic']->guid);
}else {
  $options['metadata_name_value_pairs'][] = array('name' => 'parent_guid', 'value' => $vars['category']->guid);
}
$options['metadata_name_value_pairs'][] = array('name' => 'sticky', 'value' => 'yes');
//$options['order_by_metadata'] = array(
//        array('name' => 'updation_time', 'direction' => 'DESC')
//);

$sticky_entities = elgg_get_entities_from_metadata($options);
$sticky_list = elgg_view_entity_list($sticky_entities, count($sticky_entities), 0, count($sticky_entities), FALSE, FALSE, FALSE);

if($vars['print_header']) {
  ?>
<div class="izap_forum_category_wrapper">
  <div class="list_title" >
    <div class="izap_forum_category_title">
        <?php
        if($vars['category'] && !$vars['topic']) {
          echo elgg_echo('forum');
        }else {
          echo $vars['topic']->title;
        }
        ?>
      <span>
        (<?php echo elgg_echo('sorted_by_recent_post');?>)
      </span>
    </div>

    <div class="stats">
        <?php
        if($vars['category'] && !$vars['topic']) {
          echo elgg_echo('topics');
        }else {
          echo elgg_echo('replies');
        }
        ?>
    </div>

    <div class="stats">
        <?php
        if($vars['category'] && !$vars['topic']) {
          echo elgg_echo('posts');
        }else {
          echo elgg_echo('views');
        }
        ?>
    </div>

    <div class="stats">
        <?php echo elgg_echo('last_post')?>
    </div>
    <div class="clearfloat"></div>
  </div>
    <?php
    echo $sticky_list;
    echo $list;
    ?>
</div>
  <?php
}else {
  echo $sticky_list;
  echo $list;
}