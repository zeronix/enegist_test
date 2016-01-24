<?php
	/**
	 * @var $this     SiteController
	 * @var $model    Borrow[]
	 */
?>
<h2 class="page-header">
	<?= Yii::t('site', 'รายชื่อเช่ายืม') ?>
	<a href="<?= $this->createUrl('admin') ?>" class="btn btn-danger pull-right">
		<i class="glyphicon glyphicon-user"></i>
		<i class="glyphicon glyphicon-transfer"></i>
		<i class="glyphicon glyphicon-book"></i>
		ยืม
	</a>
</h2>
<table class="table table-responsive table-bordered table-striped" style="table-layout: fixed;">
	<thead>
		<tr>
			<th width="5%"><?= Yii::t('site', '#') ?></th>
			<th width="30%"><?= Yii::t('site', 'ผู้ยืม') ?></th>
			<th width="25%"><?= Yii::t('site', 'หนังสือ') ?></th>
			<th width="10%"><?= Yii::t('site', 'กำหนดคืน') ?></th>
			<th width="10%"><?= Yii::t('site', 'วันที่คืน') ?></th>
			<th width="20%"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($model as $row => $item) { ?>
			<tr>
				<td align="right"><?= $row + 1 ?></td>
				<td><?= isset($item->profile) ? "{$item->profile->first_name} {$item->profile->last_name}" : '-' ?></td>
				<td><?= isset($item->book) ? "{$item->book->title} ({$item->book->author})" : '-' ?></td>
				<td align="center" style="color: blue"><?= date('j M Y', strtotime($item->due_date)) ?></td>
				<td align="center" style="color: <?= trim($item->return_date) !== '' && strtotime(date('Y-m-d')) > strtotime($item->return_date) ? 'red' : 'limegreen' ?>"><?= trim($item->return_date) !== '' ? date('j M Y', strtotime($item->return_date)) : '' ?></td>
				<td align="center">
					<?php if (trim($item->return_date) === '') { ?>
						<div class="row">
							<div class="col-md-6">
								<a href="#" class="btn btn-primary btn-block">
									<i class="glyphicon glyphicon-pencil"></i>
									แก้ไข
								</a>
							</div>
							<div class="col-md-6">
								<a href="#" class="btn btn-success btn-block book-return" data-id="<?= $item->id ?>">
									<i class="glyphicon glyphicon-log-in"></i>
									คืน
								</a>
							</div>
						</div>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<script rel="script" type="text/javascript">
	$(function () {
		$('.book-return').click(function (e) {
			e.preventDefault();
			var id = $(this).data('id');
			var url = '<?= $this->createUrl('return') ?>&id=' + id;
			$.get(url, function (a) {
				if (a == 'bad') {
					alert('เกินกำหนด');
				}
				window.location.reload();
			});
		});
	});
</script>