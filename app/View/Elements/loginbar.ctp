<?php 
$user = $this->Session->read('Auth.User');
echo '<div id="loginbar">';
    echo '<div class="triangle-down"></div>';
    if(!empty($user)) {
        echo '<h1>Logged in as ' . $user['username'] . '</h1>';
    } else {
        //echo $this->Html->link(__('Please Login'), array('controller' => 'users', 'action' => 'login'));
        echo '<h1>Please Login</h1>';
    }
echo '</div>';
?>
<div id="loginbar-popover" style="display:none;">
    <?php 
        if(!empty($user)) {
            //Logged in
            echo '<ul>';
            echo '<li>';
                echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'));
            echo '</li>';
            echo '<li>';
                echo $this->Html->link('View Profile', array('controller' => 'users', 'action' => 'view', $user['id']));
            echo '</li>';
            echo '<li>';
                echo $this->Html->link('Edit Profile', array('controller' => 'users', 'action' => 'edit', $user['id']));
            echo '</li>';
            echo '<li>';
            echo $this->Html->link('View my bugs', array('controller' => 'users', 'action' => 'mybugs'));
            echo '</li>';
            echo '</ul>';
        } else {
            echo $this->Form->create('User', array('controller'=>'user', 'action'=>'login')); 
            echo $this->Form->input('username', array('label' => 'E-mail address'));
            echo $this->Form->input('password');
            echo $this->Form->end(__('Login'));
            echo $this->Html->link(__('Register for an account'), array('controller' => 'users', 'action' => 'add'));
        }
    ?>
</div>