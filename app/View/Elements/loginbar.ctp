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
                echo $this->Html->link(__('Logout'), array('controller' => 'app_users', 'plugin' => null, 'action' => 'logout'));
            echo '</li>';
            echo '<li>';
                echo $this->Html->link('View Profile', array('controller' => 'users', 'action' => 'view', $user['id']));
            echo '</li>';
            echo '<li>';
                echo $this->Html->link('Edit Profile', array('controller' => 'users', 'action' => 'edit', $user['id']));
            echo '</li>';
            echo '<li>';
            echo $this->Html->link('View my bugs', array('controller' => 'bugs', 'plugin' => null, 'action' => 'mybugs'));
            echo '</li>';
            echo '</ul>';
        } else {
            echo $this->Form->create('User', array('plugin' => null, 'controller' => 'app_users', 'action' => 'login', 'id' => 'LoginForm'));
            echo $this->Form->input('email', array('label' => __d('users', 'Email')));
            echo $this->Form->input('password',  array('label' => __d('users', 'Password')));
            echo $this->Html->link(__d('users', 'I forgot my password'), array('action' => 'reset_password'));
            //echo $this->Form->hidden('User.return_to', array('value' => $return_to));
            echo $this->Form->end(__d('users', 'Submit'));
        }
    ?>
</div>