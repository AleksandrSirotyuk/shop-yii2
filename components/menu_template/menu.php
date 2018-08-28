<li>
    <a href="<?= yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>">
        <?= $category['name'] ?>
        <?php if(isset($category['childs'])){
            echo '<span class="badge pull-right"><i class="fa fa-plus"></i></span>';
        } ?>
    </a>
    <?php if(isset($category['childs'])){ ?>
       <ul>
           <?= $this->getMenuHtml($category['childs']) ?>
       </ul>
    <?php } ?>
</li>

