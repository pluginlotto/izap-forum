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

?>

@font-face {
  font-family: 'Honey';
  font-style: normal;
  font-weight: normal;
  src: local('Honey'), url('<?php echo elgg_get_site_url() . 'mod/' , GLOBAL_IZAP_FORUM_PLUGIN . '/_graphics/Michroma.woff'?>') format('woff');
}
.categories_list{
font-weight:bolder;
}

.categories_list a{
padding:10px;
float:right;
}

/* BEGIN: Css for izap-forum */

.izap_forum_category_wrapper {
border: solid 2px #109DE4;
margin: 10px;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
}

.izap_forum_category_wrapper .list_title {
background-color: #109DE4;
color: #FFFFFF;
padding: 5px;
font-size: 14px;
}

.izap_forum_category_wrapper .stats {
width: 15%;
float: left;
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
padding: 1px;
margin: 1px;
background-color: #FFFFFF;
line-height:12px;
}

.izap_forum_topic:hover{
background-color:#F5F5F5;
}

.izap_forum_topic .title{
width: 53%;
float: left;
}

.izap_forum_topic .stats{
width: 10%;
float: left;
}

.category_caption {
margin-bottom:10px;
padding-top:30px;
font-weight:normal;
font-family:Times new roman;
font-size:20px;
}

.category_caption a {
float:right;
}

.category_table th {
background-color:#4690D6;
margin:1px;
padding:5px;
text-align:center;
font-weight: bold;
color: #FFFFFF;
}


.form_layout {
border:1px solid #B1B1B1;
padding:10px;
-moz-border-radius: 10px;
background-color:#EEEEEE;

}

.category_table tr.decorate {
border: dotted 1px #DEDEDE;
background-color:#FFFFFF;
}
.category_table tr.decorate:hover {
background: #F5F5F5;
}

.category_table {
border-top: 1px solid #ccc;
width:98%;
}

.izap-forum-icon{
float:left;
margin-right: 10px;
min-width: 40px;
min-height: 40px;
background-color: #ffffff;
}

.izap-forum-desc {
font-size:9px;
}

.stats {
float: left;
width: 13%;
text-align: right;
}

.selected {
font-weight: bold;.
color: #FFF;
background-color: #000;
padding-left: 10px;
}

.selected a{
color: #FFF;
}

.annotation_sidebar {
width: 150px;
float:left;


}

.annotation_icon {
width:138px;
height:160px;
border:1px solid #B9B9B9;
padding: 2px;
-moz-border-radius: 4px;
background-color: #DEDEDE;
}

.annotation_icon .username a{
color: #790417;
font-weight: bold;
decoration: none;
}

.annotation_icon .username a:hover{
color: #000000;
decoration: none;
}

.discussions {
margin:15px;
padding-top:30px;
}

.annotation_content {
float:left;
width:430px;
}

.discussion_title {
font-family: 'Honey', serif;
font-size:20px;
padding-left:10px;
}

.discussions_list {
padding:5px;
}

.annotation_wrapper {
margin:5px;
padding:2px;
}

.discussion_info {
margin-top:30px;
width:100%;
background:url(<?php echo elgg_get_site_url().'/mod/'.GLOBAL_IZAP_FORUM_PLUGIN.'/_graphics/info_back.png'?>);
}

.info_caption {
margin-bottom:10px;
padding:17px 0px 7px 0px;
font-family: 'Honey', serif;
font-weight:normal;
font-size:20px;
border-bottom: #DEDEDE 1px dotted;
}

.discussion_info tr {

height:30px;
font-family: 'Honey', serif;
font-size:12px;
}



