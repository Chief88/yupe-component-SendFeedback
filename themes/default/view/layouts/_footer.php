<footer>
    <div class="container">
        <div class="footer__contacts">
            <p class="font-14">© 2015 Велнес клуб Адриатика</p>
            <p>
                <?php if (Yii::app()->hasModule('contact')):{ ?>
                    <?php $this->widget(
                        "application.modules.contact.widgets.GetContactWidget", [
                        'nameContact' => 'Адрес',
                        'categoryId' => 6,
                        'itemDelimiter' => '<br />',
                    ]); ?>
                <?php }endif; ?>
                <br />
                <a href="/contact/#map1">Смотреть на карте</a>
            </p>
            <div class="sepa-5"></div>
            <div class="block">
                <div class="footer__callback">

                    <?php if (Yii::app()->hasModule('feedback')):{ ?>
                        <?php $this->widget(
                            "application.modules.feedback.widgets.ModalFormWidget", [
                            'type' => "button",
                            'view' => "Callback",
                            'params' => [
                                'linkParams' => [
                                    'htmlOptions' => [
                                        'class' => 'btn btn-default-small',
                                    ]
                                ]
                            ],
                        ]); ?>
                    <?php }endif; ?>

                </div>

                <?php if (Yii::app()->hasModule('contact')):{ ?>
                    <?php $this->widget(
                        "application.modules.contact.widgets.GetContactWidget", [
                        'nameContact' => 'Телефон',
                        'categoryId' => 6,
                        'itemDelimiter' => '',
                        'params' => [
                            'wrapperTagName' => 'div',
                            'wrapperHtmlOptions' => [
                                'class' => 'footer__phone'
                            ]
                        ],
                    ]); ?>
                <?php }endif; ?>
            </div>

            <?php if (Yii::app()->hasModule('contact')):{ ?>
                <?php $this->widget(
                    "application.modules.contact.widgets.GetContactWidget", [
                    'view' => 'linkSocialNetwork',
                    'nameContact' => 'Ссылки на соц. сети',
                    'categoryId' => 6,
                ]); ?>
            <?php }endif; ?>

        </div>
        <div class="footer__right">
            <nav>

                <?php if (Yii::app()->hasModule('menu')):{ ?>
                    <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
                        'name' => 'dlya-futera',
                        'layout' => 'footerMenu',
                    ]); ?>
                <?php }endif; ?>

            </nav>
            <div class="developer-info">
                Разработка сайта — <a href="http://adelfo-studio.ru/" target="_blank">Adelfo development</a>
            </div>
        </div>
    </div>
</footer>