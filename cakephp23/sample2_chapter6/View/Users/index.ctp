<?php $this->Html->addCrumb( '管理画面', '/'); ?>
<?php $this->Html->addCrumb( 'ダッシュボード'); ?>
<?php $this->set('breadcrumb_for_layout', $this->Html->getCrumbs(' &raquo; ')) ?>
<?php $this->set('title_for_layout', 'ダッシュボード'); ?>

<p>下記メニューより選んでください</p>

<ul id="dashboard">
<li>
    <?php echo $this->Html->image( 'icon_system_mail.png', array(
        'alt' => '問い合わせ管理',
        'url' => array('controller' => 'contacts', 'action' => 'index')
        )); ?>
    <br />
    <?php echo $this->Html->link('問い合わせ管理', array('controller' => 'contacts', 'action' => 'index')); ?>
</li>
<li>
    <?php echo $this->Html->image( 'icon_system_form.png', array(
        'alt' => 'ユーザ管理',
        'url' => array('action' => 'userlist')
        )); ?>
    <br />
    <?php echo $this->Html->link('ユーザ管理', array('action' => 'userlist')); ?>
</li>
<li>
    <?php echo $this->Html->image( 'icon_system_logout.png', array(
        'alt' => 'ログアウト',
        'url' => array('action' => 'logout')
        )); ?>
    <br />
    <?php echo $this->Html->link('ログアウト', array('action' => 'logout')); ?>
</li>
</ul>


