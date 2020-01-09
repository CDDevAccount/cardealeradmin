<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */

$this->title = 'Dealer Map';
$this->params['breadcrumbs'][] = ['label' => 'Dealers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid" >
    <h1><?= Html::encode($this->title) ?></h1>
	<?php echo $map->display(); ?>


</div>


