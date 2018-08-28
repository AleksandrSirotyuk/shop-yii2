<?php
/**
 * Created by PhpStorm.
 * User: Aleks
 * Date: 24.08.2018
 * Time: 13:53
 */

namespace app\controllers;

use app\models\Product;
use Yii;
use app\models\Category;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\HttpException;


class CategoryController extends Controller
{
    public function actionView($id){
        $category = Category::findOne($id);
        if (empty($category))
            throw new HttpException('404', 'Данной категории не существует');
        $query = Product::find()->where(['category_id' => $category['id']]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2,
            'forcePageParam' => false,
            'pageSizeParam' => false]);
        $productByCategoryId = $query->asArray()->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('view', compact('productByCategoryId','category', 'pages'));
    }
}