<?php if($type == 'button'):{ ?>
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#feedback-modal">Обратная связь</a>
<?php }endif; ?>

<?php if($type == 'modal'):{ ?>
    <!-- Modal -->
    <div class="modal fade"
         id="feedback-modal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="feedback"
         aria-hidden="true"
         data-backdrop=false>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalLabel" class="modal-title">Обратная связь</h4>
                    <a class="btn btn-primary clear" href="#feedback-form">Очистить</a>
                </div>
                <div class="modal-body">


                    <?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                        [
                            'id'                        => 'feedback-form',
                            'type'                      => 'vertical',
                            'enableAjaxValidation'      => false,
                            'enableClientValidation'    => true,
                            'clientOptions'             =>array(
                                'validateOnSubmit' => true,
                            ),
                            'htmlOptions'               => [
                                'class' => 'well',
                            ],

                        ]
                    ); ?>

                    <div class='row'>
                        <div class="col-sm-12">
                            <?php echo $form->textFieldGroup($model, 'name', [
                                'label' => false,
//                                'errorOptions' => false,
                                'widgetOptions' => [
                                    'htmlOptions' => [
                                        'placeholder' => 'Имя'
                                    ]
                                ],
                            ]); ?>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="col-sm-12">
                            <?php echo $form->textFieldGroup($model, 'email', [
                                'label' => false,
//                                'errorOptions' => false,
                                'widgetOptions' => [
                                  'htmlOptions' => [
                                      'type' => 'email',
                                      'placeholder' => 'E-mail'
                                  ]
                                ],
                            ]); ?>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="col-sm-12">
                            <?php echo $form->textFieldGroup($model, 'phone', [
                                'label' => false,
//                                'errorOptions' => false,
                                'widgetOptions' => [
                                    'htmlOptions' => [
                                        'type' => 'tel',
                                        'placeholder' => 'Телефон'
                                    ]
                                ],
                            ]); ?>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="col-sm-12">
                            <?php echo $form->textAreaGroup($model, 'text', [
                                'label' => false,
//                                'errorOptions' => false,
                                'widgetOptions' => [
                                    'htmlOptions' => [
                                        'placeholder' => 'Текст'
                                    ]
                                ],
                            ]); ?>
                        </div>
                    </div>

                    <div class="sepa-5"></div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <?php
                            $this->widget(
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

                                            $(".has-error").removeClass("has-error");
                                            $(".help-block.error").hide();

                                            if(data.result){

                                                $("#feedback-modal").modal("hide");

                                                $("#flashMessage").show().addClass("alert-success animated bounceInLeft").html(data.data);

                                                setTimeout(function(){
                                                    $("#flashMessage").addClass("bounceOutRight");
                                                    setTimeout(function(){
                                                        $("#flashMessage").removeClass("alert-success animated bounceInLeft bounceOutRight").hide();
                                                    }, 2000);
                                                }, 2000);

                                                $("#feedback-form .form-control").val("");

                                            }else{
                                               data = $.parseJSON(data);

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
                    </div>

                    <div class="sepa-5"></div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Отмена</button>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
<?php }endif; ?>