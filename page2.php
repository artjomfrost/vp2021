<?php 
	$author_name = "Artjom Morozov";
	
	//Kontrollin, kas POST info j6uab kuhugi
	var_dump($_POST);
	//Kontrollime kas klikiti submit nuppu
	$todays_adjective_html = null;
	$todays_adjective_error = null;
	$todays_adjective = null;
	if(isset ($_POST["adjective_submit"]));
		echo "Klikiti";
		//kontrollime, kas midagi kirjutati ka 
		if(!empty($_POST["todays_adjective_input"])) {
		$todays_adjective_html = "<p>Tanane paev on " .$_POST["todays_adjective_input"] .".</p>";
		$todays_adjective = $_POST["todays_adjective_input"]
		} else {
			$todays_adjective_error = "Palun sisesta tänase kohta sobiv omadussõna!";
		}

	//echo $weekday_now;
	// võrdub == suurem/väiksem ... < > <= >= pole võrdne !=
	
	//juhusliku foto lisamine
	$photo_dir = "photos/";
	//loen kataloogi sisu
	$all_files = scandir($photo_dir);
	$all_real_files = array_slice($all_files, 2);

	//sõelume välja päris pildid
	$photo_files = [];
	$allowed_photo_types = ["image/jpeg", "image/png"];
	foreach($all_real_files as $file_name) {
		$file_info = getimagesize($photo_dir .$file_name);
		if (isset($file_name["mime"])) {
			if (in_array($file_info["mime"], $allowed_photo_types)) {array_push($photo_files, $file_name);
				
			}//if in array
		}//if isset lõppeb
	}//foreach lõppes

	//var_dump($all_real_files);
	//loen massiivi elemendid kokku
	$file_count = count($all_real_files);
	//loosin juhusliku arvu (min peab olema 0 ja max count -1)
	$photo_num = mt_rand(0, $file_count - 1);
	$photo_html = '<img src="' .$photo_dir .$all_real_files[$photo_num] .'" alt="Tallinna Ülikool">';
	
	//tsükkel
	//näiteks
	//<ul>
	//		<li>pildifailinimi1.jpg</li>
	//		<li>pildifailinimi2.jpg</li>
	//		<li>pildifailinimi3.jpg</li>
	//		...
	//</ul>
	
	$photo_list_html .= "<ul>";
	for($i = 0;$i < $file_count;$i ++) {
		$photo_list_html .= "<li>" .$photo_files[$i] ."</li>";
		
	}
	$photo_list_html = "</ul>";
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">
	Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
	<form method="POST">
		<input type="tekst" placeholder="omadussõna tänase päeva kohta" name="todays_adjective_input">
		value="<?php echo $todays_adjective" ?>
		<input type="submit" name="todays_submit" value="Saada">
		<span> echo $todays_adjective_error; ?></span>
	</form>
	<?php echo $todays_adjective_html; ?>
	<hr>
	
	<?php echo $photo_html; ?>
</body>
</html>