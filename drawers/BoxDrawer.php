<?php

abstract class BoxDrawer {

	protected static function draw($img_href, $img_src, $img_alt, $title_href, $title_text, $mark, $infoObject) {
		if (!is_null($mark)) {
			$mark_class = $mark > 8 ? "high" : ($mark > 5 ? "medium" : "low");
		}
		echo "<div class='box'>";
		echo "<div class='left'>";
		?>
		<header>
			<a href="<?php echo $title_href; ?>">
				<?php echo $title_text; ?>
			</a>
		</header>
		<?php
		InfoListDrawer::draw($infoObject, true);
		echo "</div>";
		echo "<div class='right'>";
		echo "	<a class='cover' href='$img_href'>";
		echo "		<img src='$img_src' alt='$img_alt'/>";
		echo "	</a>";
		echo "</div>";
		if (!is_null($mark)) {
			echo "<div class='voto $mark_class'>{$mark}</div>";
		}
		echo "</div>";
	}

}