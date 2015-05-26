<?php
use webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
<?= $form->field($model, 'text')->textarea()->widget(MultiLanguageActiveField::className(), ['inputType' => 'textArea']) ?>
<?= $form->field($model, 'slug') ?>
<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>