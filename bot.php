<?php
include("Telegram.php");
include("functies.php");

$bot_id = file_get_contents('./ignore/token');
$telegram = new Telegram($bot_id);
$text = mb_strtolower($telegram->Text());
$chat_id = $telegram->ChatID();

//stop en start
if ($text == "/cirkeltrekbot" && $telegram->Username() == "Maartenwut") {
	if (file_exists(stop)) {
	  unlink(stop) or $telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Halp ik kan niet schrijven"));
	  $telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Kek aan"));
	} else {
	  $ourFileHandle = fopen(stop, 'w') or $telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Halp ik kan niet schrijven"));
	  fclose($ourFileHandle);
	  $telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Kek uit"));
	}
} else if ($text == "/cirkeltrekbot" && $telegram->Username() != "Maartenwut") {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "haha nee", 'reply_to_message_id' => $telegram->MessageID()));
}

//failsafes
else if (strlen(strstr($text,"http"))>0) {
	die();
} else if (file_exists(stop)) {
	die();
}

//dit
else if ($text == "dit" && $telegram->ReplyID() && rand(0,99) < 50) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Dat", 'reply_to_message_id' => $telegram->ReplyID()));
}
//kek
else if ($text == "kek" && $telegram->ForwardFrom() != "Markov_Bot") {
	if (rand(0,999) < 69) {
		$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Keʞ", 'reply_to_message_id' => $telegram->MessageID()));
	} else {
		$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => $telegram->Text(), 'reply_to_message_id' => $telegram->ReplyID()));
	}
}

//leve de koning!
else if (strlen(strstr($text," koning"))>0 && strlen(strstr($text," de "))>0 && strlen(strstr($text,"leve "))>0 && substr( $text, 0, 1 ) !== "/" ) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Leve de koning!"));
}

//riv of rip
else if ($text == "riv" || $text == "rip") {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADPQEAApILuAAB8IRXD7cI3MMC' ));
}

//levedekoning
else if (strlen(strstr($text,"/levedekoning"))>0) {
	$telegram->sendVoice(array('chat_id' => $chat_id, 'voice' => new CURLFile("./assets/levedekoning.mp3")));
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Leve de koning!"));
}

