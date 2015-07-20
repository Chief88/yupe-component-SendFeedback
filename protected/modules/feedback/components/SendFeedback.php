<?php
/**
 * MailMessage application component
 * Класс компонента MailMessage:
 *
 * @category YupeApplicationComponent
 * @package  yupe.modules.mail.components
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/

Yii::import('application.modules.mail.MailModule');
Yii::import('application.modules.mail.models.*');

/**
 * Class SendFeedback
 */
class SendFeedback extends CApplicationComponent{

    /**
     * @param array $params
     */
    public function send($params = [
        'scenario',
        'themes',
        'modelName',
    ]){

        $type = null;

        $scenario = $params['scenario'];
        $theme = $params['themes'];
        $modelName = $params['modelName'];
        $form = new $modelName($scenario);

        // если пользователь авторизован - подставить его данные
        if (\Yii::app()->user->isAuthenticated()) {
            $form->email = \Yii::app()->getUser()->getProFileField('email');
            $form->name = \Yii::app()->getUser()->getProFileField('nick_name');
        }

        // проверить не передан ли тип и присвоить его аттрибуту модели
        $form->type = empty($type) ? \FeedBack::TYPE_DEFAULT : (int)$type;

        $module = \Yii::app()->getModule('feedback');

        if (\Yii::app()->getRequest()->getIsPostRequest() && !empty($_POST[$form->getModelName()])) {

            $form->setAttributes(\Yii::app()->getRequest()->getPost($form->getModelName()));

            if(empty($form->theme)){
                $form->theme = $theme;
            }

            if ($form->validate()) {

                if(empty($form->text)){
                    $form->text = "&nbsp;";
                }

                // обработка запроса
                $backEnd = array_unique($module->backEnd);

                $success = true;
                if (is_array($backEnd)) {

                    foreach ($backEnd as $storage) {

                        $sender = new $storage(\Yii::app()->mail, $module);

                        if (!$sender->send($form)) {
                            $success = false;
                        }
                    }
                }

                if ($success) {

                    if (\Yii::app()->getRequest()->getIsAjaxRequest()) {
                        \Yii::app()->ajax->success(\Yii::t('FeedbackModule.feedback', 'Your message sent! Thanks!'));
                    }

                    \Yii::app()->getUser()->setFlash(
                        \yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,'Спасибо, ваше сообщение отправлено!'
                    );

                    $form = new $modelName($scenario);

                    // если пользователь авторизован - подставить его данные
                    if (\Yii::app()->user->isAuthenticated()) {
                        $form->email = \Yii::app()->getUser()->getProFileField('email');
                        $form->name = \Yii::app()->getUser()->getProFileField('nick_name');
                    }

                    // проверить не передан ли тип и присвоить его аттрибуту модели
                    $form->type = empty($type) ? \FeedBack::TYPE_DEFAULT : (int)$type;

                    if(empty($form->theme)){
                        $form->theme = $theme;
                    }

                    if(empty($form->text)){
                        $form->text = $theme;
                    }

                }else{

                    if (\Yii::app()->getRequest()->getIsAjaxRequest()) {
                        \Yii::app()->ajax->failure(\Yii::t('FeedbackModule.feedback', 'It is not possible to send message!'));
                    }

                    \Yii::app()->getUser()->setFlash(
                        \yupe\widgets\YFlashMessages::ERROR_MESSAGE,'Прроизошла ошибка. Попробуйте еще раз или обратитесь в тех. поддержку.'
                    );

                }

            } else {
                if (\Yii::app()->getRequest()->getIsAjaxRequest()) {
                    \Yii::app()->ajax->rawText(CActiveForm::validate($form));
                }
            }
        }

        \Yii::app()->session[$scenario] = [
            'form' => $form,
            'module' => $module
        ];

    }

}
