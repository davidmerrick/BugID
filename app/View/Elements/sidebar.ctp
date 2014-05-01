<?php 
$controller = $this->params['controller'];
if($controller == 'app_users'){
	echo $this->Element('Users/sidebar');
} else if($controller == 'bugs'){
	echo $this->Element('Bugs/sidebar');
}
?>