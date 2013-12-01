<?php
return array (
		'attribute' => array (
				'class' => 'toolbar-right' 
		),
		'standards' => array (
				'add' => array (
						'label' => '<i class="fa fa-plus"></i>',
						'href' => '#',
						'attribs' => array (
								'title' => 'Add a new item',
								'class' => 'button',
								'role' => 'button' 
						) 
				),
				'edit' => array (
						'label' => '<i class="fa fa-pencil"></i>',
						'href' => '#',
						'attribs' => array (
								'title' => 'Choose a row from table editing them',
								'class' => 'button',
								'id' => 'btnTblEdit',
								'role' => 'button' 
						) 
				),
				'delete' => array (
						'label' => '<i class="fa fa-trash-o"></i>',
						'href' => '#',
						'attribs' => array (
								'title' => 'choose a row from table delete them',
								'class' => 'button',
								'id' => 'btnTblDelete',
								'role' => 'button' 
						) 
				),
				
				//<p class="right"><a class="small button alert" href="/mcwork/cache/clear/all" title="Empty all cache storage">Clear all</a></p>
				'clear' => array (
						'label' => 'Clear all',
						'href' => '#',
						'attribs' => array (
								'title' => 'clear allcache items',
								'class' => 'button alert',
								'role' => 'button'
						)
				)				
				
				
		)	 
);