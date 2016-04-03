<?php

namespace indicalabs\phone;

use yii\widgets\InputWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class IntlTelWidget
 
 *
 * @author Venu Narukulla <venu.narukulla@gmail.com>
 * @link 
 * @date 09/12/2013
 * @time 09:00am
 * @see https://github.com/twitter/typeahead.js
 */
class IntlTelWidget extends InputWidget
{
	
	public $options = [];
	public $clientOptions = [];
	
    public function init()
    {
    	parent::init();
    
    	$this->options = ArrayHelper::merge([
    				'class' => 'form-control'
    		], $this->options);
    		
    	$this->clientOptions = ArrayHelper::merge([
    				'defaultCountry'     => 'auto',
    				'numberType'         => 'MOBILE',
    				'preferredCountries' => ['in', 'us','uk'],
    				'responsiveDropdown' => true,
    		], $this->clientOptions);
    }
    
    public function run()
    {
    	$this->registerPlugin('intlTelInput');
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }

    /**
     * Registers MultiSelect Bootstrap plugin and the related events
     */
    protected function registerPlugin()
    {
    	$view = $this->getView();
    	IntlTelAsset::register($view);
    	$id = $this->options['id'];
    	$options = $this->clientOptions !== false && !empty($this->clientOptions)
    	? Json::encode($this->clientOptions)
    	: '';
    	$js = "jQuery('#$id').intlTelInput($options);";
    	$view->registerJs($js);
    }
}
