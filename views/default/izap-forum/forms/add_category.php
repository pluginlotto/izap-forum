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

$loaded_data = $vars['entity'];
?>
<div class="contentWrapper">
  <form action="<?php echo func_get_actions_path_byizap(array('plugin' => 'izap-forum'))?>save_category" method="POST">
    <p>
      <label for="category_title">
        <?php echo forum_echo('categories:title');?>
      </label>
      <?php
        echo elgg_view('input/text', array(
          'internalname' => 'attributes[_title]',
          'value' => $loaded_data->title,
          'internalid' => 'category_title'
        ));
      ?>
    </p>

    <p>
      <label for="category_description">
        <?php echo forum_echo('categories:description');?>
      </label>
      <?php
        echo elgg_view('input/longtext', array(
          'internalname' => 'attributes[description]',
          'value' => $loaded_data->description,
          'internalid' => 'category_description'
        ));
      ?>
    </p>

    <?php
    echo elgg_view('input/hidden', array('internalname' => 'attributes[guid]', 'value' => $loaded_data->guid));
    echo elgg_view('input/securitytoken');
    echo elgg_view('input/submit', array('internalname' => 'attributes[save]', 'value' => forum_echo('save')));
    ?>
  </form>
</div>