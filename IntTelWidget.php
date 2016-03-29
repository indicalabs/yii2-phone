<?php

namespace indicalabs\phone;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;
/**
 * Class Phone
 
 *
 * @author Venu Narukulla <venu.narukulla@gmail.com>
 * @link 
 * @date 09/12/2013
 * @time 09:00am
 * @see https://github.com/twitter/typeahead.js
 */
class IntTelWidget extends \yii\widgets\InputWidget
{
	
	public $options = [];
	public $clientOptions = [];

	private $_assetBundle;
	
    public function init()
    {
    	parent::init();
    
//     	$id=$this->getId();
//     	if (isset($this->clientOptions['id']))
//     		$id = $this->clientOptions['id'];
//     	else
//     		$this->clientOptions['id']=$id;
    
    		$this->options = ArrayHelper::merge([
    				'class' => 'form-control'
    		], $this->options);
    		$this->clientOptions = ArrayHelper::merge([
    				'defaultCountry'     => 'auto',
    				'numberType'         => 'MOBILE',
    				'preferredCountries' => ['cn', 'us'],
    				'responsiveDropdown' => true,
    		], $this->clientOptions);
    		$this->registerAssetBundle();
    		$this->clientOptions['utilsScript'] = $this->_assetBundle->baseUrl . '/lib/libphonenumber/build/utils.js';
    		$this->registerScript();
    
    }
    
    public function run()
    {
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }

    public function registerScript()
    {
        $clientOptions = Json::encode($this->clientOptions);
        $js = <<<EOD
$('#{$this->options['id']}').intlTelInput({$clientOptions});
EOD;
        $this->getView()->registerJs($js);
    }
    
    public function registerAssetBundle()
    {
    	$this->_assetBundle = IntTelAsset::register($this->getView());
    }
    
    
    public function getAssetBundle()
    {
    	if (!($this->_assetBundle instanceof AssetBundle)) {
    		$this->registerAssetBundle();
    	}
    	return $this->_assetBundle;
    }
 
}



