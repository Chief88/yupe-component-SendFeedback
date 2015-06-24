<?php

class ModalFormWidget extends \yupe\widgets\YWidget
{
    public $view = 'Feedback';
    public $type = 'button';
    public $model;
    public $module;
    public $params = [];

    public function run()
    {
        $this->render(
            $this->view,
            [
                'module' => $this->module,
                'model' => $this->model,
                'type' => $this->type,
                'params' => $this->params,
            ]
        );
    }
}
