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


$category = $vars['entity'];?>
<div>
<div class="categories_list">
<?php echo $category->title;
echo '('.(int)$category->total_topics.')';
if(!$category->total_topics || ((int) $category->total_topics < 0)){
    echo IzapBase::deleteLink(array(
        'guid' => $category->guid
    ));
    }?>
    <a href="<?php echo IzapBase::setHref(array(
    'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
    'action' => 'add_topic',
        'vars' => array('category'=>$category->guid)
        ))?>">
    <?php echo elgg_echo('izap-forum:add_topic')?>
</a>
    <a href="<?php echo IzapBase::setHref(array(
        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
        'action' => 'add_category',
        'vars' => array($category->guid)
        ))?>">
    <?php echo elgg_echo('izap-forum:edit_category')?>
    </a>
</div>

    <div class="clearfloat"></div>
</div>