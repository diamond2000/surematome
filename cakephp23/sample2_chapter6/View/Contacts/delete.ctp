<?php $this->Html->addCrumb( '管理画面', '/'); ?>
<?php $this->Html->addCrumb( '問い合わせ管理', '/contacts'); ?>
<?php $this->Html->addCrumb( '問い合わせ削除'); ?>
<?php $this->set('breadcrumb_for_layout', $this->Html->getCrumbs(' &raquo; ')) ?>
<?php $this->set('title_for_layout', '問い合わせ削除'); ?>


<p>下記エントリーを削除してもよろしければ「削除」ボタンを押してください</p>

<?php echo $this->Form->create('Contact', array('type' => 'delete')); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
<table class="siteInformation table table-bordered">
    <thead>
        <tr>
            <th class="siteInformationField">お問い合わせ項目</th>
            <th class="siteInformationDesctiption">入力欄</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>ID</th>
            <td><?php echo h($this->data['Contact']['id']); ?></td>
        </tr>
        <tr>
            <th>名前</th>
            <td><?php echo h($this->data['Contact']['name']); ?></td>
        </tr>
        <tr>
            <th>メール</th>
            <td><?php echo h($this->data['Contact']['email']); ?></td>
        </tr>
        <tr>
            <th>性別</th>
            <td><?php echo $sexList[$this->data['Contact']['mtr_sex_id']]; ?></td>
        </tr>
        <tr>
            <th>年齢</th>
            <td><?php echo $ageList[$this->data['Contact']['mtr_age_id']]; ?></td>
        </tr>
        <tr>
            <th>件名</th>
            <td><?php echo h($this->data['Contact']['title']); ?></td>
        </tr>
        <tr>
            <th>内容</th>
            <td><?php echo nl2br(h($this->data['Contact']['content'])); ?></td>
        </tr>
        <tr>
            <th>趣味</th>
            <td>
                <?php foreach($this->data['MtrFavolite'] as $favolite) { ?>
                <div class="favoliteItem"><?php echo $favoliteList[$favolite['id']]; ?></div>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <?php echo $this->Form->submit('　削除　'); ?>
            </td>
        </tr>
    </tbody>
</table>
<?php echo $this->Form->end(); ?>
