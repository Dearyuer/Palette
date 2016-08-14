<?php 
	require_once( '../../../../../wp-load.php' );
	require_once get_template_directory().'/libs/evernoteCloudSdk/vendor/autoload.php';
	$token = get_option('palette_evernote_auth_token');
	
	$sandbox = true; 
	$china   = false;

	$client = new \Evernote\Client($token, $sandbox, null, null, $china);
	$evernoteHost = "sandbox.evernote.com";
	$evernotePort = "443";
	$evernoteScheme = "https";
	$userStoreHttpClient =
	  new Thrift\Transport\THttpClient($evernoteHost, $evernotePort, "/edam/user", $evernoteScheme);
	$userStoreProtocol = new Thrift\Protocol\TBinaryProtocol($userStoreHttpClient);
	$userStoreClient = new EDAM\UserStore\UserStoreClient($userStoreProtocol, $userStoreProtocol);
	$noteStoreUrl = $userStoreClient->getNoteStoreUrl($token);
	$noteStore = $client->getNoteStore($noteStoreUrl);
	$getNoteContent = true;
	$getResourceBody = true;
	$getResourceOCRData = false;
	$getResourceAlternateData = false;
	$results = $client->findNotesWithSearch('');
	$noteGuid;
	foreach ($results as $note) {
	    $noteGuid    = $note->guid;
	    // $noteType    = $note->type;
	    // $noteTitle   = $note->title;
	    // $noteCreated = $note->created;
	    // $noteUpdated = $note->updated;
	    $str = $noteStore->getNoteContent($token, $noteGuid);
	    preg_match("/(<en-note>)((.|[\r\n])+?)(?=<\/en-note>)/",$str,$match);
	    // var_dump($match[0]);
	    $content = str_replace('<en-note>', '', $match[0]);
	    echo $content;
	}
 ?>