<?php
/**
 * Created by PhpStorm.
 * User: Aleks
 * Date: 25.08.2018
 * Time: 15:14
 */

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

class ProductController extends Controller
{
    public function actionIndex(){
        $query = Product::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6,
            'forcePageParam' => false,
            'pageSizeParam' => false]);
        $products = $query->asArray()->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', compact('products','pages'));
    }

    public function actionView($id){
        $product = Product::findOne($id);
        if(empty($product))
            throw new HttpException('404', 'Данного продукта не существует');
        $hitProduct = Product::find()->asArray()->where(['hit' => '1'])->limit(6)->all();
        return $this->render('view', compact('product', 'hitProduct'));
    }
}