<div class="mskate10s form">
<?php echo $this->Form->create('Mskate10'); ?>
	<fieldset>
		<legend><?php echo __('Add Mskate10'); ?></legend>
	<?php
		echo $this->Form->input('katename');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mskate10s'), array('action' => 'index')); ?></li>
	</ul>
</div>
