<?php

/**
 * FeedBackContantsForm форма обратной связи для публичной части сайта
 *
 * @category YupeController
 * @package  yupe.modules.feedback.models
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @link     http://yupe.ru
 *
 **/
class CallBackForm extends CFormModel implements IFeedbackForm
{
    public $name;
    public $email;
    public $phone;
    public $theme;
    public $text;
    public $type;
    public $verifyCode;

    public function rules()
    {
        $module = Yii::app()->getModule('feedback');

        return [
            ['email, name, theme, text',
                'required',
                'on' => 'insert',
                'message' => 'Ошибка'
            ],
            ['email, name, phone',
                'required',
                'on' => 'callback',
                'message' => 'Ошибка'
            ],
            ['phone',
                'match',
                'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$/',
                'message' => 'Ошибка'
            ],
            ['type',
                'numerical',
                'integerOnly' => true,
                'message' => 'Ошибка'
            ],
            ['name',
                'match',
                'pattern' => '/^[АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя A-Za-z-]{2,50}$/',
                'message' => 'Ошибка'
            ],
            ['name, email',
                'length',
                'max' => 150,
                'message' => 'Ошибка'
            ],
            ['theme, text',
                'length',
                'max' => 250,
                'message' => 'Ошибка'
            ],
            ['email',
                'email',
                'message' => 'Ошибка'
            ],
            [
                'verifyCode',
                'yupe\components\validators\YRequiredValidator',
                'allowEmpty' => !$module->showCaptcha || Yii::app()->user->isAuthenticated()
            ],
            [
                'verifyCode',
                'captcha',
                'allowEmpty' => !$module->showCaptcha || Yii::app()->user->isAuthenticated()
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'       => Yii::t('FeedbackModule.feedback', 'Your name'),
            'email'      => Yii::t('FeedbackModule.feedback', 'Email'),
            'phone'      => Yii::t('FeedbackModule.feedback', 'Contact phone'),
            'theme'      => Yii::t('FeedbackModule.feedback', 'Topic'),
            'text'       => Yii::t('FeedbackModule.feedback', 'Convenient time to call'),
            'verifyCode' => Yii::t('FeedbackModule.feedback', 'Check code'),
            'type'       => Yii::t('FeedbackModule.feedback', 'Type'),
        ];
    }

    /**
     * Список возможных типов:
     *
     * @return array
     */
    public function getTypeList()
    {
        $types = Yii::app()->getModule('feedback')->types;

        if ($types) {
            $types[FeedBack::TYPE_DEFAULT] = Yii::t('FeedbackModule.feedback', 'Default');
        } else {
            $types = [FeedBack::TYPE_DEFAULT => Yii::t('FeedbackModule.feedback', 'Default')];
        }

        return $types;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getModelName()
    {
        return __CLASS__;
    }
}
