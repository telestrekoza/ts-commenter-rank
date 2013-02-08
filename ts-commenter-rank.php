<?php
/**
 * @package TS_Commenter_Rank
 * @author Nazar Kulyk
 * @version 1.0
 */
/*
Plugin Name: Telestrekoza ranking of the commentators
Plugin URI: https://telestrekoza.com/
Description: Use this to rank commentators based on comment count.
Author: Nazar Kulyk
Version: 1.0
Author URI: http://myeburg.net/
*/

namespace ts\plugins;
class CommenterRank {
public static function ts_user_awards($comment) {
    if($comment->user_id < 1)
	return;
    global $wpdb;
    if (!function_exists('fcc_get_comment_count')) {
	$where = 'WHERE comment_approved = 1 AND user_id = '.$comment->user_id.' ';
	$count = $wpdb->get_results("SELECT COUNT( * ) AS total
		FROM {$wpdb->comments}
		{$where}", object);
	$count = $count[0]->total;
	//echo '<!-- comment '.$comment->user_id.' count : '.$count.' -->';
	//return;
    } else {
	$count = fcc_get_comment_count($comment);
    }
    if ($count < 10 )
	return;
?>
 <div class="awards">
 <?php
 if ($comment->user_id == 1 && date("dm") == "2810") { ?>
    <img align="absbottom" title="Поздравляем с днем рождения" alt="с ДР" src="/static/images/awards/birthday.png" width="15" height="16"/>
 <?php } ?>
 <?php
 if ($count > 2000) { ?>
    <img align="absbottom" title="Доска почёта за две тысячи комментариев" alt="Доска почёта за две тысячи комментариев" src="/static/images/awards/award-2k.png" height="16"/>
    </div>
 <?php return; }
  if ($count > 1000) { ?>
    <img align="absbottom" title="Доска почёта за тысячу комментариев" alt="Доска почёта за тысячу комментариев" src="/static/images/awards/award-1k.png" height="16"/>
    </div>
 <?php return; }
 if ($count > 500) { ?>
    <img align="absbottom" title="Медаль за 500 комментариев" alt="Медаль за 500 комментариев" src="/static/images/awards/award-500.png" height="16"/>
 <?php }
 if ($count >= 200) { ?>
    <img align="absbottom" title="Медаль за 200 комментариев" alt="Медаль за 200 комментариев" src="/static/images/awards/award-200.png" height="16"/>
    </div>
 <?php return; }
 if ($count >= 100) { ?>
    <img align="absbottom" title="Зачётный комментатор,больше 100 комментариев" alt="Зачётный комментатор,больше 100 комментариев" src="/static/images/awards/award-100.png" height="16"/>
 <?php
 }
 if ($count >= 50) { ?>
    <img align="absbottom" title="Почётный комментатор" alt="Почётный комментатор" src="/static/images/awards/award-50.png" height="16"/>
 <?php
 }
 else  {?>
     <img align="absbottom" title="Начинающий комментатор" alt="Начинающий комментатор" src="/static/images/awards/award-start.png" height="16"/>
     <?php }
?> </div> <?php
}
}
?>