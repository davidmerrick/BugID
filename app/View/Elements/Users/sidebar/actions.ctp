<?php
$action = $this->params['action'];
$myuser = $this->Session->read('Auth.User');
$is_logged_in = $this->Session->read('Auth.User.id');

echo '<h3>' . __('Actions') . '</h3>';
        echo '<ul>';
        if (!$is_logged_in){
            echo '<li>';
                echo $this->Html->link(__('Login'), array('controller' => 'app_users', 'action' => 'login'));
            echo '</li>';
            if (!empty($allowRegistration) && $allowRegistration){ 
                echo '<li>';
                    echo $this->Html->link(__('Register an account'), array('controller' => 'app_users', 'action' => 'add'));
                echo '</li>';
            } 
        } else {
                if(isset($this->request->params['pass'][0])){
                    $user_id = $this->request->params['pass'][0];
                } else {
                    $user_id = null;
                } 
                //If we're viewing someone else's profile and not viewing our own,
                //add a link to view our own.
                if($action != 'view' || isset($user_id) && $user_id != $myuser['id']){
                    echo '<li>';
                    echo $this->Html->link(__('View My Profile'), array('controller' => 'app_users', 'action' => 'view', $this->Session->read('Auth.User.id')));
                    echo '</li>';
                }
                if($action != 'viewbugs' && isset($user_id) && $user_id != $myuser['id']){
                    echo '<li>';
                    echo $this->Html->link(__('View this User\'s Bugs'), array('controller' => 'bugs', 'action' => 'viewbugs', $user_id));
                    echo '</li>';
                }
                //Only show edit profile options when we're viewing our own
                //@todo: Fix this. $user_id and $myuser['id'] are equal but it's not displaying any options on view page for user
                if(isset($user_id) && $user_id == $myuser['id']){
                    if($action != 'edit'){
                        echo '<li>';
                            echo $this->Html->link(__('Edit Profile'), array('controller' => 'app_users', 'action' => 'edit', $this->Session->read('Auth.User.id')));
                        echo '</li>';
                    }
                    if($action != 'change_password'){
                        echo '<li>';
                            echo $this->Html->link(__('Change password'), array('controller' => 'app_users', 'action' => 'change_password')); 
                        echo '</li>';
                    }
                    if($action == 'edit'){
                        echo '<li>';    
                            echo $this->Form->postLink(__('Delete My Account'), array('action' => 'delete', $this->Session->read('Auth.User.id')), null, __('Are you sure you want to delete your account?'));
                        echo '</li>';                            
                    }
                    echo '<li>';
                        echo $this->Html->link(__('Logout'), array('controller' => 'app_users', 'action' => 'logout'));
                    echo '</li>';
                }
        }
        echo '</ul>';

