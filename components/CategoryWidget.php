<?php

namespace app\components;

use yii\base\Widget;
use app\models\Category;
use Yii;

class CategoryWidget extends Widget
{
    public $template;
    public $data;
    public $tree;
    public $menuHTML;
    public function init()
    {
        parent::init();
        if($this->template == NULL)
            $this->template = 'menu';
        $this->template .= '.php';
    }

    public function run(){
        // get Cache
        $menu = Yii::$app->cache->get('menuCategory');
        if ($menu) return $menu;

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHTML = $this->getMenuHtml($this->tree);
        //set Cache
        Yii::$app->cache->set('menuCategory', $this->menuHTML, 60);

        return $this->menuHTML;
    }

    protected function  getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node){
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }
    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category)
            $str .= $this->catToTemplate($category);
        return $str;
    }
    protected function catToTemplate($category){
        ob_start();
        include __DIR__ . '/menu_template/' . $this->template;
        return ob_get_clean();
    }
}