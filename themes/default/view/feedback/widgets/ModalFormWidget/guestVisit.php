<?php if($type == 'button'):{ ?>

    <?php $htmlOptions = [
        'href'          => 'javascript:;',
        'data-toggle'   => 'modal',
        'data-target'   => '#guestModal'
    ];
    if( isset($params['linkParams']['htmlOptions']) && !empty($params['linkParams']['htmlOptions']) ){
        $htmlOptions = array_merge($htmlOptions, $params['linkParams']['htmlOptions']) ;
    }

    $htmlOptionsString = '';
    foreach($htmlOptions as $key => $option ){
        $htmlOptionsString .= $key.'=\''.$option.'\' ';
    } ?>

    <a <?= $htmlOptionsString; ?>>Записаться</a>

<?php }endif; ?>

<?php if($type == 'modal'):{ ?>

    <div class="modal fade" id="guestModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <?php $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    [
                        'id'                        => 'guestVisit-form',
                        'type'                      => 'vertical',
                        'enableAjaxValidation'      => false,
                        'enableClientValidation'    => true,
                        'clientOptions'             =>[
                            'validateOnSubmit' => true,
                            'validateOnChange' => true,
                        ],
                        'htmlOptions'               => [
                            'class' => 'guestVisit-form',
                        ],

                    ]
                ); ?>
                    <div class="modal-header">
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Гостевой визит</h4>
                    </div>
                    <div class="modal-body">

                        <?= $form->textFieldGroup($model, 'name', [
                            'label' => 'ФИО',
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'placeholder' => false,
                                ]
                            ],
                        ]); ?>

                        <?= $form->textFieldGroup($model, 'phone', [
                            'label' => 'Телефон',
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'placeholder' => false,
                                ]
                            ],
                        ]); ?>

                        <?= $form->textFieldGroup($model, 'email', [
                            'label' => 'E-mail',
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'placeholder' => false,
                                ]
                            ],
                        ]); ?>

                        <?= $form->textAreaGroup($model, 'text', [
                            'label' => 'Комментарий',
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
                                'label'         => 'Отправить',
                                'ajaxOptions' => [
                                    'success'=>'function(data) {
                                            if(typeof(data) == "string"){
                                                data = JSON.parse(data);
                                            }
                                            var flashMessageObj = $("#flashMessage");
                                            var modalWindowObj = $("#guestModal");
                                            var formControlObj = $("#guestVisit-form .form-control");

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
                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>

<?php }endif; ?>