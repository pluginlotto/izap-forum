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
$entity = $vars['entity'];
$body = IzapBase::input('text', array(
    'input_title' => elgg_echo('izap-forum:add_category:title'),
    'internalname' => 'attributes[_title]',
    'value' => $entity->title
));

$body .= IzapBase::input('longtext', array(
    'input_title' => elgg_Echo('izap-forum:add_category:description'),
    'internalname' => 'attributes[description]',
    'value' => $entity->description
));
$body .= elgg_view('input/hidden', array(
    'internalname' => 'plugin',
    'value' => GLOBAL_IZAP_FORUM_PLUGIN,
));
$body .= elgg_view('input/hidden', array(
    'internalname' => 'attributes[guid]',
    'value' => $entity->guid));

$body.= IzapBase::input('submit');

echo IzapBase::input('form',array(
    'body' => $body,
    'action' =>  IzapBase::getFormAction('save_category', GLOBAL_IZAP_FORUM_PLUGIN)));


