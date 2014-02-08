<?php $action = $this->params['action']; ?>
<div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
            <ul>
		<?php if (!$this->Session->read('Auth.User.id')) : ?>
			<li><?php echo $this->Html->link(__('Login'), array('controller' => 'app_users', 'action' => 'login')); ?></li>
            <?php if (!empty($allowRegistration) && $allowRegistration)  : ?>
			<li><?php echo $this->Html->link(__('Register an account'), array('controller' => 'app_users', 'action' => 'add')); ?></li>
            <?php endif; ?>
		<?php else : ?>
			<li><?php echo $this->Html->link(__('View Profile'), array('controller' => 'app_users', 'action' => 'view', $this->Session->read('Auth.User.id'))); ?>
                        <li><?php echo $this->Html->link(__('Edit Profile'), array('controller' => 'app_users', 'action' => 'edit', $this->Session->read('Auth.User.id'))); ?>
			<li><?php echo $this->Html->link(__('Change password'), array('controller' => 'app_users', 'action' => 'change_password')); ?>
                        <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'app_users', 'action' => 'logout')); ?>
		<?php endif ?>
		<?php if($this->Session->read('Auth.User.is_admin')) : ?>
            <li>&nbsp;</li>
            <li><?php echo $this->Html->link(__('List Users'), array('action'=>'index'));?></li>
        <?php endif; ?>
	</ul>
        
        <?php if ($this->Session->read('Auth.User.id')) : ?>
        <h3><?php echo __('Navigation'); ?></h3>
            <ul>
                    <?php
                        if($action != 'mybugs'){
                            echo '<li>';
                                echo $this->Html->link(__('My Bugs'), array('controller' => 'bugs', 'action' => 'mybugs')); 
                            echo '</li>';
                        }
                        if($action != 'index'){
                            echo '<li>';
                                echo $this->Html->link(__('All Bugs'), array('controller' => 'bugs', 'action' => 'index')); 
                            echo '</li>';
                        }
                        ?>
                </li>
            </ul>    
            <?php endif; ?>
</div>
