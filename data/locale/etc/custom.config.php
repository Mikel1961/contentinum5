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
            ),
            'images_types' => array(
                'image/gif' => true,
                'image/jpeg' => true,
                'image/png' => true,
                'application/x-shockwave-flash' => null,
                'image/psd' => null,
                'image/bmp' => null,
                'image/tiff' => null,
                'image/jp2' => null,
                'image/iff' => null,
                'image/vnd.wap.wbmp' => null,
                'image/xbm' => null,
                'image/x-icon' => null,
                'image/vnd.microsoft.icon' => null
            )
            
        )
        ,
        'Database_Settings' => array(
            'prepare_serialize_data' => 'base64_encode',
            'decode_serialize_data' => 'base64_decode'
        )
    )
);