<?php
return array(
    'default' => array(
        'Medias' => array(
            'alternate_sizes' => array(
                'max' => '2600',
                'thumbnail' => '200',
                'mobile' => '360',
                's' => '800',
                'l' => '1200',
                'xl' => '1920'
            )
        ),
        'Database_Settings' => array(
	           'prepare_serialize_data' => 'base64_encode',
               'decode_serialize_data' => 'base64_decode',
        ),
    )
);