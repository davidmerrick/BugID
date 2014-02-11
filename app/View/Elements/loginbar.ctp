<?php 
$user = $this->Session->read('Auth.User');
$action = $this->params['action']; 

if($action != 'login') : 
echo '<div id="loginbar">';
    echo '<div class="triangle-down"></div>';
    if(!empty($user)) {
        echo '<h1>Logged in as ' . $user['username'] . '</h1>';
    } else {
        //echo $this->Html->link(__('Please Login'), array('controller' => 'users', 'action' => 'login'));
        echo '<h1>Please Login or Register</h1>';
    }
echo '</div>';
?>
<div id="loginbar-popover" style="display:none;">
    <?php 
        if(!empty($user)) {
            //Logged in
            echo '<ul>';
                echo '<li>';
                    echo $this->Html->link(__('View Profile'), array('controller' => 'app_users', 'action' => 'view', $user['id']));
                echo '</li>';
                echo '<li>';
                    echo $this->Html->link(__('Edit Profile'), array('controller' => 'app_users', 'action' => 'edit', $user['id']));
                echo '</li>';
                echo '<li>';
                echo $this->Html->link(__('View my bugs'), array('controller' => 'bugs', 'action' => 'mybugs'));
                echo '</li>';
                echo '<li>';
                    echo $this->Html->link(__('Logout'), array('controller' => 'app_users', 'action' => 'logout'));
                echo '</li>';
            echo '</ul>';
        } else {
            $model = 'AppUser';
            echo $this->Form->create($model, array('controller' => 'app_users', 'action' => 'login', 'id' => 'LoginForm'));
            echo $this->Form->input('email', array('label' => __('Email')));
            echo $this->Form->input('password',  array('label' => __('Password')));
            echo '<p>' . $this->Form->input('remember_me', array('type' => 'checkbox', 'label' =>  __('Remember Me'))) . '</p>';
            echo '<p>' . $this->Html->link(__('I forgot my password'), array('controller' => 'app_users', 'action' => 'reset_password')) . '</p>';
            echo '<p>' . $this->Html->link(__('Register for an account'), array('controller' => 'app_users', 'action' => 'add')) . '</p>';
            //echo $this->Form->hidden('User.return_to', array('value' => $return_to));
            echo $this->Form->end(__('Submit'));
        }
    ?>
</div>
<?php endif; ?>