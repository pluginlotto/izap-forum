<?php
/* * ************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2010. iZAP                  *
 * All rights reserved                             *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */
$parent = elgg_Extract('topic', $vars);
?>
<table class="category_table"><?php if ($parent) {

    }
    else
      echo elgg_echo('izap_forum:index_all_topics');
    ?>

 
  <tr class ="header_background">
    <th>
      <?php
      $header_array = array(
          array(
              'title' => elgg_echo('izap_forum:index_title')
          ),
          array(
              'title' => elgg_echo('izap_forum:index_posts')
          ),
          array(
              'title' => elgg_echo('izap_forum:index_views')
          ),
          array(
              'title' => elgg_echo('izap_forum:index_last_post')
          ),
      );
      echo elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/header', array('header_elements' => $header_array));
      ?>
    </th>
  </tr>
  <tr>
    <td>
      <?php
      echo $vars['subtopics'];
      ?>
    </td>
  </tr>
</table>
