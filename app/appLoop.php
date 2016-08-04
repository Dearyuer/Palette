<?php 
$getParticleSettingsData;
for($i = 0;$i < count($particleLoopArr);$i++){
	if( isset($_POST[$particleLoopArr[$i]]) ){
		$getParticleSettingsData = get_option($particleLoopArr[$i]);
		if($getParticleSettingsData == $_POST[$particleLoopArr[$i]]){
			continue;
		}
		if(empty($getParticleSettingsData)){
			update_option($particleLoopArr[$i], $_POST[$particleLoopArr[$i]]);
			continue;
		}
		update_option($particleLoopArr[$i], $_POST[$particleLoopArr[$i]]);
		$noChangesSaved++;
	}
}

// loop for checkboxs that default value is checked
$getParticleSettingsState;
for($i = 0;$i < count($particleLoopArr2);$i++){
	if( isset($_POST[$particleLoopArr2[$i]]) && $_POST[$particleLoopArr2[$i]] == $particleLoopArr2[$i] ){
		$getParticleSettingsState = get_option($particleLoopArr2[$i]);
		if($getParticleSettingsState == -1){
			update_option($particleLoopArr2[$i], 1);
			$noChangesSaved++;
		}
	}else{
		$getParticleSettingsState = get_option($particleLoopArr2[$i]);
		if($getParticleSettingsState == 1 || empty($getParticleSettingsState )){
			update_option($particleLoopArr2[$i], -1);
			$noChangesSaved++;
		}
	}
}

// loop for checkboxs that default value is unchecked
$getParticleSettingsState2;
for($i = 0;$i < count($particleLoopArr3);$i++){
	if( isset($_POST[$particleLoopArr3[$i]]) && $_POST[$particleLoopArr3[$i]]  == $particleLoopArr3[$i]){
		$getParticleSettingsState2 = get_option($particleLoopArr3[$i]);
		if( empty($getParticleSettingsState2) ) {
			update_option( $particleLoopArr3[$i], 1 );
			$noChangesSaved++;
		}
	}else{
		$getParticleSettingsState2 = get_option($particleLoopArr3[$i]);
		if( !empty($getParticleSettingsState2) ){
			update_option( $particleLoopArr3[$i], 0 );
			$noChangesSaved++;
		}
	}
}

 ?>