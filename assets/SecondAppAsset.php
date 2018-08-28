<?php
/**
 * Created by PhpStorm.
 * User: Aleks
 * Date: 21.08.2018
 * Time: 10:17
 */

namespace app\assets;

use yii\web\AssetBundle;


class SecondAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/html5shiv.js',
        'js/respond.min.js',
    ];

    public $jsOptions = [
        'condition' => 'lte IE9',
        'position' => \yii\web\View::POS_HEAD,
    ];
}
