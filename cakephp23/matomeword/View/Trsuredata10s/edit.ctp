<div class="trsuredata10s form">
<?php echo $this->Form->create('Trsuredata10'); ?>
	<fieldset>
		<legend><?php echo __('Edit Trsuredata10'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Url');
		echo $this->Form->input('honbun1');
		echo $this->Form->input('cate1');
		echo $this->Form->input('cate1', array('type' => 'select', 'options' => $kateList, 'label' => false)); 
		echo $this->Form->input('sinkikate1');
		echo $this->Form->input('title1');
		echo $this->Form->input('honbun2');
		echo $this->Form->input('cate2');
		echo $this->Form->input('sinkikate2');
		echo $this->Form->input('title2');
		echo $this->Form->input('honbun3');
		echo $this->Form->input('cate3');
		echo $this->Form->input('sinkikate3');
		echo $this->Form->input('title3');
		echo $this->Form->input('honbun4');
		echo $this->Form->input('cate4');
		echo $this->Form->input('sinkikate4');
		echo $this->Form->input('title4');
		echo $this->Form->input('honbun5');
		echo $this->Form->input('cate5');
		echo $this->Form->input('sinkikate5');
		echo $this->Form->input('title5');
		echo $this->Form->input('honbun6');
		echo $this->Form->input('cate6');
		echo $this->Form->input('sinkikate6');
		echo $this->Form->input('title6');
		echo $this->Form->input('honbun7');
		echo $this->Form->input('cate7');
		echo $this->Form->input('sinkikate7');
		echo $this->Form->input('title7');
		echo $this->Form->input('honbun8');
		echo $this->Form->input('cate8');
		echo $this->Form->input('sinkikate8');
		echo $this->Form->input('title8');
		echo $this->Form->input('honbun9');
		echo $this->Form->input('cate9');
		echo $this->Form->input('sinkikate9');
		echo $this->Form->input('title9');
		echo $this->Form->input('honbun10');
		echo $this->Form->input('cate10');
		echo $this->Form->input('sinkikate10');
		echo $this->Form->input('title10');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Trsuredata10.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Trsuredata10.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Trsuredata10s'), array('action' => 'index')); ?></li>
	</ul>
</div>
