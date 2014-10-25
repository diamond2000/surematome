<div class="mskate10s view">
<h2><?php  echo __('Mskate10'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mskate10['Mskate10']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Katename'); ?></dt>
		<dd>
			<?php echo h($mskate10['Mskate10']['katename']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mskate10'), array('action' => 'edit', $mskate10['Mskate10']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mskate10'), array('action' => 'delete', $mskate10['Mskate10']['id']), null, __('Are you sure you want to delete # %s?', $mskate10['Mskate10']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mskate10s'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mskate10'), array('action' => 'add')); ?> </li>
	</ul>
</div>
