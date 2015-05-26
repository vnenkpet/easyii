<?php
namespace yii\easyii\components;

use Yii;
use yii\helpers\Url;

/**
 * Base API class
 * @package yii\easyii\components
 */
class API extends \yii\base\Object
{
    static $classes;
    public $module;

    public function init()
    {
        parent::init();

        $this->module = Module::getModuleName(self::className());
        Module::registerTranslations($this->module);
    }

    public static function __callStatic($method, $params)
    {
        $name = (new \ReflectionClass(self::className()))->getShortName();
        if (!isset(self::$classes[$name])) {
            self::$classes[$name] = new static();
        }
        return call_user_func_array([self::$classes[$name], 'api_' . $method], $params);
    }

    /**
     * Wraps element into a live edit div
     *
     * @param $text
     * @param $path
     * @param string $tag
     * @param null $pk
     * @return string
     */
    public function wrapLiveEdit($text, $path, $tag = 'span', $pk = null)
    {
        return '<'.$tag.' class="easyiicms-edit" data-edit="'. Url::to(["/admin/$this->module/$path"]) . '">'.$text.'</'.$tag.'>';
    }

    public function  errorText($text)
    {
        return '<span style="background: #ff0000; color: #ffffff">'.$text.'</span>';
    }
}
