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
$options['count'] = TRUE;
$options['limit'] = $vars['limit'];
$options['order_by_metadata'] = array(
    array('name' => 'sticky','direction' => 'DESC'),
    array('name' => 'updation_time', 'direction' => 'DESC')
    );
$count = elgg_get_entities_from_metadata($options);

if($count) {
  unset($options['count']);
  $entities = elgg_get_entities_from_metadata($options);
  $list = elgg_view_entity_list($entities, $count, 0, ($vars['limit']) ? $vars['limit'] : 10, FALSE, FALSE, (isset($vars['paging'])) ? $vars['paging'] : TRUE);
}

//if($vars['print_header']) {
  ?>
    <?php
    echo $list;
    ?>
  <?php
//}else {
   //echo $list;
//}