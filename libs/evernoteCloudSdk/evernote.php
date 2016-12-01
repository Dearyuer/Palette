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
	$getResourceOCRData = true;
	$getResourceAlternateData = true;
	// final class NoteSortOrder {
	//   const CREATED = 1;
	//   const UPDATED = 2;
	//   const RELEVANCE = 3;
	//   const UPDATE_SEQUENCE_NUMBER = 4;
	//   const TITLE = 5;
	//   static public $__names = array(
	//     1 => 'CREATED',
	//     2 => 'UPDATED',
	//     3 => 'RELEVANCE',
	//     4 => 'UPDATE_SEQUENCE_NUMBER',
	//     5 => 'TITLE',
	//   );
	// }
	// public function findNotesWithSearch($noteSearch, Notebook $notebook = null, $scope = 0, $sortOrder = 0, $maxResults = 20)
	$results = $client->findNotesWithSearch('',null,0,2,5);
	$noteGuid;
	$notes = [];


	$withData = true;
	$withRecognition = true;
	$withAlternateData = true;
	// $loopIndex = 0;
	foreach ($results as $note) {
		// if($loopIndex == 5){
		// 	break;
		// }
	    $noteGuid    = $note->guid;
	    $noteType    = $note->type;
	    $noteTitle   = $note->title;
	    $noteCreated = $note->created;
	    $noteUpdated = $note->updated;
	    //$str = $noteStore->getNoteContent($token, $noteGuid);
	    // public function getNoteContent($authenticationToken, $guid);
	    // $note = $noteStore->getNoteContent($token, $noteGuid);
        $note = $noteStore->getNote($token,$noteGuid,$getNoteContent,$getResourceBody,$getResourceOCRData,$getResourceAlternateData);

        //$contentHash = 'da27ddc619e60d0c8d1eab981c525999';
	    //$hash = $noteStore->getResourceByHash($token, $noteGuid, $contentHash,$withData , $withRecognition, $withAlternateData);
	    //preg_match("/(<en-note>)((.|[\r\n])+?)(?=<\/en-note>)/",$str,$match);
	    // var_dump($match[0]);
	    //$content = str_replace('<en-note>', '', $match[0]);
	    //echo $content;

        array_push($notes,$note);
        // $loopIndex++;
	}
	echo json_encode($notes);
 ?>