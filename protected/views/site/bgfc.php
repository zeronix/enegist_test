<?php
	/**
	 * @var $this    SiteController
	 */
	$this->pageTitle = Yii::app()->name;

	$base = Yii::app()->baseUrl;
?>
<style>
	div.you {
		border: 1px solid black;
		width: 20px;
		height: 20px;
		background-color: black;
		position: absolute;
		border-radius: 10px;
	}

	div.map-wrapper {
		width: 100%;
		height: 1000px;
		position: relative;
	}

	img.map {
		position: absolute;
		top: 0;
		left: 0;
		width: 50%;
	}

	#wrapper {
		margin: 80px auto;
	}

	#map_container {
		background: url('<?php echo $base; ?>/images/world_map.png') 0 0 no-repeat;
		height: 415px;
		width: 840px;
		position: relative;
		color: #fff;
		margin: 0 auto;
	}

	a.marker {
		position: absolute;
		background: url('<?php echo $base; ?>/images/markers.png') 0 0 no-repeat;
		height: 32px;
		width: 20px;
		display: block;
		cursor: pointer;
	}

	a.marker:hover {
		background: url('<?php echo $base; ?>/images/markers.png') 0 50% no-repeat;
	}

	/*a.current{
		background: url('
	<?php echo $base; ?>
	/images/markers.png') 0 100% no-repeat;
		}*/

	.info_box {
		display: none;
		position: absolute;
		width: 240px;
		height: 115px;
		overflow: auto;
		-webkit-overflow-scrolling: touch;
		padding: 5px 10px;
		background-color: rgba(31, 32, 62, 1.0);
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		border: 1px solid #fff;
	}

	.info_box h2 {
		border-bottom: 1px solid #515a6b;
		color: #515a6b;
	}

	.info {
		display: none;
	}

	::-webkit-scrollbar {
		width: 12px;
	}

	::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px white;
		border-radius: 10px;
	}

	::-webkit-scrollbar-thumb {
		border-radius: 10px;
		-webkit-box-shadow: inset 0 0 6px white;
	}
</style>
<div id="wrapper">
	<div id="map_container">
		<a class="marker" style="top:44%; left:67%; display: none;" data-info="iran"></a>

		<div class="info_box"></div>
		<div class="info" id="iran">
			<h4 style="border-bottom: 1px solid;">Iran Republic - Asia</h4>
			<p>Lorem ipsum dolor sit amet, mel offendit facilisis cu, per ei detraxit electram temporibus, eu a</p>
			<p>Lorem ipsum dolor sit amet, mel offendit facilisis cu, per ei detraxit electram temporibus, eu b</p>
		</div>
	</div>
</div>
<!--<div class="map-wrapper">
	<img src="<?php /*echo $base; */ ?>/images/map.png" class="map"/>

	<div id="test" class="you" style="left: 230px; top: 745px;"></div>
	<div style="position: absolute; top: 5%; right: 0;">
		<button id="action" data-loading-text="Loading..." style="width: 150px;" class="btn btn-primary">Test</button>&emsp;
				<input type="number" onkeypress="" />
				<input type="number" onkeypress="" />
	</div>
</div>-->

<script src="<?php echo $base; ?>/libs/jquery/jquery.min.js"></script>
<script src="<?php echo $base; ?>/js/bootstrap.min.js"></script>

<script type="text/javascript">
	var $cooldown = 1500;
	$(function () {
		/*$('#action').click(function () {
		 var $btn = $(this);
		 $btn.button('loading');
		 var $obj = $('#test');
		 var $left = parseInt($obj.css('left'));
		 $obj.animate({'left': '230px', 'top': '626px'}, $cooldown).delay(1000); // after start
		 $obj.animate({'left': '55px', 'top': '626px'}, $cooldown).delay(1000);
		 $obj.animate({'left': '55px', 'top': '255px'}, $cooldown).delay(1000);
		 $obj.animate({'left': '55px', 'top': '40px'}, $cooldown, function () {
		 $btn.button('reset');
		 }); // Away team parking
		 });*/

		$('a.marker').fadeIn(1000, function () {
			$(this).mouseover();
		}).mouseover(function () {
			var $link = $(this);
			var countryName = $link.data('info');
			var linkPosition = $link.position();
			var infoBoxTopPos = linkPosition.top - 130 + "px";
			var infoBoxLeftPos = linkPosition.left - 120 + "px";
			var container = $('.info' + '#' + countryName).html();
			$('a.marker').removeClass('current');
			$link.addClass('current');
			$('.info_box').html(container).css({
				'top' : infoBoxTopPos,
				'left': infoBoxLeftPos
			}).fadeIn(1000);
		}).mouseleave(function () {
			$('.info_box').fadeOut(1000);
		});

		$('div.info_box').mouseover(function(e) {

		});
	});
</script>