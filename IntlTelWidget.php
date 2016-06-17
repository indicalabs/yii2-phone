<?php

namespace indicalabs\phone;

use yii\widgets\InputWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class IntlTelWidget
 
 * Usage:
 * <?= $form->field($model, 'mobile_number')->widget(indicalabs\phone\IntlTelWidget::className(),[
 *												'clientOptions' => [
 *															'initialCountry' => 'in',
 *														]		
 *											]);  ?>
 *
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

    	$id=$this->getId();
    	if (isset($this->clientOptions['id']))
    		$id = $this->clientOptions['id'];
    		else
    			$this->clientOptions['id']=$id;
    			
    	$this->clientOptions = ArrayHelper::merge([
    				'class' => 'form-control',
    				'defaultCountry'     => 'auto',
    				'numberType'         => 'MOBILE', //FIXED_LINE
    				//'separateDialCode' => 'true',
    				'autoHideDialCode' => 'true',
    				'nationalMode' => false,
    			'dropdownContainer' => 'body',
    				'preferredCountries' => ['in', 'us','gb'],
	    			//'responsiveDropdown' => true,
    		], $this->clientOptions);
    	
    	$this->options = ArrayHelper::merge($this->options,$this->clientOptions);
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
    	$js = "jQuery('#".$id."').intlTelInput($options);";
    	$view->registerJs($js);
    	
    }
}
