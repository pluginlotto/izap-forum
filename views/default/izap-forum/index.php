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

$categories = elgg_extract('categories', $vars);

foreach ($categories as $category):
    if (izap_if_forum_category_has_topic($category)):
?>
        <div class="izap_forum_category_wrapper">
            <!--  <div class="list_title">
                <div class="izap_forum_category_title">
                    <a href ="//<?php
        //echo IzapBase::setHref(array(
//           'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
//            'action' => 'list_topics',
//            'vars' => array($category->guid,friendly_title($category->title))
//        ));?>">
    <?php echo $category->title; ?>
    </a>
    <a href="<?php //echo $vars['url']    ?>pg/forums/list/<?php //echo $category->guid    ?>/<?php // echo friendly_title($category->title)    ?>">
    <?php // echo $category->title; ?>
    </a>
    <span>
    (<?php //echo elgg_echo('sorted_by_recent_post');     ?>)
    </span>
    </div>

    <div class="stats">
    <?php //echo elgg_echo('topics') ?>
    </div>

    <div class="stats">
    <?php // echo elgg_echo('posts') ?>
    </div>

    <div class="stats">
    <?php //echo elgg_echo('last_post') ?>
    </div>
    <div class="clearfloat"></div>
    </div>-->
    <?php
        $header_array = array(
            array(
                'title' => $category->title,
                'link' => IzapBase::setHref(
                        array(
                            'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                            'action' => 'list_topics',
                            'vars' => array(
                                $category->guid, friendly_title($category->title)),
                            'trailing_slash' => false
                        )
                )
            ),
            array(
                'title' => elgg_echo('topics')
            ),
            array(
                'title' => elgg_echo('posts')
            ),
            array(
                'title' => elgg_echo('last_post')
            ),
        );
        echo elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/header', array('header_elements' => $header_array));
        echo elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/list_topics', array('category' => $category, 'paging' => FALSE, 'limit' => 6));
    ?>
    </div>
<?php
        endif;
    endforeach;






