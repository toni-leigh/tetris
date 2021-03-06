<?php

	mysql_connect("localhost","tastydev_tetris","%0\$_5?TGxHbz") or die(mysql_error());

	mysql_select_db("tastydev_tetris");

	if (isset($_POST['name']))
	{

		mysql_query("insert into score (name,score,level) values ('".mysql_real_escape_string($_POST['name'])."',".mysql_real_escape_string($_POST['score']).",".mysql_real_escape_string($_POST['level']).")") or die(mysql_error());

		header('location:/');

	}

	$scores=mysql_query("select * from score order by score desc, level desc, name limit 20");

?>

<html>

	<head>

		<link href="stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />

	</head>

	<body>

		<div class='scores'>

			<?php $c=1; ?>

			<?php while ($high_score=mysql_fetch_array($scores)): ?>

				<?php if ($c<2): ?>

					<div class='high-score hs-row-first'>

				<?php elseif ($c<3 && $c>1): ?>

					<div class='high-score hs-row-second'>

				<?php elseif ($c<6 && $c>2): ?>

					<div class='high-score hs-row-gold'>

				<?php elseif ($c>=6 && $c<11): ?>

					<div class='high-score hs-row-silver'>

				<?php else: ?>

					<div class='high-score hs-row-bronze'>

				<?php endif; ?>

					<span class='position'><?=$c ?></span>

					<span class='hs-name'><?=$high_score['name'] ?></span>

					<span class='hs-score'><?=$high_score['score'] ?></span>

					<span class='hs-level'> - <?=$high_score['level'] ?></span>

				</div>

				<?php $c++; ?>

			<?php endwhile; ?>

		</div>

		<div class='dev-output'>

			<span class='js-last-piece-that-moved'>0</span>

			<span id='js-piece-count'>0</span>

			<div id='js-piece-data'></div>

		</div>

		<div id='js-event-counter' class='event-counter'>0</div>

		<div id='js-score' class='score'>0</div>

		<div id='js-level' class='level'>0</div>

		<div id='js-tetris' class='grid' data-component='grid'>



		</div>

		<div id='js-next-piece' class='preview-cells'>



		</div>

		<div id='js-form-background' class='form-background'>
				
			<form id='js-high-score' class='high-score-form' method='post'>

				<input type='text' name='name' maxlength="3"/>

				<input id='js-form-score' type='hidden' name='score' value='0'/>

				<input id='js-form-level' type='hidden' name='level' value='0'/>

				<input type='submit' name='submit' value='submit score'/>

			</form>

		</div>



	</body>

</html>

<script src='config.js'></script>
<script src='grid.js'></script>
<script src='piece.js'></script>
<script src='cell.js'></script>
<script src='keys.js'></script>
<script src='timer.js'></script>

<script>

	window.tetris=new window.Grid('js-tetris');

</script>