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

if($vars['parent'] instanceof IzapForumTopics) {
  $parent = $vars['parent'];
}

$loaded_data = func_load_form_data_byizap($vars['entity']);
?>
<div class="contentWrapper">
  <form action="<?php echo func_get_actions_path_byizap()?>save" method="POST">
    <p>
      <label for="topic_title">
        <?php echo forum_echo('topic:title');?>*
      </label>
      <?php
      echo elgg_view('input/text', array(
      'internalname' => 'attributes[_title]',
      'value' => $loaded_data->title,
      'internalid' => 'topic_title'
      ));
      ?>
    </p>

    <p>
      <label for="topic_description">
        <?php echo forum_echo('topic:description');?>
      </label>
      <?php
      echo elgg_view('input/longtext', array(
      'internalname' => 'attributes[description]',
      'value' => $loaded_data->description,
      'internalid' => 'topic_description'
      ));
      ?>
    </p>

    <?php
    if(!$parent && isadminloggedin()) {
      ?>
    <p>
      <label for="topic_category">
          <?php echo forum_echo('topic:category');?>*
      </label>
        <?php
        echo elgg_view('input/pulldown', array(
        'internalname' => 'attributes[_category_guid]',
        'value' => $loaded_data->category_guid,
        'internalid' => 'topic_category',
        'options_values' => func_get_forum_categories(),
        ));
        ?>
    </p>
      <?php
    }else{
      echo elgg_view('input/hidden', array(
        'internalname' => 'attributes[parent_guid]',
        'value' => $parent->guid ? $parent->guid : $loaded_data->parent_guid,
      ));
    }
    ?>

    <p>
      <label for="topic_tags">
        <?php echo forum_echo('topic:tags');?>
      </label>
      <?php
      echo elgg_view('input/tags', array(
      'internalname' => 'attributes[tags]',
      'value' => $loaded_data->tags,
      'internalid' => 'topic_tags'
      ));
      ?>
    </p>

    <?php
    if(!$parent && isadminloggedin()) {
      ?>
    <p>
      <label for="topic_access_id">
        <?php echo forum_echo('topic:access');?>*
      </label>
      <?php
      echo elgg_view('input/access', array(
      'internalname' => 'attributes[access_id]',
      'value' => $loaded_data->access_id ? $loaded_data->access_id : ACCESS_DEFAULT,
      'internalid' => 'topic_access_id'
      ));
      ?>
    </p>
    <?php
    }
    echo elgg_view('input/hidden', array('internalname' => 'attributes[access_id]', 'value' => $parent->access_id));
    echo elgg_view('input/hidden', array('internalname' => 'attributes[guid]', 'value' => $loaded_data->guid));
    echo elgg_view('input/hidden', array('internalname' => 'attributes[plugin]', 'value' => 'izap-forum'));
    echo elgg_view('input/securitytoken');
    echo elgg_view('input/submit', array('internalname' => 'attributes[save]', 'value' => forum_echo('save')));
    ?>
  </form>
</div>