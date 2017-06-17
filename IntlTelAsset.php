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
	public $sourcePath = '@npm/intl-tel-input';
	
	public $js = [
			'build/js/utils.js',
 			'build/js/intlTelInput.min.js',
//			'build/js/intlTelInput.js',
	];
	
	public $css = [
			'build/css/intlTelInput.css',
	];
	public $img = [
			'build/img/flags.png',
	];
	public $depends = [
			'yii\web\JqueryAsset',
	];
}
