<?php
	/**
	 * @var    $this        BookController
	 * @var    $model       Book
	 * @var    $alerts      []
	 */
	if ($model->id) {
		$header = Yii::t('book', 'Edit') . ": {$model->title} | {$model->author}";
	} else {
		$header = Yii::t('book', 'Add Book');
	}
	$this->breadcrumbs[] = $header;
	if ($alerts) {
		foreach ($alerts as $type => $table) {
			echo "<div class='alert alert-$type'><ul>";
			if ($table) {
				foreach ($table as $attributes) {
					if (is_array($attributes)) {
						foreach ($attributes as $attribute => $message) {
							$msg = implode(', ', $message);
							echo "<li>$msg</li>";
						}
					} else {
						echo "<li>$attributes</li>";
					}
				}
			}
			echo "</ul></div>";
		}
	}
?>
	<h2 class="page-header">
		<?= $header ?>
	</h2>
	<!-- Book -->
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'book-form', 'method' => 'post', 'htmlOptions' => array('class' => 'form-horizontal'))) ?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title"><?= Yii::t('book', 'Book') ?></h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label col-md-2"><?= $model->getAttributeLabel('title') ?></label>
				<div class="col-md-4">
					<?= CHtml::activeTextField($model, 'title', array('class' => 'form-control')) ?>
				</div>
				<label class="control-label col-md-2"><?= $model->getAttributeLabel('author') ?></label>
				<div class="col-md-4">
					<?= CHtml::activeTextField($model, 'author', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 text-center">
			<button type="submit" name="save" value="Save" class="btn btn-success btn-lg btn-block">
				<i class="glyphicon glyphicon-floppy-save"></i>
				บันทึก
			</button>
		</div>
		<div class="col-md-6 text-center">
			<button type="submit" name="save" value="SaveAndNew" class="btn btn-primary btn-lg btn-block">
				<i class="glyphicon glyphicon-floppy-save"></i>
				<i class="glyphicon glyphicon-new-window"></i>
				บันทึกและสร้างใหม่
			</button>
		</div>
	</div>
<?php $this->endWidget() ?>