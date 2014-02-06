<?php 
$user = $this->Session->read('Auth.User');
echo '<div id="loginbar">';
    if(!empty($user)) {
        echo '<h1>Logged in as ' . $user['username'];
        echo ' ';
        echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'));
        echo '</h1>';
    } else {
        echo $this->Html->link(__('Please Login'), array('controller' => 'users', 'action' => 'login'));
    }
echo '</div>';
?>