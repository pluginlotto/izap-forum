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

$categories = func_get_forum_categories(FALSE);
foreach($categories as $category):
  if(func_if_forum_category_has_topic($category)):
    ?>
<div class="izap_froum_category_wrapper">
  <div class="list_title" >
    <div class="izap_forum_category_title">
      <a href="<?php echo $vars['url']?>pg/forums/list/<?php echo $category->guid?>/<?php echo friendly_title($category->title)?>">
            <?php echo $category->title;?>
      </a>
      <span style="color: #000; font-style: italic; font-size: 10px; font-weight: lighter;">
      (<?php echo forum_echo('sorted_by_recent_post');?>)
      </span>
    </div>

    <div class="stats">
          <?php echo forum_echo('topics')?>
    </div>

    <div class="stats">
          <?php echo forum_echo('posts')?>
    </div>

    <div class="stats">
          <?php echo forum_echo('last_post')?>
    </div>
    <div class="clearfloat"></div>
  </div>
      <?php
      echo func_izap_bridge_view('forum/list_topics', array('category' => $category, 'paging' => FALSE, 'limit' => 6));
      ?>
</div>
  <?php
  endif;
endforeach;
