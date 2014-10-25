<div class="trsurelists index">
	<h2><?php echo __('Trsurelists'); ?></h2>
<?php
require( "matomekyotu.php" );
?>
<?php 
douki();
?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th class="actions"><?php echo __('Actions'); ?></th>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('Url'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun1'); ?></th>
			<th><?php echo $this->Paginator->sort('cate1'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate1'); ?></th>
			<th><?php echo $this->Paginator->sort('title1'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun2'); ?></th>
			<th><?php echo $this->Paginator->sort('cate2'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate2'); ?></th>
			<th><?php echo $this->Paginator->sort('title2'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun3'); ?></th>
			<th><?php echo $this->Paginator->sort('cate3'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate3'); ?></th>
			<th><?php echo $this->Paginator->sort('title3'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun4'); ?></th>
			<th><?php echo $this->Paginator->sort('cate4'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate4'); ?></th>
			<th><?php echo $this->Paginator->sort('title4'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun5'); ?></th>
			<th><?php echo $this->Paginator->sort('cate5'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate5'); ?></th>
			<th><?php echo $this->Paginator->sort('title5'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun6'); ?></th>
			<th><?php echo $this->Paginator->sort('cate6'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate6'); ?></th>
			<th><?php echo $this->Paginator->sort('title6'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun7'); ?></th>
			<th><?php echo $this->Paginator->sort('cate7'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate7'); ?></th>
			<th><?php echo $this->Paginator->sort('title7'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun8'); ?></th>
			<th><?php echo $this->Paginator->sort('cate8'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate8'); ?></th>
			<th><?php echo $this->Paginator->sort('title8'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun9'); ?></th>
			<th><?php echo $this->Paginator->sort('cate9'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate9'); ?></th>
			<th><?php echo $this->Paginator->sort('title9'); ?></th>
			<th><?php echo $this->Paginator->sort('honbun10'); ?></th>
			<th><?php echo $this->Paginator->sort('cate10'); ?></th>
			<th><?php echo $this->Paginator->sort('sinkikate10'); ?></th>
			<th><?php echo $this->Paginator->sort('title10'); ?></th>

	</tr>
	<?php foreach ($trsurelists as $trsurelist): ?>
	<tr>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $trsurelist['Trsurelist']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $trsurelist['Trsurelist']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $trsurelist['Trsurelist']['id']), null, __('Are you sure you want to delete # %s?', $trsurelist['Trsurelist']['id'])); ?>
		</td>
		<td><?php echo h($trsurelist['Trsurelist']['id']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['Url']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun1']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate1']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate1']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title1']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun2']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate2']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate2']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title2']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun3']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate3']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate3']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title3']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun4']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate4']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate4']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title4']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun5']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate5']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate5']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title5']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun6']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate6']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate6']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title6']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun7']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate7']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate7']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title7']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun8']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate8']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate8']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title8']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun9']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate9']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate9']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title9']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['honbun10']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['cate10']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['sinkikate10']); ?>&nbsp;</td>
		<td><?php echo h($trsurelist['Trsurelist']['title10']); ?>&nbsp;</td>

	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Trsurelist'), array('action' => 'add')); ?></li>
	</ul>
</div>
