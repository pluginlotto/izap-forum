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

/*
 * izap-forum controller
 */

class IzapForumController extends IzapController {

  public function __construct($page) {
    parent::__construct($page);
    $this->page_elements['filter'] = '';
    $this->page_layout = 'content';
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

  /*
   * default action for forum listing
   */

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
    $subtopics = elgg_list_entities_from_metadata($options);
    $this->page_elements['title'] = $parent->title;

    if (elgg_is_admin_logged_in ()) {
      $this->addButton(array(
          'url' => IzapBase::setHref(array(
              'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
              'action' => 'add_topic'
          )),
          'title' => elgg_echo('izap_forum:add_new_topic'),
          'menu_name' => 'title'
      ));
    }
    if ($parent) {
      $this->addButton(array(
          'title' => elgg_echo('izap_forum:index_add_discussion'),
          'menu_name' => 'title',
          'url' => IzapBase::setHref(array(
              'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
              'action' => 'add_sub_topic',
              'vars' => array($parent->guid)
          ))
      ));
    }
    $this->addWidget(GLOBAL_IZAP_FORUM_PLUGIN . '/main_topic_list_li', array('topics' => $topics, 'current_topic' => $topic_selected));

    $this->page_elements['content'] = elgg_view(GLOBAL_IZAP_FORUM_PLUGIN . '/index', array('subtopics' => $subtopics ? $subtopics : elgg_echo('izap_forum:index_no_topic_available'), 'topic' => $parent));
    $this->drawPage();
  }

  /*
   * add topic action
   */

  public function actionAdd_topic() {
    IzapBase::gatekeeper();
    $this->page_layout = 'content';
    $topic = get_entity($this->url_vars[1]);
    if ($topic) {
      elgg_push_breadcrumb($topic->title, IzapBase::setHref(array(
                  'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                  'action' => 'index',
                  'vars' => array($topic->guid, $topic->title)
              )));
      $this->page_elements['title'] = elgg_echo('izap-forum:edit_topic');
    } else {
      elgg_push_breadcrumb(elgg_echo('izap-forum:breadcrumb_addtopic'));

      $this->page_elements['title'] = elgg_echo('izap-forum:add_topic');
    }
    $this->render('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/add_topic', array('entity' => $topic));
  }

  /*
   * forum discusstion
   */

  public function actionDiscussion() {
    global $CONFIG;
    $subtopic = get_entity($this->url_vars[2]);
    if (!elgg_instanceof($subtopic, 'object', GLOBAL_IZAP_FORUM_TOPIC_SUBTYPE, GLOBAL_IZAP_FORUM_TOPIC_CLASS)) {
      forward();
    }
    IzapBase::increaseViews($subtopic);
    if ($subtopic->canedit(elgg_get_logged_in_user_guid())) {

      $link = '<a href ="' . IzapBase::setHref(array(
                  'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                  'action' => 'add_topic',
                  'vars' => array($subtopic->guid),
                  'page_owner' => false
              )) . '">';
      $link .='<img src="' . $CONFIG->wwwroot . 'mod/' . GLOBAL_IZAP_FORUM_PLUGIN . '/_graphics/edit.png' . '" /></a> ';
      $link_img = '<img src="' . $CONFIG->wwwroot . 'mod/' . GLOBAL_IZAP_FORUM_PLUGIN . '/_graphics/delete.png" />';
      $link .= elgg_view('output/confirmlink', array(
                  'href' => IzapBase::deleteLink(array(
                      'guid' => $subtopic->guid,
                      'rurl' => IzapBase::setHref(array(
                          'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                          'action' => 'index'
                      )),
                      'only_url' => true
                  )),
                  'text' => $link_img
              ));
    }
    $this->addWidget(GLOBAL_IZAP_FORUM_PLUGIN . '/discussion_info', array('subtopic' => $subtopic));
    $this->page_elements['title'] = $subtopic->title;
    $this->page_elements['page_title'] = $subtopic->title;
    $topic = get_entity($subtopic->parent_guid);
    elgg_push_breadcrumb($topic->title, IzapBase::setHref(array(
                'context' => GLOBAL_IZAP_FORUM_PAGEHANDLER,
                'action' => 'index',
                'vars' => array($topic->guid, elgg_get_friendly_title($topic->title)),
                'page_owner' => false
            )));
    elgg_push_breadcrumb(elgg_get_friendly_title($subtopic->title));



    $this->render(GLOBAL_IZAP_FORUM_PLUGIN . '/discussions', array(
        'title' => $subtopic->title,
        'discussion_list' => elgg_list_annotations(array('guid' => $subtopic->guid, 'metastring_name' => 'forum_post')),
        'form' => elgg_view('forms/' . GLOBAL_IZAP_FORUM_PLUGIN . '/post', array('subtopic' => $subtopic)),
    ));
  }

  /*
   * add subtopic to forum
   */

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

  /*
   * get user icon
   */

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
    $header_array['file_name'] = elgg_get_friendly_title($topic->title);
    IzapBase::cacheHeaders($header_array);
    echo $content;
  }

}