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

$topic = $vars['topic'];
$url = $vars['url'] . 'pg/forum/add_topic/' . $topic->guid . '/'
        ?>
<div class="izap_froum_category_wrapper">
  <div class="list_title">
    <div style="float: left;">
      <?php echo $vars['navigation']?>
    </div>
    <?php if($vars['add_action']) {?>
    <div style="float: right;">
      <a href="<?php echo $url;?>" class="link_white" style="color: #FFFFFF;"><?php echo forum_echo('topic:add');?></a>
    </div>
    <?php } ?>
    <div class="clearfloat"></div>
  </div>
</div>