<?php
	/**
	 * @var    $this        ProfileController
	 * @var    $model       Profile
	 * @var    $address     Address
	 * @var    $alerts      []
	 */
	if ($model->id) {
		$header = Yii::t('profile', 'แก้ไขข้อมูลลูกค้า') . ": {$model->first_name} {$model->last_name}";
	} else {
		$header = Yii::t('profile', 'เพิ่มลูกค้า');
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
	<!-- Profile -->
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'profile-form', 'method' => 'post', 'htmlOptions' => array('class' => 'form-horizontal'))) ?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title"><?= Yii::t('profile', 'Profile') ?></h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label col-md-2"><?= $model->getAttributeLabel('first_name') ?></label>
				<div class="col-md-4">
					<?= CHtml::activeTextField($model, 'first_name', array('class' => 'form-control')) ?>
				</div>
				<label class="control-label col-md-2"><?= $model->getAttributeLabel('last_name') ?></label>
				<div class="col-md-4">
					<?= CHtml::activeTextField($model, 'last_name', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<!-- Address: Home -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title"><?= Yii::t('profile', 'ที่อยู่') ?></h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label col-md-2"><?= $address->getAttributeLabel('address1') ?></label>
				<div class="col-md-10">
					<?= CHtml::textField('Address[address1][1]', $model->addresses ? $model->addresses[0]->address1 : '', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="clear"></div>

			<div class="form-group">
				<label class="control-label col-md-2"><?= $address->getAttributeLabel('address2') ?></label>
				<div class="col-md-10">
					<?= CHtml::textField('Address[address2][1]', $model->addresses ? $model->addresses[0]->address2 : '', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="clear"></div>

			<div class="form-group">
				<label class="control-label col-md-2"><?= $address->generateAttributeLabel('city') ?></label>
				<div class="col-md-2">
					<?= CHtml::textField('Address[city][1]', $model->addresses ? $model->addresses[0]->city : '', array('class' => 'form-control')) ?>
				</div>
				<label class="control-label col-md-2"><?= $address->generateAttributeLabel('country') ?></label>
				<div class="col-md-2">
					<?= CHtml::textField('Address[country][1]', $model->addresses ? $model->addresses[0]->country : '', array('class' => 'form-control')) ?>
				</div>
				<label class="control-label col-md-2"><?= $address->generateAttributeLabel('zip_code') ?></label>
				<div class="col-md-2">
					<?= CHtml::textField('Address[zip_code][1]', $model->addresses ? $model->addresses[0]->zip_code : '', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<!-- Address: Work -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title"><?= Yii::t('profile', 'ที่อยู่') ?></h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label col-md-2"><?= $address->getAttributeLabel('address1') ?></label>
				<div class="col-md-10">
					<?= CHtml::textField('Address[address1][2]', $model->addresses ? $model->addresses[1]->address1 : '', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="clear"></div>

			<div class="form-group">
				<label class="control-label col-md-2"><?= $address->getAttributeLabel('address2') ?></label>
				<div class="col-md-10">
					<?= CHtml::textField('Address[address2][2]', $model->addresses ? $model->addresses[1]->address2 : '', array('class' => 'form-control')) ?>
				</div>
			</div>
			<div class="clear"></div>

			<div class="form-group">
				<label class="control-label col-md-2"><?= $address->generateAttributeLabel('city') ?></label>
				<div class="col-md-2">
					<?= CHtml::textField('Address[city][2]', $model->addresses ? $model->addresses[1]->city : '', array('class' => 'form-control')) ?>
				</div>
				<label class="control-label col-md-2"><?= $address->generateAttributeLabel('country') ?></label>
				<div class="col-md-2">
					<?= CHtml::textField('Address[country][2]', $model->addresses ? $model->addresses[1]->country : '', array('class' => 'form-control')) ?>
				</div>
				<label class="control-label col-md-2"><?= $address->generateAttributeLabel('zip_code') ?></label>
				<div class="col-md-2">
					<?= CHtml::textField('Address[zip_code][2]', $model->addresses ? $model->addresses[1]->zip_code : '', array('class' => 'form-control')) ?>
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