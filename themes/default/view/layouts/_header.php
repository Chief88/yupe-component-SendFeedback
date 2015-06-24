<header class="header">
    <div class="container">
        <div class="header__logo">
            <a class="<?= $classNoClick; ?>" href="/">
                <img src="<?= $mainAssets; ?>/images/logo.png" alt="Логотип" />
            </a>
        </div>
        <div class="header__right-items">
            <div class="header__contacts">

                <?php if (Yii::app()->hasModule('contact')):{ ?>
                    <?php $this->widget(
                        "application.modules.contact.widgets.GetContactWidget", [
                        'nameContact' => 'Адрес',
                        'categoryId' => 6,
                        'params' => [
                            'wrapperTagName' => 'div',
                            'wrapperHtmlOptions' => [
                                'class' => 'header__contacts-item_address header__contacts-item'
                            ]
                        ],
                    ]); ?>
                <?php }endif; ?>

                <?php if (Yii::app()->hasModule('contact')):{ ?>
                    <?php $this->widget(
                        "application.modules.contact.widgets.GetContactWidget", [
                        'nameContact' => 'Телефон',
                        'categoryId' => 6,
                        'itemDelimiter' => '<br/>',
                        'view' => 'phoneForHeader',
                        'params' => [
                            'wrapperTagName' => 'div',
                            'wrapperHtmlOptions' => [
                                'class' => 'header__contacts-item_phone header__contacts-item'
                            ]
                        ],
                    ]); ?>
                <?php }endif; ?>

                <div class="header__contacts-item_callback header__contacts-item">

                    <?php if (Yii::app()->hasModule('feedback')):{ ?>
                        <?php $this->widget(
                            "application.modules.feedback.widgets.ModalFormWidget", [
                            'type' => "button",
                            'view' => "Callback",
                            'params' => [
                                'linkParams' => [
                                    'htmlOptions' => [
                                        'class' => 'btn btn-default',
                                    ]
                                ]
                            ],
                        ]); ?>
                    <?php }endif; ?>

                </div>
            </div>
            <nav>

                <?php if (Yii::app()->hasModule('menu')):{ ?>
                    <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
                        'name' => 'top-menu',
                    ]); ?>
                <?php }endif; ?>

            </nav>
        </div>
    </div>
</header>