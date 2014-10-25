<?php $this->Html->addCrumb( '管理画面', '/'); ?>
<?php $this->Html->addCrumb( '問い合わせ管理', '/contacts'); ?>
<?php $this->Html->addCrumb( '問い合わせ編集'); ?>
<?php $this->set('breadcrumb_for_layout', $this->Html->getCrumbs(' &raquo; ')) ?>
<?php $this->set('title_for_layout', '問い合わせ編集'); ?>



<?php echo $this->Form->create('Contact'); ?>
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
            <td>
                <?php echo empty($this->data['Contact']['id']) ? '(新規)' : h($this->data['Contact']['id']); ?>
                <?php echo empty($this->data['Contact']['id']) ? null : $this->Form->input('id', array('type' => 'hidden')); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $this->Form->label('Contact.name', '名前'); ?></th>
            <td><?php echo $this->Form->input('name', array('label' => false)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->Form->label('Contact.email', 'メール'); ?></th>
            <td><?php echo $this->Form->input('email', array('label' => false)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->Form->label('Contact.mtr_sex_id', '性別'); ?></th>
            <td><?php echo $this->Form->input('mtr_sex_id', array('type' => 'radio', 'options' => $sexList, 'label' => false, 'legend' => false)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->Form->label('Contact.mtr_age_id', '年齢'); ?></th>
            <td><?php echo $this->Form->input('mtr_age_id', array('type' => 'select', 'options' => $ageList, 'label' => false)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->Form->label('Contact.title', '件名'); ?></th>
            <td><?php echo $this->Form->input('title', array('label' => false)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->Form->label('Contact.content', '内容'); ?></th>
            <td><?php echo $this->Form->input('content', array('type' => 'textarea', 'label' => false)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->Form->label('MtrFavolite.MtrFavolite', '趣味'); ?></th>
            <td><?php echo $this->Form->input('MtrFavolite.MtrFavolite', array('multiple' => 'checkbox', 'options' => $favoliteList, 'label' => false)); ?></td>
        </tr>
        <tr>
            <th></th>
            <td>
                <?php echo $this->Form->input('confirmed', array('type' => 'hidden', 'value' => false)); ?>
                <?php echo $this->Form->submit(empty($this->data['Contact']['id']) ? '　追加　' : '　編集　'); ?>
            </td>
        </tr>
    </tbody>
</table>
<?php echo $this->Form->end(); ?>
