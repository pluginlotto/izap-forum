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

$category = $vars['entity'];
?>

<div class="contentWrapper">
  <b>
    <?php echo $category->title?>
  </b>
  - <a href="<?php echo $vars['url']?>pg/forums/add_category/<?php echo $category->guid;?>/"><?php echo forum_echo('edit')?></a>
  <?php if(!$category->total_topics) {?>
  |
  <?php
  echo elgg_view('output/confirmlink', array(
    'text' => elggb_echo('delete'),
    'href' => func_izap_bridge_default_delete_action($category->guid),
    )
          );
  ?>
  <?php }else{?>
  (<em><?php echo forum_echo('total_toipcs') . ': <b>' . $category->total_topics . '</b>';?></em>)
  <?php }?>
  <p>
    <?php echo $category->description;?>
  </p>
</div>
