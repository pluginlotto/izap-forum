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
?>
<script type="text/javascript" src="<?php echo func_get_www_path_byizap(array('plugin' => GLOBAL_BRIDGE_PLUGIN, 'type' => 'vendors'));?>jquery-ui/js/jquery-ui-1.7.3.custom-highlight.min.js"></script>
<?php
if(isadminloggedin()) {
  echo '<div style="float: right;"><b>'
  .
  elgg_view('output/confirmlink', array(
    'text' => elggb_echo('delete'),
    'href' => func_izap_bridge_default_delete_action($vars['topic']->guid),
  ))
  .'</b></div><div class="clearfloat"></div>';
}
echo list_annotations($vars['topic']->guid, 'forum_post');
if(isloggedin()) {
  echo func_izap_bridge_view('forms/post', array('topic' => $vars['topic']));
}
?>