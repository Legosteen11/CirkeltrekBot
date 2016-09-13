<?php 
if ($query == "dit") {
    $telegram->answerInlineQuery(array("inline_query_id" => $telegram->QueryID(), 'results' => json_encode($results)));

	$results = array(
		array(
			"type" => "article", 
			"id" => "1", 
			"title" => "Title", 
			"description" => "Description", 
			"input_message_content" => array(
				"message_text" => "<code>Message 1</code>", 
				"parse_mode" => "HTML"
			)
		)
	);
}
