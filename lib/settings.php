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


global $CONFIG;

return array(
        'path'=>array(
                'www'=>array(
                        'page' => $CONFIG->wwwroot . 'pg/forum/',
                        'images' => $CONFIG->wwwroot . 'mod/izap-forum/_graphics/',
                        'action' => $CONFIG->wwwroot . 'action/izap-forum/',
                ),
                'dir'=>array(
                        'plugin' => dirname(dirname(__FILE__))."/",
                        'actions' => $CONFIG->pluginspath."izap-forum/actions/",
                        'class' => dirname(__FILE__)."/classes/",
                        'functions' => dirname(__FILE__)."/functions/",
                        'lib' => dirname(__FILE__) . '/',
                        'views'=>array(
                                'home'=>"izap-forum/",
                                'forms'=>"izap-forum/forms/",
                                'forum'=>"izap-forum/views/",
                                'river'=>"river/izap-forum/",
                        ),
                        'pages' => dirname(dirname(__FILE__)).'/pages/',
                ),
        ),

        'plugin'=>array(
                'name'=>"izap-forum",

                'title'=>"Forum",

                'url_title'=>"forum",

                'objects'=>array(
                        'IzapForumTopics'=>array(
                                'class'=>"IzapForumTopics",
                                'type' => 'object',
                        ),
                ),

                'actions'=>array(
                        'izap-forum/save'=>array('file' => "save.php",'public' => FALSE),
                        'izap-forum/post'=>array('file' => "post.php",'public' => FALSE),
                        'izap-forum/save_category'=>array('file' => "save_category.php",'admin_only' => TRUE),
                ),

                'action_to_plugin_name' => array(
                  'izap-forum' => 'izap-forum',
                ),

                'page_handler'=>array('forum' => ''),

                'menu'=>array(
                        'pg/forum/'=>array('title'=>"izap-forum:forum",'public'=>TRUE),
                ),

                'submenu'=>array(
                        'forum' => array(
                                'pg/forum/'=>array('title'=>"izap-forum:index",'public'=>TRUE),
                        ),

                        'admin' => array(
                                'pg/forum/add_category/' => array('title' => 'izap-forum:categories:add', 'admin_only' => TRUE),
                                'pg/forum/categories_list/' => array('title' => 'izap-forum:categories:list', 'admin_only' => TRUE),
                                'pg/forum/add_topic/' => array('title' => 'izap-forum:topic:add', 'public' => FALSE),
                        ),
                ),

                'events' => array(

                        'create' => array(
                                'annotation' => array(
                                        'func_izap_forum_post_hook'
                                ),
                        ),

                        'delete' => array(
                                'annotation' => array(
                                        'func_izap_forum_post_delete_hook'
                                ),
                        ),
                  
                ),

                'custom' => array(
                ),
        ),

        'includes'=>array(
                dirname(__FILE__) . '/classes' => array('class.IzapForumTopics.php'),
                dirname(__FILE__) . '/functions' => array('func.core.php'),
        ),
);