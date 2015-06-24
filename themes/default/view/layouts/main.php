<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<head>

    <?php Yii::app()->controller->widget(
        'vendor.chemezov.yii-seo.widgets.SeoHead',
        array(
            'httpEquivs'         => array(
                'Content-Type'     => 'text/html; charset=utf-8',
                'X-UA-Compatible'  => 'IE=edge,chrome=1',
                'Content-Language' => 'ru-RU'
            ),
            'defaultTitle'       => Yii::app()->getModule('yupe')->siteName,
            'defaultDescription' => Yii::app()->getModule('yupe')->siteDescription,
            'defaultKeywords'    => Yii::app()->getModule('yupe')->siteKeyWords,
        )
    ); ?>

    <?php
    $mainAssets = Yii::app()->getTheme()->getAssetsUrl();

    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/cssStatic/animate.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/additionsStyle.css');

    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/additionsScript.js');

    ?>

    <script type="text/javascript">
        var yupeTokenName = '<?php echo Yii::app()->getRequest()->csrfTokenName;?>';
        var yupeToken = '<?php echo Yii::app()->getRequest()->csrfToken;?>';
    </script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

<div id="fb-root"></div>
        <!-- flashMessages -->
        <?php $this->widget('yupe\widgets\YFlashMessages', [
            'options' => [
                'htmlOptions' => [
                    'id' => 'flashMessage',
                    'class' => 'animated',
                ],
                'closeText' => false,
            ]
        ]); ?>

        <main>
            <?php echo $content; ?>
        </main>

    <?php if (Yii::app()->hasModule('feedback')):{ ?>
        <!--    Callback    -->
        <?php $this->widget(
            "application.modules.feedback.widgets.ModalFormWidget", [
            'model' => \Yii::app()->session['callback']['form'],
            'module' => \Yii::app()->session['callback']['module'],
            'type' => "modal",
            'view' => "Callback",
        ]); ?>

        <?php $errorsCallback =\Yii::app()->session['callback']['form']->getErrors(); ?>
        <?php if( !empty($errorsCallback) ):{ ?>
            <script>
                $(document).ready(function() {
                    $('#callback-modal').modal('show');
                });
            </script>
        <?php }endif; ?>
        <!--    Callback end   -->
    <?php }endif; ?>

</body>
</html>
