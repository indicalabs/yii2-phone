Yii2 extension for International phone validator
================================================
International telephone validator

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist indicalabs/yii2-phone "*"
```

or add

```
"indicalabs/yii2-phone": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= $form->field($model, 'mobile_number')->widget(indicalabs\phone\IntlTelWidget::className(),[
												'clientOptions' => [
															'initialCountry' => 'us',
														]		
											]);  ?>```