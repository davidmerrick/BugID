<div class="users view">
<h2><?php echo __($user[$model]['username'] . '\'s Profile'); ?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class; ?>><?php echo __d('users', 'Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class; ?>>
			<?php echo $user[$model]['username']; ?>
			&nbsp;
		</dd>
		<?php
		if (!empty($user[$model]['first_name'])) {		
                    echo '<dt>First Name</dt>';
                    echo '<dd>' . $user[$model]['first_name'] . '</dd>';
		}
                if (!empty($user[$model]['last_name'])) {		
                    echo '<dt>Last Name</dt>';
                    echo '<dd>' . $user[$model]['last_name'] . '</dd>';
		}
                if (!empty($user[$model]['university'])) {		
                    echo '<dt>University Affiliation</dt>';
                    echo '<dd>' . $user[$model]['university'] . '</dd>';
		}
		?>
                <dt<?php if ($i % 2 == 0) echo $class; ?>><?php echo __d('users', 'Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class; ?>>
			<?php echo $user[$model]['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php 
    echo $this->element('Users/sidebar', array('user' => $user[$model])); 
?>