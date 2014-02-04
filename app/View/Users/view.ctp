<div class="users view">
<h2><?php echo __('User') . ': ' . $user['User']['nickname']; ?></h2>
<dl>
		<dt><?php echo __('E-mail address'); ?></dt>
		<dd>
                    <?php echo $user['User']['username']; ?>
		</dd>
</dl>


</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
	</ul>
</div>
