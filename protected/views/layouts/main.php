<?php /* @var $this Controller */ ?>
<?php $base = Yii::app()->request->baseUrl; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="language" content="en"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print"/>
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection"/>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>/libs/bootstrap-3.3.6-dist/css/bootstrap.min.css"/>
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
						'items'       => array(
							array('label' => 'Home', 'url' => array('/site/index')),
							array('label' => 'Members', 'url' => array('/profile/')),
							array('label' => 'Books', 'url' => array('/book/')),
							//					array('label' => 'BGFC Map Project', 'url' => array('/site/bgfc')),
							//					array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
							//					array('label' => 'Contact', 'url' => array('/site/contact')),
							//					array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
							//					array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
						),
						'htmlOptions' => array(
							'class' => 'nav navbar-nav'
						),
					)); ?>
				</div>
			</div>
		</nav><!-- mainmenu -->

		<?php echo $content; ?>

		<div class="clear"></div>
	</div><!-- page -->
</body>
</html>
