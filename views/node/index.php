<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 19.09.16
 * Time: 21:18
 */
use kartik\tree\TreeView;
use app\models\Node;

?>
<?=
TreeView::widget([
    // single query fetch to render the tree
    // use the Product model you have in the previous step
    'query' => Node::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => 'Categories'],
    'fontAwesome' => false,     // optional
    'isAdmin' => false,         // optional (toggle to enable admin mode)
    'displayValue' => 1,        // initial display value
    'softDelete' => true,       // defaults to true
    'cacheSettings' => [
        'enableCache' => true   // defaults to true
    ]
]);
?>
