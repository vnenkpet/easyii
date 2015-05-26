<?php
use yii\helpers\Url;

$this->title = Yii::t('easyii/text', 'Texts');
?>

<?= $this->render('_menu') ?>

<?php if($data->count > 0) : ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="30">#</th>
                <th><?= Yii::t('easyii', 'Text') ?></th>
                <th><?= Yii::t('easyii', 'Slug') ?></th>
                <th width="30"></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($data->models as $item) : ?>
            <tr>
                <td><?= $item->primaryKey ?></td>
                <td><a href="<?= Url::to(['/admin/text/a/edit', 'id' => $item->primaryKey]) ?>"><?= $item->text ?></a></td>
                <td><?= $item->slug ?></td>
                <td><a href="<?= Url::to(['/admin/text/a/delete', 'id' => $item->primaryKey]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('easyii', 'Delete item') ?>"></a></td>
            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <?= yii\widgets\LinkPager::widget([
        'pagination' => $data->pagination
    ]) ?>
<?php else : ?>
    <p><?= Yii::t('easyii', 'No records found') ?></p>
<?php endif; ?>