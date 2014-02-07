<div class="users view">
<h2><?php echo __('User') . ': ' . $user['User']['nickname']; ?></h2>
<dl>
                <?php 
                    if(!empty($user['User']['first_name'])){
                        echo '<dt>';
                            echo __('First Name'); 
                        echo '</dt>';
                        echo '<dd>';
                            echo $user['User']['first_name'];
                        echo '</dd>';
                    }
                    if(!empty($user['User']['last_name'])){
                        echo '<dt>';
                            echo __('Last Name'); 
                        echo '</dt>';
                        echo '<dd>';
                            echo $user['User']['last_name'];
                        echo '</dd>';
                    }
                    if(!empty($user['User']['University Affiliation'])){
                        echo '<dt>';
                            echo __('Last Name'); 
                        echo '</dt>';
                        echo '<dd>';
                            echo $user['User']['university'];
                        echo '</dd>';
                    }
                ?>
		<dt><?php echo __('E-mail address'); ?></dt>
		<dd>
                    <?php echo $user['User']['username']; ?>
		</dd>
</dl>
</div>
<?php echo $this->Element('sidebar_users'); ?>
