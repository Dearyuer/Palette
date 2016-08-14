<?php 

/**
 * Adds Foo_Widget widget.
 */
class Palette_Evernote_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'palette_evernote_widget',
			__('Palette Evernote', 'palette'),
			array( 'description' => __('Recent notes', 'palette')
			));
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		//echo __( esc_attr( 'Hello, World!' ), 'text_domain' );
		require_once get_template_directory().'/libs/evernoteCloudSdk/vendor/autoload.php';
		// require_once get_template_directory().'/libs/evernoteCloudSdk/src/EDAM/NoteStore/NoteStore.php';
		//EDAM\NoteStore
		$token = get_option('palette_evernote_auth_token');
		// $sandbox = true;
		// $china   = false;

		// $client = new \Evernote\Client($token, $sandbox, null, null, $china);

		// $notebooks = array();

		// $notebooks = $client->listNotebooks();
		// var_dump($client);
		// foreach ($notebooks as $notebook) {

		//     echo "\n\nName : " . $notebook->name;

		//     echo "\nGuid : " . $notebook->guid;

		//     echo "\nIs Business : ";
		//     echo $notebook->isBusinessNotebook()?"Y":"N";

		//     echo "\nIs Default  : ";
		//     echo $notebook->isDefaultNotebook()?"Y":"N";

		//     echo "\nIs Linked   : ";
		//     echo $notebook->isLinkedNotebook()?"Y":"N";
		// }
		if($token){
			//try{}
			$sandbox = true; 
			$china   = false;

			$client = new \Evernote\Client($token, $sandbox, null, null, $china);



			// var_dump($client->getUserNotestore());
			// var_dump($client->getNoteStore());
			// var_dump($client->getShareUrl());
			$advancedClient = $client->getAdvancedClient();
			// var_dump($advancedClient->getNoteStore());
			// $advancedClient->newTHriftFactory();


			//echo $advancedClient->getNoteStore()->url;
			// $noteStoreTransport = new Thrift\Transport\THttpClient('https://sandbox.evernote.com/shard/s1/notestore');
			// $noteStoreProtocol = new Thrift\Protocol\TBinaryProtocol($noteStoreTransport);
			// $storeClient = new EDAM\NoteStore\NoteStoreClient($noteStoreProtocol);
			$evernoteHost = "sandbox.evernote.com";
			$evernotePort = "443";
			$evernoteScheme = "https";

			$userStoreHttpClient =
			  new Thrift\Transport\THttpClient($evernoteHost, $evernotePort, "/edam/user", $evernoteScheme);
			$userStoreProtocol = new Thrift\Protocol\TBinaryProtocol($userStoreHttpClient);
			$userStoreClient = new EDAM\UserStore\UserStoreClient($userStoreProtocol, $userStoreProtocol);

			$noteStoreUrl = $userStoreClient->getNoteStoreUrl($token);

			$noteStore = $client->getNoteStore($noteStoreUrl);
			// $noteStoreTransport = new Thrift\Transport\THttpClient();
			// $noteStoreProtocol = new Thrift\Protocol\TBinaryProtocol($noteStoreTransport);
			// $noteStoreClient = new EDAM\NoteStore\NoteStoreClient($noteStoreProtocol);


			$getNoteContent = true;
			$getResourceBody = true;
			$getResourceOCRData = false;
			$getResourceAlternateData = false;
			//$fullNote = $noteStoreClient.getNote(authToken, note.Guid, getNoteContent, getResourceBody, getResourceOCRData, getResourceAlternateData);

			//var_dump($noteStoreClient->getNote);


			$results = $client->findNotesWithSearch('');

			$noteGuid;
			//var_dump(($results));
			foreach ($results as $note) {
			    $noteGuid    = $note->guid;
			    $noteType    = $note->type;
			    $noteTitle   = $note->title;
			    $noteCreated = $note->created;
			    $noteUpdated = $note->updated;
			    //var_dump($client->getNote($noteGuid,null));
			    //$noteContent = $note->getContent();
			    //echo $noteGuid;
			    //echo $noteTitle;

			    $str = $noteStore->getNoteContent($token, $noteGuid);
			    preg_match("/(<en-note>)((.|[\r\n])+?)(?=<\/en-note>)/",$str,$match);
			    var_dump($match[0]);
			    $content = str_replace('<en-note>', '', $match[0]);
			    var_dump($content);
			    // $match = [];
			    // var_dump($str);
			    
			    // $content = str_replace('<en-note>', '', $match[0][0]);
			    // var_dump($content);
			    // $fullNote = $noteStore->getNote($token, $noteGuid, $getNoteContent, $getResourceBody, $getResourceOCRData, $getResourceAlternateData);
			    // var_dump($fullNote);
			    //echo $advancedClient->getContent($token, $noteGuid);

			}
		}




		//$getBusinessNoteStore = $advancedClient->getBusinessNoteStore();
		//var_dump($getBusinessNoteStore);
		// $notes = $client->getBusinessNoteStore();
		// var_dump($notes);



		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget


 ?>