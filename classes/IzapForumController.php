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

class IzapForumController extends IzapController {

    public function __construct($page) {
        parent::__construct($page);
        $this->page_elements['buttons'] = '';
        $this->page_elements['filter'] = '';
        IzapBase::loadLib(array(
                    'plugin' => GLOBAL_IZAP_FORUM_PLUGIN,
                    'lib' => 'izap-forum'
                ));
        izap_create_submenus();
    }

    public function actionIndex() {
        $categories = izap_get_forum_categories(FALSE);
        $this->page_elements['title'] = elgg_echo('izap-forum:controller:index');
        $this->render(GLOBAL_IZAP_FORUM_PLUGIN . '/index', array('categories' => $categories));
    }

    public function actionAdd_category() {
        $query = $this->url_vars;
        $entity = get_entity($query[2]);
        $this->page_elements['title'] = elgg_echo('izap-forum:add_category');
        $this->render('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/add_category', array('entity' => $entity));
    }

    public function actionList_category() {
        $this->page_elements['title'] = elgg_echo('izap-forum:list_category');
        $this->page_elements['content'] = elgg_list_entities(array(
                    'type' => 'object',
                    'subtype' => GLOBAL_IZAP_FORUM_CATEGORY_SUBTYPE,
                ));
        $this->drawPage();
    }

    public function actionAdd_topic() {
        $category = get_entity($this->url_vars[2]);
        $topic = get_entity($this->url_vars[3]);
        $this->page_elements['title'] = elgg_echo('izap-forum:add_topic');
        $this->render('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/add_topic', array('entity' => $topic, 'category' => $category));
    }

    public function actionAdd_sub_topic() {
        $category = get_entity($this->url_vars[2]);
        $topic = get_entity($this->url_vars[3]);
        $sub_topic = get_entity($this->url_vars[4]);
        $this->page_elements['title'] = elgg_echo('izap-forum:add_topic');
        $this->render('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/add_topic', array('entity' => $sub_topic, 'parent' => $topic, 'category' => $category));
    }

    public function actionList() {
        $query = $this->url_vars;

        $this->render(GLOBAL_IZAP_FORUM_PLUGIN . '/list', array('category' => get_entity($query[2])));
    }

    public function actionList_topics() {
        $category = get_entity($this->url_vars[2]);
        $this->page_elements['title'] = $category->title;
        $header_array = array(
            array(
                'title' => $category->title,
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
        $this->page_elements['content'] = elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/header', array('header_elements' => $header_array));
        $this->page_elements['content'] .= elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/list_topics', array('category' => $category));
        $this->page_elements['content'] = '<div class="izap_forum_category_wrapper">' . $this->page_elements['content'] . '</div>';
        $this->drawPage();
    }

    public function actionList_sub_topics() {
        $topic = get_entity($this->url_vars[2]);
        $this->addButton(array(
            'title' => elgg_echo('izap-forum:add_sub_topic'),
            'menu_name' => 'title',
            'url' => IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'add_sub_topic',
                'vars' => array($topic->category_guid, $topic->guid),
            ))
        ));

        $this->page_elements['title'] = $topic->title;
        $header_array = array(
            array(
                'title' => $topic->title,
            ),
            array(
                'title' => elgg_echo('replies')
            ),
            array(
                'title' => elgg_echo('views')
            ),
            array(
                'title' => elgg_echo('last_post')
            ),
        );
        $this->page_elements['content'] = elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/header', array('header_elements' => $header_array));
        $this->page_elements['content'] .= elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/list_topics', array('topic' => $topic));
        $this->page_elements['content'] = '<div class="izap_forum_category_wrapper">' . $this->page_elements['content'] . '</div>';
        $this->drawPage();
    }

    public function actionDiscussion() {
        $subtopic = get_entity($this->url_vars[2]);
        $this->page_elements['title'] = $subtopic->title;
        $this->addButton(array(
            'title' => elgg_echo('izap-forum:delete'),
            'menu_name' => 'title',
            'url' => IzapBase::deleteLink(array('guid' => $this->url_vars[2], 'only_url' => TRUE))
        ));

        $this->page_elements['content'] = elgg_list_annotations(array('guid' => $subtopic->guid,'metastring_name' => 'forum_post'));
        $this->page_elements['content'] .= elgg_view('forms/'.GLOBAL_IZAP_FORUM_PLUGIN.'/post',array('subtopic' => $subtopic));
        $this->drawPage();
    }

}