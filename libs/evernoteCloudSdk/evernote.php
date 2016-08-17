<?php 
	require_once( '../../../../../wp-load.php' );
	require_once get_template_directory().'/libs/evernoteCloudSdk/vendor/autoload.php';
	$token = get_option('palette_evernote_auth_token');
	$sandbox = false;
	$china = false;
	$client = new \Evernote\Client($token, $sandbox, null, null, $china);
	$advancedClient = new \Evernote\AdvancedClient($token, $sandbox);
	$noteStore = $advancedClient->getNoteStore();
	$getNoteContent = true;
	$getResourceBody = true;
	$getResourceOCRData = false;
	$getResourceAlternateData = false;
	$results = $client->findNotesWithSearch('');
	$noteGuid;
	$notes = [];		
	foreach ($results as $note) {
	    $noteGuid    = $note->guid;
	    $noteType    = $note->type;
	    $noteTitle   = $note->title;
	    $noteCreated = $note->created;
	    $noteUpdated = $note->updated;
	    //$str = $noteStore->getNoteContent($token, $noteGuid);
        $note = $noteStore->getNote($token,$noteGuid,$getNoteContent,$getResourceBody,$getResourceOCRData,$getResourceAlternateData);
	    //preg_match("/(<en-note>)((.|[\r\n])+?)(?=<\/en-note>)/",$str,$match);
	    // var_dump($match[0]);
	    //$content = str_replace('<en-note>', '', $match[0]);
	    //echo $content;
        array_push($notes,$note);
	}
	echo json_encode($notes);
 ?>
