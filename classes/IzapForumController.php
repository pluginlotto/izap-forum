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
    $this->page_layout = 'izap-forum';
    IzapBase::loadLib(array(
                'plugin' => GLOBAL_IZAP_FORUM_PLUGIN,
                'lib' => 'izap-forum'
            ));
    //izap_create_submenus();
    elgg_push_breadcrumb(elgg_Echo('izap-forum:breadcrumb_index'), IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'index'
            )));
  }

  public function actionIndex() {
    $query = array(
        'type' => 'object',
        'subtype' => GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE,
        'limit' => 20,
        'metadata_name' => 'forum_main_topics',
        'metadata_values' => 'yes',
        'order_by_metadata' => array(
            array('name' => 'sticky_topic', 'direction' => 'DESC'),
            array('name' => 'updation_time', 'direction' => 'DESC')
        ),
        'order_by' => '',
    );

    $topics = elgg_get_entities_from_metadata($query);

    $options = array(
        'type' => 'object',
        'subtype' => GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE,
        'limit' => 25,
        'metadata_name' => 'forum_main_topics',
        'metadata_values' => 'no',
        'order_by_metadata' => array(
            array('name' => 'sticky_topic', 'direction' => 'DESC'),
            array('name' => 'updation_time', 'direction' => 'DESC')
        ),
        'order_by' => '',
    );

    // checking for the parent in the url
    $parent = get_entity($this->url_vars[1]);
    if (elgg_instanceof($parent, 'object', GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE, GLOBAL_IZAP_FORUM_TOPIC_CLASS)) {
      $topic_selected = $parent;
      $options['metadata_name_value_pairs'][] = array('name' => 'parent_guid', 'value' => $topic_selected->guid);
      elgg_push_breadcrumb($topic_selected->title);
    }

    $this->page_elements['title'] = elgg_echo('izap-forum:controller:index');


    $this->addWidget(GLOBAL_IZAP_FORUM_PLUGIN . '/main_topic_list', array('topics' => $topics, 'current_topic' => $topic_selected));
    $subtopics = elgg_list_entities_from_metadata($options);
    $this->page_elements['content'] = elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/index', array('subtopics' => $subtopics ? $subtopics : elgg_echo('izap_forum:index_no_topic_available'), 'topic' => $parent));
    $this->drawPage();
  }

  public function actionList() {
    $parent = get_entity($this->url_vars[1]);
    $options = array(
        'type' => 'object',
        'subtype' => GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE,
        'limit' => 15,
        'metadata_name_value_pairs' => array(
            array('name' => 'forum_main_topics', 'value' => 'no'),
            array('name' => 'parent_guid', 'value' => $this->url_vars[1]),
        ),
        'order_by_metadata' => array(
            array('name' => 'sticky_topic', 'direction' => 'DESC'),
            array('name' => 'updation_time', 'direction' => 'DESC')
        ),
        'order_by' => '',
    );
    $this->page_elements['title'] = $parent->title;
    $category_guid = $parent->category_guid;
    $query = array(
        'type' => 'object',
        'subtype' => GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE,
        'metadata_name_value_pairs' => array(
            array('name' => 'category_guid', 'value' => $category_guid),
            array('name' => 'forum_main_topics', 'value' => 'yes'),
        ),
        'order_by_metadata' => array(
            array('name' => 'sticky_topic', 'direction' => 'DESC'),
            array('name' => 'updation_time', 'direction' => 'DESC')
        ),
        'order_by' => ''
    );
    $topics = elgg_get_entities_from_metadata($query);
    $this->addWidget(GLOBAL_IZAP_FORUM_PLUGIN . '/topic_list', array(
        'topics' => $topics,
        'selected_topic' => $parent
    ));

    $sub_topics = elgg_list_entities_from_metadata($options);
    $this->page_elements['content'] = elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/list_sub_topics', array('subtopics' => $sub_topics ? $sub_topics : elgg_echo('izap_forum:list_no_subtopic_available'), 'parent' => $parent));
    $this->drawPage();
  }

  public function actionAdd_category() {
    elgg_push_breadcrumb(elgg_echo('izap-forum:breadcrumb_add'), IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'add_category'
            )));
    $query = $this->url_vars;
    $entity = get_entity($query[2]);
    $this->page_elements['title'] = elgg_echo('izap-forum:add_category');
    $this->render('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/add_category', array('entity' => $entity));
  }

  public function actionAdd_topic() {
    IzapBase::gatekeeper();
    $this->page_layout = 'content';
    //$category = get_entity($this->url_vars[1]);
    $topic = get_entity($this->url_vars[1]);
//    elgg_push_breadcrumb($category->title, IzapBase::setHref(array(
//                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
//                'action' => 'list_topics',
//                'vars' => array($category->guid)
//            )));
    if ($topic) {
      elgg_push_breadcrumb($topic->title, IzapBase::setHref(array(
                  'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                  'action' => 'index',
                  'vars' => array($topic->guid, $topic->title)
              )));
    }else
      elgg_push_breadcrumb(elgg_echo('izap-forum:breadcrumb_addtopic'));

    $this->page_elements['title'] = elgg_echo('izap-forum:add_topic');
    $this->render('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/add_topic', array('entity' => $topic));
  }

  public function actionList_sub_topics() {
    $topic = get_entity($this->url_vars[2]);

//    $item_add_topic = new ElggMenuItem('add_topic', elgg_Echo('izap-forum:add_sub_topic'), IzapBase::setHref(array(
//                        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
//                        'action' => 'add_topic',
//                        'vars' => array($topic->category_guid, $topic->guid),
//                    )));
//    elgg_register_menu_item('page', $item_add_topic);

    $category = get_entity($topic->category_guid);
    elgg_push_breadcrumb($category->title, IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'list_topics',
                'vars' => array($category->guid)
            )));

    elgg_push_breadcrumb($topic->title, IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'list_sub_topics',
                'vars' => array($topic->guid, $topic->title)
            )));

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
    if (!elgg_instanceof($subtopic, 'object', GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE, GLOBAL_IZAP_FORUM_TOPIC_CLASS)) {
      forward();
    }
    $this->addWidget(GLOBAL_IZAP_FORUM_PLUGIN . '/discussion_info', array('subtopic' => $subtopic));
    $this->page_elements['title'] = $subtopic->title;
    $topic = get_entity($subtopic->parent_guid);
    elgg_push_breadcrumb($topic->title, IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'index',
                'vars' => array($topic->guid, elgg_get_friendly_title($topic->title)),
                'page_owner' => false
            )));
    elgg_push_breadcrumb(elgg_get_friendly_title($subtopic->title));
    
    IzapBase::increaseViews($subtopic);
    $this->page_elements['content'] = '<p align="right">' . IzapBase::deleteLink(array('guid' => $this->url_vars[2], 'rurl' => IzapBase::setHref(array(
                    'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                    'action' => 'list_sub_topics',
                    'vars' => array($subtopic->parent_guid)
                )))) . '</p>';

    $this->render(GLOBAL_IZAP_FORUM_PLUGIN . '/discussions', array(
        'title' => $subtopic->title,
        'discussion_list' => elgg_list_annotations(array('guid' => $subtopic->guid, 'metastring_name' => 'forum_post')),
        'form' => elgg_view('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/post', array('subtopic' => $subtopic)),
    ));
  }

  public function actionList_category() {
    $this->page_elements['title'] = elgg_echo('izap-forum:list_category');
    $this->page_elements['content'] = elgg_list_entities(array(
                'type' => 'object',
                'subtype' => GLOBAL_IZAP_FORUM_CATEGORY_SUBTYPE,
            ));
    $this->drawPage();
  }

  public function actionAdd_sub_topic() {
    IzapBase::gatekeeper();
    $this->page_layout = 'content';
    //$category = get_entity($this->url_vars[1]);
    $topic = get_entity($this->url_vars[1]);
    $sub_topic = get_entity($this->url_vars[2]);



    if ($topic) {

      elgg_push_breadcrumb($topic->title, IzapBase::setHref(array(
                  'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                  'action' => 'index',
                  'vars' => array($topic->guid, $topic->title)
              )));
    }
    elgg_push_breadcrumb(elgg_echo('izap-forum:breadcrumb_addtopic'));

    $this->page_elements['title'] = elgg_echo('izap-forum:add_topic');
    $this->render('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/add_topic', array('entity' => $sub_topic, 'parent' => $topic));
  }

  public function actionIcon() {
    $topic = get_entity($this->url_vars[1]);
    $size = $this->url_vars[2];

    $image_name = 'forumtopics/' . $topic->guid . '/icon' . (($size) ? $size : 'small') . '.jpg';
    $content = IzapBase::getFile(array(
                'source' => $image_name,
                'owner_guid' => $topic->owner_guid,
            ));

    if (empty($content)) {
      $content = file_get_contents(elgg_get_plugins_path() . 'izap-forum/_graphics/no-pic.png');
    }

    $header_array = array();
    $header_array['content_type'] = 'image/jpeg';
    $header_array['file_name'] = $topic->title;
    $header_array['expire_time'] = 60 * 60 * 60;
    IzapBase::izapCacheHeaders($header_array);
    echo $content;
  }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function actionList_topics() {
    $category = get_entity($this->url_vars[2]);
    $item_add_topic = new ElggMenuItem('add_topic', elgg_Echo('izap-forum:add_topic'), IzapBase::setHref(array(
                        'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                        'action' => 'add_topic',
                        'vars' => array($category->guid)
                    )));
    elgg_register_menu_item('page', $item_add_topic);
    elgg_push_breadcrumb($category->title, IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'list_topics',
                'vars' => array($category->guid)
            )));
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

}