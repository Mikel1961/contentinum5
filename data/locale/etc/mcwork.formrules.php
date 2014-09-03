<?php
return array(
    'fieldtypes' => array(
        'typescope' => array(
            'monitor' => array(
                'condtions' => array(
                    'validator' => 'lenght',
                    'value' => 3,
                    'operator' => '>'
                ),
                'success' => 'ok',
                'error' => 'nok',
                'remote' => '/mcwork/medias/application/entryexists',
                'messages' => array(
                    'success' => 'entryexists',
                    'error' => 'entrynoexists'
                ),
                'datas' => array(
                    'entity' => 'Contentinum\Entity\FieldTypes',
                    'field' => 'typescope',
                    'value' => false,
                    'exclude' => false
                )
            )
        )
        
    )
    
);