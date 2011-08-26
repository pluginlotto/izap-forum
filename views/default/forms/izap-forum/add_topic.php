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

$main_topic = IzapBase::getFormValues(array('entity' => $vars['entity'], 'plugin' => GLOBAL_IZAP_FORUM_PLUGIN));
$parent = $vars['parent'];
//if (elgg_instanceof($vars['category'], 'object', 'IzapForumCategories')) {
//    $category = $vars['category'];
//}

$body = '<div class ="form_layout">';
$body .= IzapBase::input('text', array(
            'input_title' => elgg_echo('izap-forum:add_topic:title'),
            'name' => 'attributes[_title]',
            'value' => $main_topic->title
        ));

$body .= elgg_view('input/checkboxes', array(
            'name' => 'attributes[sticky]',
            'options' => array(
                elgg_echo('izap-forum:add_topic:sticky_topic') => 'yes',
            )
        )) . '<br />';



$body .= IzapBase::input('longtext', array(
            'input_title' => elgg_echo('izap-forum:add_topic:description'),
            'name' => 'attributes[description]',
            'value' => $main_topic->description
        ));

$body .= IzapBase::input('text', array(
            'input_title' => elgg_echo('izap-forum:add_topic:tag'),
            'name' => 'attributes[tags]',
            'value' => implode(',',$main_topic->tags)
        ));

$body .= IzapBase::input('access', array(
            'input_title' => elgg_echo('izap-forum:add_topic:access'),
            'name' => 'attributes[_access_id]',
            'value' => (isset($main_topic->access_id)) ? $main_topic->access_id : ACCESS_PUBLIC
        ));

$body .= elgg_view('input/hidden', array(
            'name' => 'attributes[plugin]',
            'value' => GLOBAL_IZAP_FORUM_PLUGIN
        ));

$body .= '</div>';
if (isset($parent)) {
    $body .= elgg_view('input/hidden', array(
                'name' => 'attributes[parent_guid]',
                'value' => $parent->guid
            ));
}

$body .= IzapBase::input('submit');
$body .= elgg_view('input/hidden', array(
            'name' => 'attributes[guid]',
            'value' => $main_topic->guid
        ));

echo elgg_view('input/form', array(
    'body' => $body,
    'action' => IzapBase::getFormAction('add_edit', GLOBAL_IZAP_FORUM_PLUGIN),
    'enctype' =>'multipart/form-data'
));


