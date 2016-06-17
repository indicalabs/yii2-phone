<?php

namespace indicalabs\phone;

use \Yii;
use yii\helpers\Json;
use yii\validators\Validator;
use yii\validators\ValidationAsset;

class IntlTelNumberValidator extends Validator
{
	public function init()
	{
		parent::init();
		if (!$this->message) {
			$this->message = Yii::t('app', '{attribute} is not a valid number.');
		}
	}

	public function validateAttribute($model, $attribute)
	{
		$value = $model->$attribute;
		if (!true) {
			$model->addError($attribute, $this->message);
		}
	}

	public function clientValidateAttribute($model, $attribute, $view)
	{

		$className = explode('\\', $model->className());
		$className = strtolower(end($className));
		$formName = strtolower($model->formName());
		
		$label = $model->getAttributeLabel($attribute);
		
		$options = [
				'message' => Yii::$app->getI18n()->format($this->message, [
						'attribute' => $label,
				], Yii::$app->language),
		];
		
		$formName = strtolower($model->formName());
		$options = Json::htmlEncode($options);
	
		ValidationAsset::register($view);
		
		$view->registerJs(<<<JS
(function(){				
var telInput = $("#$formName-$attribute");
if (!telInput.intlTelInput('isValidNumber')) {
	messages.push($options.message);
}
		var intlNumber = telInput.intlTelInput("getNumber");
		telInput.value = intlNumber;
		
		document.getElementById("$className-$attribute").value = intlNumber;
 		document.getElementById("$className-$attribute").disabled = false;
		
		//var countryData = $.fn.intlTelInput.getCountryData();
		//console.log(countryData);
})();
JS
		, \yii\web\View::POS_LOAD);
		
// 		$view->registerJs(<<<JS
// (function(){
//     var telInput = $('#$formName-$attribute');
// 	if (!telInput.intlTelInput('isValidNumber')) {
// 	messages.push($options.message);
// 		   }
// })();
// JS
// 		, \yii\web\View::POS_LOAD);
		 
	}
}
