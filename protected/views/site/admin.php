<?php
	/**
	 * @var    $this         SiteController
	 * @var    $model        Borrow
	 * @var    $profiles     Profile[]
	 * @var    $books        Book[]
	 * @var    $alerts       []
	 */
	if ($model->id) {
		$header = Yii::t('borrow', 'แก้ไขการยืม') . ": {$model->profile->first_name} {$model->profile->last_name}";
	} else {
		$header = Yii::t('borrow', 'ยืมหนังสือ');
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
	<!-- Borrowing -->
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'borrow-form', 'method' => 'post', 'htmlOptions' => array('class' => 'form-horizontal'))) ?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title"><?= Yii::t('borrow', 'แบบการยืมหนังสือ') ?></h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label col-md-2"><?= $model->getAttributeLabel('profile_id') ?></label>
				<div class="col-md-4">
					<?= CHtml::activeDropDownList($model, 'profile_id', CHtml::listData($profiles, 'id', 'Name'), array('class' => 'form-control')) ?>
				</div>
				<label class="control-label col-md-2"><?= $model->getAttributeLabel('book_id') ?></label>
				<div class="col-md-4">
					<?= CHtml::activeDropDownList($model, 'book_id', CHtml::listData($books, 'id', 'Book'), array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="clear"></div>

			<div class="form-group">
				<div class="col-md-offset-2 col-md-10">
					<div class="form-control-static text-danger">* หนังสือยืมได้ไม่เกิน 7 วัน</div>
				</div>
			</div>
			<div class="clear"></div>

			<div class="form-group check-out">
				<label class="control-label col-md-offset-4 col-md-2"><?= $model->generateAttributeLabel('check_out_date') ?></label>
				<div class="col-md-4">
					<div class="form-control-static"><?= date('j M Y') ?></div>
				</div>
			</div>
			<div class="clear"></div>

			<div class="form-group due-date">
				<label class="control-label col-md-offset-4 col-md-2"><?= $model->generateAttributeLabel('due_date') ?></label>
				<div class="col-md-4">
					<div class="form-control-static"><?= date('j M Y', strtotime('+7 day')) ?></div>
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