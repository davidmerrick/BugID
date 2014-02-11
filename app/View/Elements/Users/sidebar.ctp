<?php 
/*
$action = $this->params['action'];
//$myuser is currently logged-in user, $user is one passed in from view
$myuser = $this->Session->read('Auth.User');
$is_logged_in = $this->Session->read('Auth.User.id');
 */      
echo '<div class="actions">';
    echo $this->Element('Users/sidebar/search_bar');
    echo $this->Element('Users/sidebar/actions');
    if($this->Session->read('Auth.User.is_admin')){
        echo '<li>&nbsp;</li>';
            echo '<li>' . $this->Html->link(__('List Users'), array('action'=>'index')); 
        echo '</li>';
    }
    //echo $this->Element('navigation');
echo '</div>';
?>