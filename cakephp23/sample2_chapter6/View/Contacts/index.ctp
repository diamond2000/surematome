<?php $this->Html->addCrumb( '管理画面', '/'); ?>
<?php $this->Html->addCrumb( '問い合わせ管理', '/contacts'); ?>
<?php $this->Html->addCrumb( '問い合わせ一覧'); ?>
<?php $this->set('breadcrumb_for_layout', $this->Html->getCrumbs(' &raquo; ')) ?>
<?php $this->set('title_for_layout', '問い合わせ一覧'); ?>


<table class="siteInformation table table-bordered">
    <thead>
        <tr>
            <th class="siteField"><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
            <th class="siteField"><?php echo $this->Paginator->sort('name', 'お名前'); ?></th>
            <th class="siteField"><?php echo $this->Paginator->sort('email', 'メールアドレス'); ?></th>
            <th class="siteField"><?php echo $this->Paginator->sort('mtr_sex_id', '性別'); ?></th>
            <th class="siteField"><?php echo $this->Paginator->sort('mtr_age_id', '年齢'); ?></th>
            <th class="siteField"><?php echo $this->Paginator->sort('title', '題名'); ?></th>
            <th class="siteField">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($contactData as $data) { ?>
        <tr>
            <td><?php echo h($data['Contact']['id']); ?></td>
            <td><?php echo h($data['Contact']['name']); ?></td>
            <td><?php echo h($data['Contact']['email']); ?></td>
            <td><?php echo $sexList[$data['Contact']['mtr_sex_id']]; ?></td>
            <td><?php echo $ageList[$data['Contact']['mtr_age_id']]; ?></td>
            <td><?php echo h($data['Contact']['title']); ?></td>
            <td>
            <?php echo $this->Html->link('詳細', array('action' => 'view', $data['Contact']['id']), array('class' => 'btn')); ?>　
            <?php echo $this->Html->link('編集', array('action' => 'edit', $data['Contact']['id']), array('class' => 'btn')); ?>　
            <?php echo $this->Html->link('削除', array('action' => 'delete', $data['Contact']['id']), array('class' => 'btn')); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<div class="paginateLinks">
    <?php echo $this->Paginator->prev('←前に戻る', array('class' => 'btn')); ?>&nbsp;
    <?php echo $this->Paginator->numbers(array('separator' => ' ', 'class' => 'btn', 'modulus' => 5)); ?>&nbsp;
    <?php echo $this->Paginator->next('次へ進む→', array('class' => 'btn')); ?>
</div>

