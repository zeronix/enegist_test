<?php /* @var $this Controller */ ?>
<?php $base = Yii::app()->request->baseUrl; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="language" content="en"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>/libs/bootstrap-3.3.6-dist/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>/css/custom.css"/>

	<script type="text/javascript" src="<?= $base ?>/libs/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?= $base ?>/libs/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse">
					<?php $this->widget('zii.widgets.CMenu', array(
						'items'          => array(
							array('label' => 'เช่ายืม', 'url' => array('/site/'), 'active' => $this->id === 'site' ? true : false),
							array('label' => 'ลูกค้า', 'url' => array('/profile/'), 'active' => $this->id === 'profile' ? true : false),
							array('label' => 'หนังสือ', 'url' => array('/book/'), 'active' => $this->id === 'book' ? true : false),
						),
						'activeCssClass' => 'active',
						'htmlOptions'    => array(
							'class' => 'nav navbar-nav'
						),
					)); ?>
				</div>
			</div>
		</nav><!-- mainmenu -->

		<?php if (isset($this->breadcrumbs)): ?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links' => $this->breadcrumbs,
				'homeLink' => false,
				'htmlOptions' => array(
					'class' => 'breadcrumb'
				)
			)); ?><!-- breadcrumbs -->
		<?php endif ?>

		<?php echo $content; ?>

		<div class="clear"></div>
	</div><!-- page -->
</body>
</html>
