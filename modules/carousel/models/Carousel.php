<?php
namespace yii\easyii\modules\carousel\models;

use webvimark\behaviors\multilanguage\MultiLanguageBehavior;
use webvimark\behaviors\multilanguage\MultiLanguageTrait;
use Yii;
use yii\easyii\behaviors\CacheFlush;
use yii\easyii\behaviors\SortableModel;

class Carousel extends \yii\easyii\components\ActiveRecord
{
    use MultiLanguageTrait;

    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    const CACHE_KEY = 'easyii_carousel';

    public static function tableName()
    {
        return 'easyii_carousel';
    }

    public function rules()
    {
        return [
            ['image', 'image'],
            [['title', 'text'], 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image' => Yii::t('easyii', 'Image'),
            'title' => Yii::t('easyii', 'Title'),
            'text' => Yii::t('easyii', 'Text'),
        ];
    }

    public function behaviors()
    {
        return [
            CacheFlush::className(),
            SortableModel::className(),
            'mlBehavior'=>[
                'class'    => MultiLanguageBehavior::className(),
                'mlConfig' => [
                    'db_table'         => 'translations_with_string',
                    'attributes'       => ['title', 'text'],
                    'admin_routes'     => [
                        'admin/carousel/a/edit',
                        'admin/carousel/a/create'
                    ],
                ],
            ]
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$this->isNewRecord && $this->image != $this->oldAttributes['image']){
                @unlink(Yii::getAlias('@webroot').$this->oldAttributes['image']);
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        @unlink(Yii::getAlias('@webroot').$this->image);
    }
}