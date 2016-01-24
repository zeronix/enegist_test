<?php
	/**
	 * @var $this	ProfileController
	 * @var $model	Profile[]
	 */
?>
<h2 class="page-header">
	<?= Yii::t('profile', 'รายชื่อสมาชิก') ?>
	<a href="<?= $this->createUrl('admin') ?>" class="btn btn-primary pull-right">
		+ <i class="glyphicon glyphicon-user"></i>
		เพิ่มลูกค้า
	</a>
	<a href="<?= $this->createUrl('export') ?>" class="btn btn-success" target="_blank">
		<i class="glyphicon glyphicon-list-alt"></i>
		<i class="glyphicon glyphicon-user"></i>
		Export ข้อมูลลูกค้า (JSON)
	</a>
</h2>
<table class="table table-responsive table-bordered table-striped">
	<thead>
		<tr>
			<th width="5%"><?= Yii::t('profile', '#') ?></th>
			<th width="35%"><?= Yii::t('profile', 'ชื่อ-นามสกุล') ?></th>
			<th width="45%"><?= Yii::t('profile', 'ที่อยู่') ?></th>
			<th width="15%"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($model as $row=>$item) { $home = $item->addresses[0]; $work = $item->addresses[1]; ?>
			<tr>
				<td align="right"><?= $row+1 ?></td>
				<td>
					<a href="<?= $this->createUrl('admin', array('id'=>$item->id)) ?>">
						<?= "$item->first_name $item->last_name" ?>
					</a>
				</td>
				<td>
					<!-- Home -->
					<p>
						<i class="glyphicon glyphicon-home"></i> <?= "{$home->address1} {$home->city} {$home->country} {$home->zip_code}" ?>
					</p>
					<!-- Work -->
					<p>
						<i class="glyphicon glyphicon-briefcase"></i> <?= "{$work->address1} {$work->city} {$work->country} {$work->zip_code}" ?>
					</p>
				</td>
				<td align="center">
					<a class="btn btn-block btn-warning" href="<?= $this->createUrl('admin', array('id'=>$item->id)) ?>">
						<i class="glyphicon glyphicon-pencil"></i>
						แก้ไข
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
