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

$entities = $vars['entities'];
?>
<div class="izap_froum_category_wrapper">
  <div class="list_title" >
    <div class="izap_forum_category_title">
        <?php
          echo forum_echo('topics');
        ?>
    </div>

    <div class="stats">
        <?php
        if($vars['category'] && !$vars['topic']) {
          echo forum_echo('topics');
        }else{
          echo forum_echo('replies');
        }
        ?>
    </div>

    <div class="stats">
        <?php
        if($vars['category'] && !$vars['topic']) {
          echo forum_echo('posts');
        }else{
          echo forum_echo('views');
        }
        ?>
    </div>

    <div class="stats">
        <?php echo forum_echo('last_post')?>
    </div>
    <div class="clearfloat"></div>
  </div>
    <?php
    echo $vars['entities'];
    ?>
</div>