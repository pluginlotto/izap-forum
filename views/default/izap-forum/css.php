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

/* BEGIN: Css for izap-forum */

.izap_froum_category_wrapper {
border: solid 2px #109DE4;
margin: 10px;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
}

.blue_back {
background-color: #E2ECF3;
}

.izap_froum_category_wrapper .list_title {
background-color: #109DE4;
color: #FFFFFF;
padding: 5px;
font-size: 14px;
}

.list_title a{
color: #FFFFFF;
}

.izap_forum_category_title {
width: 60%;
float: left;
font-weight: bold;
}

.izap_forum_category_title a {
color: #FFFFFF;
}

.izap_forum_topic {
padding: 5px;
margin: 1px;
border: dotted 1px #DEDEDE;
background-color: #E2ECF3;
}

.izap_forum_topic:hover{
background-color: #F8F9D7;
}

.izap_forum_topic .title{
width: 60%;
float: left;
}

.izap_forum_topic .stats{
width: 10%;
float: left;
}

.izap_froum_category_wrapper .stats {
width: 10%;
float: left;
}


.river_object_IzapForumTopics_posted{
background: url("<?php echo func_get_www_path_byizap(array('plugin' => 'izap-forum', 'type' => 'images')); ?>river_post.png") no-repeat scroll left -1px transparent;
}

/* END: Css for izap-forum */
