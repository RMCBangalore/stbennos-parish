<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('ecalendarview', dirname(__FILE__) . '/../extensions/ecalendarview');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'St. Benno\'s Parish',
/*	'theme'=>'indigo',*/

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
/*		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'passw0rd',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),*/
		'rights'=>array(
			'install'=>true,
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'RWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=> require(dirname(__FILE__).DIRECTORY_SEPARATOR.'dbconf.php'),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace',
					'categories'=>'system.*, application.*',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=> CMap::mergeArray(
		array(
			// this is used in contact page
			'adminEmail'=>'webmaster@example.com',
			'photoManip' => extension_loaded('gd'),
			'iconMenu' => array(
				array(
					'title' => 'Parish Profile',
					'url' => array('site/parishProfile'),
					'icon' => '/images/icons/parish profile-new.png',
					'role' => 'Pastor',
				),
				array(
					'title' => 'View Families',
					'url' => array('family/index'),
					'icon' => '/images/icons/view family.png',
#					'role' => '!Pastor',
				),
				array(
					'title' => 'Manage Families',
					'url' => array('family/admin'),
					'icon' => '/images/icons/manage famil.png',
					'role' => 'Staff',
				),
				array(
					'title' => 'Mass Bookings',
					'url' => array('massBooking/index'),
					'icon' => '/images/icons/mass booking.png',
					'role' => 'Staff',
				),
				array(
					'title' => 'Family Subscriptions',
					'url' => array('/subscription/index'),
					'icon' => '/images/icons/family subscription.png',
					'role' => 'Staff',
				),
				array(
					'title' => 'Parish Registers',
					'url' => array('site/page', array('view' => 'registers')),
					'icon' => '/images/icons/parish register1.png',
					'role' => 'Staff',
				),
				array(
					'title' => 'Certificates',
					'url' => array('site/page', array('view' => 'certificates')),
					'icon' => '/images/icons/certificate archives.png',
					'role' => 'Staff',
				)
			)
		),
		require(dirname(__FILE__).DIRECTORY_SEPARATOR.'params.php')
	),
);
