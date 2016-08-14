<?php 
require_once( '../../../../../wp-load.php' );
$githubUsername = get_option('palette_github_username');;
echo file_get_contents("https://github.com/users/".$githubUsername."/contributions"); 
?>