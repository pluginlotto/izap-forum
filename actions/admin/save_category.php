<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */

$posted_array=IzapBase::getPostedAttributes();
if(IzapBase::hasFormError()){
    register_error(elgg_echo('izap-forum:add_category:form_error'));
    forward(REFERER);
}

$izap_category = new IzapForumCategories($posted_array['guid']);
$izap_category->setAttributes();
if($izap_category->save()){
    system_message(elgg_echo('izap-forum:add_category:category_saved'));
    elgg_clear_sticky_form(GLOBAL_IZAP_FORUM_PLUGIN);
    forward(IzapBase::setHref(array(
            'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
            'action' => 'list_category'
            )));
}


