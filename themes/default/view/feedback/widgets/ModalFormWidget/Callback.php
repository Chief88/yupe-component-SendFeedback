<?php if($type == 'button'):{ ?>

    <?php $htmlOptions = [
        'href'          => 'javascript:;',
        'data-toggle'   => 'modal',
        'data-target'   => '#callback-modal'
    ];
    if( isset($params['linkParams']['htmlOptions']) && !empty($params['linkParams']['htmlOptions']) ){
        $htmlOptions = array_merge($htmlOptions, $params['linkParams']['htmlOptions']) ;
    }

    $htmlOptionsString = '';
    foreach($htmlOptions as $key => $option ){
        $htmlOptionsString .= $key.'=\''.$option.'\' ';
    } ?>

    <a <?= $htmlOptionsString; ?>>Заказать звонок</a>

<?php }endif; ?>

<?php if($type == 'modal'):{ ?>
    <div class="modal fade" id="callback-modal">
        <div class="modal-dialog">

            <?php $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm',
                [
                    'id'                        => 'callback-form',
                    'type'                      => 'vertical',
                    'enableAjaxValidation'      => false,
                    'enableClientValidation'    => true,
                    'clientOptions'             =>[
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                    ],
                    'htmlOptions'               => [
                        'class' => 'callback-form',
                    ],

                ]
            ); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Заказать звонок</h4>
                </div>

                <div class="modal-body">

                    <?= $form->textFieldGroup($model, 'name', [
                        'label' => 'Ваше имя',
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'placeholder' => false,
                            ]
                        ],
                    ]); ?>

                    <?= $form->hiddenField($model, 'email', [
                        'value' => 'no-email@no-email.no'
                    ]); ?>

                    <?= $form->textFieldGroup($model, 'phone', [
                        'label' => 'Ваш телефон',
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'placeholder' => false,
                            ]
                        ],
                    ]); ?>

                    <?= $form->textAreaGroup($model, 'text', [
                        'label' => 'Сообщение',
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'placeholder' => false,
                            ]
                        ],
                    ]); ?>

                </div>

                <div class="modal-footer">
                    <?php $this->widget(
                        'bootstrap.widgets.TbButton',
                        [
                            'buttonType'    => 'ajaxSubmit',
                            'htmlOptions' => [
                                'class' => 'btn-primary'
                            ],
                            'context'       => false,
                            'label'         => 'Заказать',
                            'ajaxOptions' => [
                                'success'=>'function(data) {
                                            if(typeof(data) == "string"){
                                                data = JSON.parse(data);
                                            }
                                            var flashMessageObj = $("#flashMessage");
                                            var modalWindowObj = $("#callback-modal");
                                            var formControlObj = $("#callback-form .form-control");

                                            $(".has-error").removeClass("has-error");
                                            $(".help-block").hide();
                                            if (data.result) {
                                                modalWindowObj.modal("hide");
                                                flashMessageObj.removeClass("bounceInLeft");
                                                flashMessageObj.html("<div class=\'alert in fade alert-success\'>" + data.data + "</div>")
                                                showFlashMessage();
                                                formControlObj.val("");
                                            }else{
                                                for (var id in data) {
                                                    var errorMessage = data[id][0];
                                                    $("#" + id).parent().addClass("has-error");
                                                    $("#" + id + "_em_").html(errorMessage).show();
                                                }
                                            }
                                        }',
                            ]
                        ]
                    ); ?>
                </div>
            </div><!-- /.modal-content -->

            <?php $this->endWidget(); ?>

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php }endif; ?>