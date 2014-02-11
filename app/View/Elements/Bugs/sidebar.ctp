<?php 
/*
$action = $this->params['action']; 
$is_logged_in = $this->Session->read('Auth.User.id');
$user = $this->Session->read('Auth.User');
*/

echo '<div class="actions">';
        echo $this->Element('Bugs/sidebar/search_bar');
        echo $this->Element('Bugs/sidebar/actions');
        //echo $this->Element('navigation');
echo '</div>';
