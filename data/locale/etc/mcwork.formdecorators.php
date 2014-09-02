<?php
return array(
    'default' => array(
        'deco-form' => array(
            'form-attributtes' => array(
                'id' => 'mcworkForm',
                //'data-abide' => 'data-abide'
            )
        ),
        'deco-row' => array(
            'tags' => array(
                '1' => array(
                    'tag' => 'div',
                    'attributes' => array(
                        'class' => 'row'
                    )
                ),
                '2' => array(
                    'tag' => 'div',
                    'attributes' => array(
                        'class' => 'large-12 columns'
                    )
                )
            )
        ),
        'deco-tab-row' => array(
            'tags' => array(
                '1' => array(
                    'tag' => 'p'
                )
            )
        ),
        'deco-element-row' => array(
            'tag' => 'p',
            'attributes' => array(
                'class' => 'formElement'
            )
        ),        
        'deco-desc' => array(
            'tag' => 'span',
            'attributes' => array(
                'class' => 'desc'
            )
        ),
        'deco-error' => array(
            'tag' => 'small',
            'separator' => '<br />',
            'attributes' => array(
                'class' => 'error',
                'role' => 'alert'
            )
        ),
        'deco-abort-btn' => array(
            'label' => 'Cancel',
            'attributes' => array(
                'class' => 'button secondary small',
                'id' => 'btnFormCancel'
            )
        )
    )
);