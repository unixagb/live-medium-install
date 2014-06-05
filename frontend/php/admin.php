<?php
include "header.php";
?>
<script src="./jquery/checkall.js"></script>
<script src="./jquery/code_pop.js"></script>
<body>
	<div id="main_text">
		<div id="script_pannel">
			<h3 class="pannel_head">Admin</h3>
			<ul>
				<li><a href="#library">Library</a></li>
				<!--<li><a href="#script">Scripts</a></li>-->
			</ul>
		</div>
		<div id="admin_area">
			<div id="library">
				<h1>Library</h1>
				<?php
				$dir = "./library/";
				$library = scandir($dir);
				$count = count($library);

				echo "<form action=\"admin_changes.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"count\" value=\"3\">";
				echo "<table>";
				echo "<tr>
						<th><input type=\"checkbox\" id=\"select_all\"></th>
						<th>Script</th>
						<th>Code</th>
						<th>Action</th>
					</tr>";
				for ($x = 2; $x < $count; $x++) {
					$file = "./library/$library[$x]";
					$content = file_get_contents($file);
					echo "<tr>";
					if(is_link("./scripts/$library[$x]")) {
							echo "<td class=\"td_center\"><input class=\"checkbox1\" type=\"checkbox\" name=\"$library[$x]\" value=\"1\" checked /></td>";
					} else {
							echo "<td class=\"td_center\"><input class=\"checkbox1\" type=\"checkbox\" name=\"$library[$x]\" value=\"1\" /></td>";
					}
					echo "<td>$library[$x]</td>
						<td><a class=\"a_code\" rowid=\"$x\" href=\"#$library[$x]\">".substr($content,0 ,50)."....</a></td>
						<td><button rowid=\"$x\" class=\"edit_button\">&#9998;</button><button>X</button></td>
					</tr>";
					echo "<div rowid=\"$x\" class=\"backlight\"><div class=\"code_box\"><div id=\"header_pop\"><h2>Script</h2><p class=\"exit\">X</p></div><div id=\"content_pop\">$content</div></div></div>";
					echo "</form>";
				?>
				<div id="edit_wrap">
					<div class="edit"<?php echo "rowid=\"$x\""; ?>>
						<h1 class="custom_h1">Script</h1>
						<form action="edit_script.php" method="POST">
							<textarea name="script" rows="24" cols="83"><?php echo $content;?></textarea>
							<?php echo "<input type=\"hidden\" name=\"file\" value=\"$file\">";?>
							<input class="submit" type="submit" name="submit" value="Submit">
							<input class="delete" type="submit" name="submit" value="Delete Script">
							<button class='cancel'>Cancel</button>
						</form>
				</div>
				<?php
				}
				echo "</table>";
				echo "<input type=\"submit\" value=\"Submit\">";
				?>
			</div>
		</div>
	</div>
<?php
include "footer.php";
?>