//willempie
else if (strlen(strstr($text,"/willempie"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADTQEAApILuAAC8GEL27fMWwI' ));
}

//lachen
else if (strlen(strstr($text,"/lachen"))>0) {
	$telegram->sendDocument(array('chat_id' => $chat_id, 'document' => new CURLFile("./assets/lachen.gif")));
}

//kek
else if (strlen(strstr($text,"/kek"))>0 && strlen(strstr($text,"/kekkruis")) == 0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADOQADkzoFAAFw9gW6EJBQIQI' ));
}

//applaus
else if (strlen(strstr($text,"/applaus"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADVQADkzoFAAHl_TiVLZF85AI' ));
}

//netjes
else if (strlen(strstr($text,"/netjes"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADvgIAAsaj4AABihreNcuFbD0C' ));
}

//wat
else if (strlen(strstr($text,"/wat"))>0 && strlen(strstr($text,"/watzeije")) == 0 && strlen(strstr($text,"watch")) == 0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADSQEAApILuAABwnEpiZo6ajsC' ));
}

//patat
else if (strlen(strstr($text,"/patat"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADNQEAApILuAAByfdQ4Dy89_IC' ));
}

//waardeloos
else if (strlen(strstr($text,"/waardeloos"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAAD1AAD2U2JB26yI3XZE6IGAg' ));
}

//perfect
else if (strlen(strstr($text,"/perfect"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADFgADkzoFAAHdW_c7r7CjaAI' ));
}

//jezus
else if (strlen(strstr($text,"/jezus"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAAD2AAD2U2JB4bqtEgPGqC_Ag' ));
}

//toppie
else if (strlen(strstr($text,"/toppie"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADUQADkzoFAAHlKFBIGuS3sAI' ));
}

//spanje
else if (strlen(strstr($text,"/spanje"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADQgEAApILuAAB1EvKLHN4ChoC' ));
}

//willemsliefde
else if (strlen(strstr($text,"/willemsliefde"))>0 || strlen(strstr($text,"/koningsliefde"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'Willem is liefde, Willem is leven.'. PHP_EOL . 'https://www.youtube.com/watch?v=VSv0w8egCYE'));
}

//koningslied
else if (strlen(strstr($text,"/koningslied"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'https://www.youtube.com/watch?v=MEUKyKb4g6k'));
}

//waarisdekoning
else if (strlen(strstr($text, "/waarisdekoning"))>0) {
	$telegram->sendLocation(array('chat_id' => $chat_id, 'latitude' => '52.080810', 'longitude' => '4.306228'));
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Hier is de koning! \xF0\x9F\x98\x9C"));
}

//kopieerpasta
else if (strlen(strstr($text,"/kopieerpasta"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => kopieerpasta()));
}

//aanvalshelikopter
else if (strlen(strstr($text,"/aanvalshelikopter"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('assets/kopieerpasta/aanvalshelikopter.txt')));
}

//meemsterkaas
else if (strlen(strstr($text,"/meemsterkaas"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('assets/kopieerpasta/meemsterkaas.txt')));
}

//cirkeltrek
else if (strlen(strstr($text,"/cirkeltrek"))>0 && substr( $text, 0, 1 ) == "/") {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('assets/kopieerpasta/cirkeltrek.txt')));
}

//goedepoep
else if (strlen(strstr($text,"/goedepoep"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('assets/kopieerpasta/goedepoep.txt')));
}

//watzeije
else if (strlen(strstr($text,"/watzeije"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('assets/kopieerpasta/watzeije.txt')));
}

//stadhouders
else if (strlen(strstr($text,"/stadhouders"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('assets/kopieerpasta/stadhouders.txt')));
}

//broodrooster
else if (strlen(strstr($text,"/broodrooster"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('assets/kopieerpasta/broodrooster.txt')));
}

//oorporno
else if (strlen(strstr($text,"/oorporno"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => oorporno()));
}

//drieswave
else if (strlen(strstr($text,"/drieswave"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADCAEAApILuAABqXgubaJZ4ysC' ));
}

//proost
else if (strlen(strstr($text,"/proost"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BBQADBAADcwADkzoFAAG-8JnnS_BGLgI' ));
}

//opwillem
else if (strlen(strstr($text,"/opwillem"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADLAADkgu4AAG76ewKdZNbggI' ));
}

//noice
else if (strlen(strstr($text,"/noice"))>0) {
	$telegram->sendDocument(array('chat_id' => $chat_id, 'document' => new CURLFile("./assets/noice.gif")));
}

//feest
else if (strlen(strstr($text,"/feest"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADAgADxAIAAi6uVQHaiW805ofWBgI' ));
}

//gaben
else if (strlen(strstr($text,"/gaben"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADmAAD0KSvAAG0nuRpqVg8SwI' ));
}

//spam
else if (strlen(strstr($text,"/spam"))>0) {
	$telegram->sendDocument(array('chat_id' => $chat_id, 'document' => new CURLFile("./assets/spam.gif")));
}

//getrekkert
else if (strlen(strstr($text,"/getrekkert"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADDgEAApILuAABhBr7tec3F3YC' ));
}

//moetdit
else if (strlen(strstr($text,"/moetdit"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADLwADOXRRAzX6um5Sinh6Ag' ));
}

//goedbezig
else if (strlen(strstr($text,"/goedbezig"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAAD0gAD2U2JB1VxulAa-EKkAg' ));
}

//nee
else if (strlen(strstr($text,"/nee"))>0 && strlen(strstr($text,"/neetoch"))==0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADGQEAApILuAABklhjh16AczoC' ));
}

//willem en ja
else if (strlen(strstr($text,"/willem"))>0 || strlen(strstr($text,"/ja"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADUwADkzoFAAGkGccCqSSWSAI' ));
}

//doei
else if (strlen(strstr($text,"/doei"))>0 || strlen(strstr($text,"/dag"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADHQADkzoFAAGOXUKdbVRkMQI' ));
}

//ik_ihe
else if (strlen(strstr($text,"/ik_ihe"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => ik_ihe()));
}

//papgrap
else if (strlen(strstr($text,"/papgrap"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => papgrap(), 'parse_mode' => Markdown));
}

//halt
else if (strlen(strstr($text,"/halt"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADLgADkgu4AAEgqEHum5xBdAI' ));
}

//helemaalmooi
else if (strlen(strstr($text,"/helemaalmooi"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADPQADOXRRA549oF1BJ6kPAg' ));
}

//kut
else if (strlen(strstr($text,"/kut"))>0 && strlen(strstr($text,"/kutzooi")) == 0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADJQEAApILuAABAavWOda4LPoC' ));
}

//kutzooi
else if (strlen(strstr($text,"/kutzooi"))>0 && strlen(strstr($text,"/kut ")) == 0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADJwEAApILuAABJExCmSLmwGYC' ));
}

//randig
else if (strlen(strstr($text,"/randig"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADOwEAApILuAABYFHy0YzQzPMC' ));
}

//nederland
else if (strlen(strstr($text,"/nederland"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADVQEAApILuAABPw-oSCNIf5IC' ));
}

//angelsaksisch
else if (strlen(strstr($text,"/angelsaksisch"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAAD_gADkgu4AAHraLmBKlFeMgI' ));
}

//hoekig
else if (strlen(strstr($text,"/hoekig"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADHQEAApILuAABAmZrgwRArAYC' ));
}

//goedverhaal
else if (strlen(strstr($text,"/goedverhaal"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADFwEAApILuAABSY7zgR5UELQC' ));
}

//zucht
else if (strlen(strstr($text,"/zucht"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADEwADbkngC6ANL5qYiJcwAg' ));
}

//kansloos
else if (strlen(strstr($text,"/kansloos"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADAQEAAtlNiQcKdjaIYPZ0qAI' ));
}

//klapklap
else if (strlen(strstr($text,"/klapklap"))>0) {
	$telegram->sendDocument(array('chat_id' => $chat_id, 'document' => new CURLFile("./assets/klapklap.gif")));
}

//veelspam
else if (strlen(strstr($text,"/veelspam"))>0) {
	$telegram->sendDocument(array('chat_id' => $chat_id, 'document' => new CURLFile("./assets/veelspam.gif")));
}

//zoutig
else if (strlen(strstr($text,"/zoutig"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADUQEAApILuAABxbpwIOKTq9kC' ));
}

//meerjpeg
else if (strlen(strstr($text,"/meerjpeg"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADLQEAApILuAABO6a-kjk5_dwC' ));
}

//feesboek
else if (strlen(strstr($text,"/feesboek"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => feesboek()));
}

//opalberto
else if (strlen(strstr($text,"/opalberto"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADMwEAApILuAABQPRgsdBDizAC' ));
}

//ditlooptuitdehand
else if (strlen(strstr($text,"/ditlooptuitdehand"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADBgEAApILuAABYVOP6YdY00MC' ));
}

//inderdaad
else if (strlen(strstr($text,"/inderdaad"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADIQEAApILuAABK2_6adbECfkC' ));
}

//goedgemeemd
else if (strlen(strstr($text,"/goedgemeemd"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADFAEAApILuAAB8SHDXfc-jSkC' ));
}

//lama
else if (strlen(strstr($text,"/lama"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADKwEAApILuAABVTvrqE0lvucC' ));
}

//blaashet
else if (strlen(strstr($text,"/blaashet"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAAEAQACkgu4AAFKKqStz8MHrAI' ));
}

//heil
else if (strlen(strstr($text,"/heil"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADGwEAApILuAABvC7HCPAz9lQC' ));
}

//saai
else if (strlen(strstr($text,"/saai"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADQAEAApILuAABqmXP6qUYvWcC' ));
}

//klootviool
else if (strlen(strstr($text,"/klootviool"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADIwEAApILuAABF9rC2g_6xO0C' ));
}

//neetoch
else if (strlen(strstr($text,"/neetoch"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADMQEAApILuAABgQABNcX-RhK0Ag' ));
}

//lui
else if (strlen(strstr($text,"/lui"))>0) {
	$telegram->sendDocument(array('chat_id' => $chat_id, 'document' => new CURLFile("./assets/lui.gif")));
}

//meh
else if (strlen(strstr($text,"/meh"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADLwEAApILuAABiRGzNaum6QgC' ));
}

//weersvoorspelling
else if (strlen(strstr($text,"/weersvoorspelling"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADSwEAApILuAABw8hKCg98NkIC' ));
}

//nsb
else if (strlen(strstr($text,"/nsb"))>0) {
	$telegram->sendPhoto(array('chat_id' => $chat_id, 'photo' => nsb()));
}

//eens
else if (strlen(strstr($text,"/eens"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADCgEAApILuAABUHzoPdRf_HoC' ));
}

//poephoofd
else if (strlen(strstr($text,"/poephoofd"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADNwEAApILuAABK-jcBCNUUR4C' ));
}

//ditisprima
else if (strlen(strstr($text,"/ditisprima"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADBAEAApILuAABOdA6QgKfq2IC' ));
}

//poetsgebakken
else if (strlen(strstr($text,"/poetsgebakken"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADOQEAApILuAAB90TPbOn7FA8C' ));
}

//vochtig
else if (strlen(strstr($text,"/vochtig"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADRwEAApILuAABit_8V6pLYckC' ));
}

//zalwel
else if (strlen(strstr($text,"/zalwel"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADTwEAApILuAABA80dYZ2G_B4C' ));
}

//topkek
else if (strlen(strstr($text,"/topkek"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADRAEAApILuAABwWhyAAGuWQX5Ag' ));
}

//ikookbedankt
else if (strlen(strstr($text,"/ikookbedankt"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADHwEAApILuAABkHs7Y_ilpdAC' ));
}

//gewoondoehet
else if (strlen(strstr($text,"/gewoondoehet"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADEAEAApILuAABiRAa0EcIbBsC' ));
}

//accuraat
else if (strlen(strstr($text,"/accuraat"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAAD3QADCoLFAho4MfEEHQ92Ag' ));
}

//gezichtspalm
else if (strlen(strstr($text,"/gezichtspalm"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADEgEAApILuAABxQb4g8RB2u0C' ));
}

//dankje
else if (strlen(strstr($text,"/dankje"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADAgEAApILuAABOQwVcDZfi_cC' ));
}

//fedora
else if (strlen(strstr($text,"/fedora"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('assets/kopieerpasta/fedora.txt')));
}

//excuses
else if (strlen(strstr($text,"/excuses"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAADDAEAApILuAABtHBeBZH92moC' ));
}

//siebe
else if (strlen(strstr($text,"/siebe"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => file_get_contents('./assets/kopieerpasta/siebe.txt')));
}

//luchtvochtigheid
else if (strlen(strstr($text,"/luchtvochtigheid"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "69%"));
}

//rms
else if (strlen(strstr($text,"/rms"))>0) {
	$telegram->sendPhoto(array('chat_id' => $chat_id, 'photo' => rms()));
}

//meem
else if (strlen(strstr($text,"/meem"))>0 && strlen(strstr($text,"/meemkruis")) == 0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => meem()));
}

//zeg
else if (strlen(strstr($text,"/zeg"))>0 && $telegram->ReplyID() == null) {
	$telegram->sendVoice(array('chat_id' => $chat_id, 'voice' => zeg(substr($text,4), 'nl-nl')));
}

//zeg op reply
else if (strlen(strstr($text,"/zeg"))>0 && $telegram->ReplyID()) {
	$telegram->sendVoice(array('chat_id' => $chat_id, 'voice' => zeg($telegram->ReplyText(), 'nl-nl'), 'reply_to_message_id' => $telegram->ReplyID()));
}

//say
else if (strlen(strstr($text,"/say"))>0 && $telegram->ReplyID() == null) {
	$telegram->sendVoice(array('chat_id' => $chat_id, 'voice' => zeg(substr($text,4), 'en-gb')));
}

//say op reply
else if (strlen(strstr($text,"/say"))>0 && $telegram->ReplyID()) {
	$telegram->sendVoice(array('chat_id' => $chat_id, 'voice' => zeg($telegram->ReplyText(), 'en-gb'), 'reply_to_message_id' => $telegram->ReplyID()));
}

//sieg
else if (strlen(strstr($text,"/sieg"))>0 && $telegram->ReplyID() == null) {
	$telegram->sendVoice(array('chat_id' => $chat_id, 'voice' => zeg(substr($text,5), 'de-de')));
}

//sieg op reply
else if (strlen(strstr($text,"/sieg"))>0 && $telegram->ReplyID()) {
	$telegram->sendVoice(array('chat_id' => $chat_id, 'voice' => zeg($telegram->ReplyText(), 'de-de'), 'reply_to_message_id' => $telegram->ReplyID()));
}

//draai op reply
else if ($text == "/draai" && $telegram->ReplyID()) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => draai($telegram->ReplyText()), 'reply_to_message_id' => $telegram->ReplyID()));
}

//draai
else if (substr($text,0,6) == "/draai") {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => draai(substr($text,6))));
}

//levededevs
else if (strlen(strstr($text,"/levededevs"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Ik ben gemaakt door @Maartenwut met overgeporte code van de oude @FlippyBot gemaakt door @Flippylosaurus. Ook heb ik de @VochtigeBot overgenomen. Hoezo monopolie? \xF0\x9F\x98\x84 \xF0\x9F\x99\x88" . PHP_EOL . "https://github.com/Maartenwut/DeCirkeltrekBot"));
}

//benikrechts
else if (strlen(strstr($text,"benikrechts"))>0 || strlen(strstr($text,"bennikrechts"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => "Je bent helemaal rechts \xE2\x9C\x94 \xE2\x9C\x94", 'reply_to_message_id' => $telegram->MessageID()));
}

//ud
else if (strlen(strstr($text,"/ud"))>0) {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => urbandictionary(substr($text,4)), 'reply_to_message_id' => $telegram->MessageID()));
}

//dorstig
else if ($text == "/dorstig") {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'niet intrappen, ' . $telegram->FirstName() . ' is dorstig'));
}

//dorstig met persoon
else if (strlen(strstr($text,"/dorstig"))>0 && $text != "/dorstig" && substr($text,0,8) == "/dorstig") {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'niet intrappen, ' . substr($text,9) . ' is dorstig'));
}

//markovs
else if (strlen(strstr($text,"/markovs"))>0 && strlen(strstr($text,"/markovski")) == 0) {
    $telegram->sendMessage(array('chat_id' => $chat_id, 'text' => markov()));
}

//sla markov op
else if ($telegram->ForwardFrom() == "Markov_Bot") {
	file_put_contents('./ignore/markov/' . $telegram->MessageID(),$text);
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'Jo man. Hij staat bij /markovs nu.', 'reply_to_message_id' => $telegram->MessageID()));
}

//sla facezoom op
else if ($telegram->ForwardFrom() == "FaceZoomBot") {
	$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => print_r($telegram->GetPhotoFileID()), 'reply_to_message_id' => $telegram->MessageID()));
}

//giegantisch
else if (strlen(strstr($text,"/giegantisch"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => 'BQADBAAD2QADof3KCEKUkmy1su6mAg' ));
}

//facezoom
else if (strlen(strstr($text,"/facezoom"))>0) {
	$telegram->sendSticker(array('chat_id' => $chat_id, 'sticker' => facezoom()));
}

else if ($telegram->update() != false) {
	if ($telegram->update() == 'new') {
		if ($telegram->personName() != "@CirkeltrekBot") {
			$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'Sterf, '.$telegram->personName().'!'));
		} else {
			$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'Halloooootjes'));
		}

	} else if ($telegram->update() == 'left' && $telegram->personName()) {
		$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => $telegram->personName().' was gehalt!'));
	} else if ($telegram->update() == 'photo') {
		$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'Haha vet stomme foto man doe weg', 'reply_to_message_id' => $telegram->MessageID()));
	} else if ($telegram->update() == 'title') {
		$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'Haha nee', 'reply_to_message_id' => $telegram->MessageID()));
	} else if ($telegram->update() == 'pinned') {
		$telegram->sendMessage(array('chat_id' => $chat_id, 'text' => 'Pleur op', 'reply_to_message_id' => $telegram->MessageID()));
	}
}

//golfgrap
else if (strlen(strstr($text,"/golfgrap"))>0) {
    $telegram->sendMessage(array('chat_id' => $chat_id, 'text' => golfgrap()));
}
?>
