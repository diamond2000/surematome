                        <header id="contentSubNavigationSectionHeader">
                            <h1>このカテゴリー内のナビゲーション</h1>
                        </header>
                        <div id="categoryNavigationBySort">
                            <nav>
                                <div id="categoryNavigationBySortTitle">
                                    <h1>管理画面</h1>
                                </div>
                                <div id="categoryNavigationBySortList">
                                    <ul>
                                        <li><?php echo $this->Html->link('ダッシュボード', array('controller' => 'users', 'action' => 'index')); ?></li>
                                        <li><?php echo $this->Html->link('お問い合わせ管理', array('controller' => 'contacts', 'action' => 'index')); ?></li>
                                        <li><?php echo $this->Html->link('ユーザー管理', array('controller' => 'users', 'action' => 'userlist')); ?></li>
                                        <li class="last"><?php echo $this->Html->link('ログアウト', array('controller' => 'users', 'action' => 'logout')); ?></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

