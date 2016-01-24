<?php
	/**
	 * @var $this     BookController
	 * @var $model    Book[]
	 */
?>
<h2 class="page-header">
	<?= Yii::t('book', 'รายชื่อหนังสือ') ?>
	<a href="<?= $this->createUrl('admin') ?>" class="btn btn-primary pull-right">
		+ <i class="glyphicon glyphicon-book"></i>
	</a>
</h2>
<table class="table table-responsive table-bordered table-striped">
	<thead>
		<tr>
			<th width="5%"><?= Yii::t('book', '#') ?></th>
			<th width="35%">
				<!--				<i class="glyphicon glyphicon-book"></i>--><? //= Yii::t('book', 'หนังสือ') ?><!-- และ-->
				<!--				<i class="glyphicon glyphicon-user"></i>--><? //= Yii::t('book', 'ผู้แต่ง') ?><!--</th>-->
				<?= Yii::t('book', 'หนังสือ และ ผู้แต่ง') ?>
			<th width="15%"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($model as $row => $item) { ?>
			<tr>
				<td align="right"><?= $row + 1 ?></td>
				<td>
					<a href="<?= $this->createUrl('admin', array('id' => $item->id)) ?>">
						<p>
							<i class="glyphicon glyphicon-book"></i>
							<?= $item->title ?>
						</p>
						<p>
							<i class="glyphicon glyphicon-user"></i>
							<?= $item->author ?>
						</p>
					</a>
				</td>
				<td align="center">
					<a class="btn btn-block btn-warning" href="<?= $this->createUrl('admin', array('id' => $item->id)) ?>">
						<i class="glyphicon glyphicon-pencil"></i>
						แก้ไข
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>