<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 
 * @license http://www.yiiframework.com/license/
 */

namespace indicalabs\phone;

/**
 * @author Venu Narukulla
 * @since 2.0
 */
class IntTelAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@bower/intl-tel-input';
	public $js = [
		'build/js/intlTelInput.min.js',
			'js/isValidNumber.js',
	];
	public $css = [
			'build/css/intlTelInput.css'
	];

	public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
	];
}
