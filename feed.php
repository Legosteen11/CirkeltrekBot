<?php
// Check http://www.systutorials.com/136102/a-php-function-for-fetching-rss-feed-and-outputing-feed-items-as-html/ for description
// RSS to HTML
/*
    $tiem_cnt: max number of feed items to be displayed
    $max_words: max number of words (not real words, HTML words)
    if <= 0: no limitation, if > 0 display at most $max_words words
 */
 ini_set('display_errors', 'On');
error_reporting(E_ALL);
function get_rss_feed_as_html($feed_url, $max_item_cnt = 1)
{
	$result = null;
    // get feeds and parse items
    $rss = new DOMDocument();
    // load from file or load content
    $rss->load($feed_url);
    $feed = array();
    foreach ($rss->getElementsByTagName('entry') as $node) {
        $item = array (
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('content')->item(0)->nodeValue
			
        );
        array_push($feed, $item);
    }
    for ($x=0;$x<$max_item_cnt;$x++) {
        $title = $feed[$x]['title'];
        $link = $feed[$x]['link'];
        $result .= $title;
        $result .= "<br />";
		
		$regex = '/https?\:\/\/[^\" ]+/i';
		preg_match_all($regex, $link, $matches);
		
        $result .= $matches[0][1];
        $result .= "<br />";
    }
    return $result;
}
function output_rss_feed($feed_url)
{
    echo get_rss_feed_as_html($feed_url);
}

?>