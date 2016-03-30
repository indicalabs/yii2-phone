<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 
 * @license http://www.yiiframework.com/license/
 */

namespace indicalabs\phone;

use yii\web\AssetBundle;

/**
 * @author Venu Narukulla
 * @since 2.0
 */
class IntlTelAsset extends AssetBundle
{
	public $sourcePath = '@bower/intl-tel-input';
	
	public $js = [
			'build/js/utils.js',
			'build/js/intlTelInput.min.js',
	];
	
	public $css = [
			'build/css/intlTelInput.css',
	];

	public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
	];
}
