<!DOCTYPE html>
<html lang="ja">
<head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?> | Cakecompany</title>
    <!--[if lt IE 9]>
    <?php echo $this->Html->script('html5'); ?>
    <![endif]-->
    <?php echo $this->Html->css('screen', null, array('media' => "screen, projection")); ?>
    <?php echo $this->Html->css('print', null, array('media' => "print")); ?>
    <!--[if IE]>
    <?php echo $this->Html->css('ie', null, array('media' => "screen, projection")); ?>
    <![endif]-->
    <?php echo $this->Html->script('jquery-1.6.4.min'); ?>
</head>
<body>
    <div id="headerArea">
        <header>
            <div id="header">
                <?php echo $this->element('header'); ?>
            </div>
        </header>
    </div>
    <div id="contentArea">
        <div id="contentAreaWrapper">
            <div id="breadCrumbs">
                <nav>
                    <p><?php echo !empty($breadcrumb_for_layout) ? $breadcrumb_for_layout : $title_for_layout; ?></p>
                </nav>
            </div>
            <div id="contentSub">
                <div id="contentSubNavigationSection">
                    <section>
                        <?php echo $this->element('side'); ?>
                    </section>
                </div>                
            </div>
            <div id="contentTop">
                <div id="contentLeafMainSection">
                    <article id="main">
                        <header>
                            <div id="mainHeader">
                                <h1><?php echo $title_for_layout; ?></h1>
                            </div>
                        </header>
                        <div id="mainContent">
                            <?php echo $this->Session->flash(); ?>
                            <?php echo $content_for_layout; ?>
                        </div>
                    </article>
                </div>
                <div id="toTop">
                    <div id="toTopNav">
                        <nav>
                            <p><a href="#">このページの先頭へ</a></p>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <footer>
                <?php echo $this->element('footer'); ?>
        </footer>
    	<?php echo $this->element('sql_dump'); ?>
    </div>
    
</body>
</html>