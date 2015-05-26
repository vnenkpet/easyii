<?php
use webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
]); ?>
<?= $form->field($model, 'title')->widget(MultiLanguageActiveField::className()) ?>

<?php $sid = uniqid() ?>

    <ul class="nav nav-tabs" role="tablist">
        <?php foreach ($model->mlConfig['languages'] as $languageCode => $languageName): ?>

            <li class="<?= (Yii::$app->language == $languageCode) ? 'active' : '' ?>">
                <a href="#<?= $sid . $languageCode ?>" role="tab" data-toggle="tab">
                    <?= $languageName ?>
                </a>
            </li>
        <?php endforeach ?>

    </ul>

    <div class="tab-content">

        <?php foreach ($model->mlConfig['languages'] as $languageCode => $languageName): ?>

            <?php
            $attribute = 'text';

            if ( $languageCode != $model->mlConfig['default_language'] )
            {
                $attribute .= '_' . $languageCode;
            }

            $activeClass = (Yii::$app->language == $languageCode) ? 'active' : '';
            ?>


            <div class="tab-pane <?= $activeClass ?>" id="<?= $sid . $languageCode ?>">

                <?= $form->field($model, $attribute)->widget(Redactor::className(), [
                    'options' => [
                        'minHeight' => 400,
                        'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'pages']),
                        'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'pages']),
                        'plugins' => ['fullscreen']
                    ]
                ]) ?>
            </div>


        <?php endforeach ?>
    </div>


<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('easyii','Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>