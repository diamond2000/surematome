<?php $this->Html->addCrumb( '管理画面', '/'); ?>
<?php $this->Html->addCrumb( '問い合わせ管理', '/contacts'); ?>
<?php $this->Html->addCrumb( h($contactData['Contact']['title'])); ?>
<?php $this->set('breadcrumb_for_layout', $this->Html->getCrumbs(' &raquo; ')) ?>
<?php $this->set('title_for_layout', h($contactData['Contact']['title'])); ?>


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
            <td><?php echo h($contactData['Contact']['id']); ?></td>
        </tr>
        <tr>
            <th>名前</th>
            <td><?php echo h($contactData['Contact']['name']); ?></td>
        </tr>
        <tr>
            <th>メール</th>
            <td><?php echo h($contactData['Contact']['email']); ?></td>
        </tr>
        <tr>
            <th>性別</th>
            <td><?php echo $sexList[$contactData['Contact']['mtr_sex_id']]; ?></td>
        </tr>
        <tr>
            <th>年齢</th>
            <td><?php echo $ageList[$contactData['Contact']['mtr_age_id']]; ?></td>
        </tr>
        <tr>
            <th>件名</th>
            <td><?php echo h($contactData['Contact']['title']); ?></td>
        </tr>
        <tr>
            <th>内容</th>
            <td><?php echo h($contactData['Contact']['content']); ?></td>
        </tr>
        <tr>
            <th>趣味</th>
            <td>
                <?php
                if(!empty($contactData['MtrFavolite']['MtrFavolite'])) {
                    foreach($contactData['MtrFavolite']['MtrFavolite'] as $favolite) {
                        echo $favoliteList[$favolite].'<br />';
                    }
                }?>
            </td>
        </tr>
    </tbody>
</table>


<div class="btn"><?php echo $this->Html->link('戻る', array('action' => 'index')); ?></div>
