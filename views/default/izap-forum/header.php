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
$header_array = elgg_extract('header_elements', $vars);

//$header_array='';
?>
<!--<div class="izap_forum_category_wrapper">-->
<div class="list_title">
    <div class="izap_forum_category_title">
        <?php
        if ($header_array[0]['link']) {
            echo elgg_view('output/url', array(
                'text' => $header_array[0]['title'],
                'href' => $header_array[0]['link'],
            ));
        } else {
            echo $header_array[0]['title'];
        }
        ?>
        <span>
            (<?php echo elgg_echo('sorted_by_recent_post'); ?>)
        </span>
    </div>

<?php for ($i = 1; $i < 4; $i++): ?>
        <div class="stats">
<?php
            if ($header_array[$i]['link']) {
                echo elgg_view('output/url', array(
                    'text' => $header_array[$i]['title'],
                    'href' => $header_array[$i]['link'],
                ));
            } else {
                echo $header_array[$i]['title'];
            }
?>
        </div>
<?php endfor; ?>

    <div class="clearfloat"></div>
</div>
