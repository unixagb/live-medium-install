<?php
$file = $_POST['file'];
$new_script = $_POST['script'];
$new_script = preg_replace("/\r\n/", "\n", $new_script); // DOS style newlines
$new_script = preg_replace("/\r/", "\n", $new_script); // Mac newlines for nostalgia
$submit = $_POST['submit'];
$machine = scandir("./machines/");
$count_machines = count($machine);
if ($submit == "Submit") {
	file_put_contents("./library/$file", $new_script);
} else {
	unlink("./library/$file");
	if (is_link("./scripts/$file")) {
		unlink("./scripts/$file");
	}
	for ($x = 2; $x < $count_machines; $x++) {
		if (is_link("./machines/$machine[$x]/$file")) {
			unlink("./machines/$machine[$x]/$file");
		}
	}
}
header('Location: ./admin.php');
?>