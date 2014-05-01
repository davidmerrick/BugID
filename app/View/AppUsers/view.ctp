<div class="users view">
<h2><?php echo __(ucfirst($user[$model]['username']) . '\'s Profile'); ?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
                <?php 
                    if($user[$model]['profile_photo']){
                        echo '<dt>';
                            echo __('Profile Photo');
                        echo '</dt>';
                        echo '<dd>';
                        echo $this->Html->image($user[$model]['profile_photo'], array('class' => 'profile_photo'));
                        echo '</dd>';
                    }
                ?>
		<?php
                if (!empty($user[$model]['email'])) {		
                    echo '<dt>E-mail Address</dt>';
                    echo '<dd>' . $user[$model]['email'] . '</dd>';
		}
		if (!empty($user[$model]['first_name'])) {		
                    echo '<dt>First Name</dt>';
                    echo '<dd>' . $user[$model]['first_name'] . '</dd>';
		}
                if (!empty($user[$model]['last_name'])) {		
                    echo '<dt>Last Name</dt>';
                    echo '<dd>' . $user[$model]['last_name'] . '</dd>';
		}
                if (!empty($user[$model]['university'])) {		
                    echo '<dt>University</dt>';
                    echo '<dd>' . $user[$model]['university'] . '</dd>';
		}
		?>
                <dt<?php if ($i % 2 == 0) echo $class; ?>><?php echo __('Joined'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class; ?>>
			<?php echo $this->Time->nice($user[$model]['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>