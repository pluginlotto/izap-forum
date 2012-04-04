<?php
/**
 * Delete forum reply
 *
 * @package Forum
 */

$forum_id = get_input('id');
$forum = elgg_get_annotation_from_id($forum_id);


	if ($forum->delete()) {
		system_message(elgg_echo('izap-forum:delete:reply'));
	} else {
		register_error(elgg_echo('izap-forum:cannot:delete'));
	}


forward(REFERER);