<?php
return array(
    'default' => array(
        'Host' => array(

            'public_folder' => 'public',
            'denied_folder' => 'data',
            'public_directory_path' => 'public/medias/',
            'denied_directory_path' => 'data/files/',

        ),
        'Medias' => array(
            'max_filesize' => 50,
            'alternate_size_folder' => '_alternate',
            'media_attribute_fields' => array(
                'images' => array(
                    'alt',
                    'title',
                    'caption',
                    'description',
                    'longdescription'
                ),
                'files' => array(
                    'description',
                    'linkname',
                    'headline'
                )
            ),
            'alternate_sizes' => array(
                'max' => '1440',
                'thumbnail' => '200',
                'mobile' => '480',
                'std' => '516',
                'l' => '1024',
            ),
            'file_icons' => array(
                     'file' => 'fa-file-o',
                     'archive' => 'fa-file-archive-o',
                     'audio' => 'fa-file-audio-o',
                     'code' => 'fa-file-code-o',
                     'excel' => 'fa-file-excel-o',
                     'image' => 'fa-file-image-o',
                     'pdf' => 'fa-file-pdf-o', 
                     'powerpoint' => 'fa-file-powerpoint-o',
                     'text' => 'fa-file-text-o',
                     'video' => 'fa-file-video-o',
                     'word' => 'fa-file-word-o',
                     'file_bg' => 'fa-file',
                     'text_bg' => 'fa-file-text',
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
            ),
            'allowed_uploads' => array(
                'bmp' => null,
                'csv' => null,
                'doc' => null,
                'epg' => null,
                'gif' => true,
                'ico' => true,
                'jpg' => true,
                'jpeg' => true,
                'JPG' => true,
                'odg' => null,
                'odp' => null,
                'ods' => null,
                'odt' => null,
                'pdf' => true,
                'png' => true,
                'ppt' => null,
                'swf' => null,
                'txt' => null,
                'xcf' => null,
                'xls' => null,
                'mp3' => true,
                'mp4' => true,
                'htm' => null,
                'html' => null,
                'flv' => null,
                'D83' => null,
                'P83' => null,
                'X83' => null,
                'd83' => null,
                'p83' => null,
                'x83' => null,
                'p81' => null,
                'P81' => null
            )
        )
        
    )
);