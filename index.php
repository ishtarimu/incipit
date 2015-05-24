<!DOCTYPE html>
<?php 
	class Incipit
	{
		public $titre;
		public $sous_titre;
		public $description;
		public $image;
		public $path;
		public function __construct($d)
		{
			$this->path = $d;
			if ($fichier = file($d."/incipit.txt"))
			{
				$length = count($fichier);
				$this->titre = $fichier[0];
				$this->sous_titre = ($length >1)? $fichier[1] : "";
				$this->description = ($length >2)? $fichier[2] : "";
				$this->image = ($length >3)? $fichier[3] : "";
			}
		}
	}
	$dirs = array_slice( scandir(getcwd()), 2);
	$elements = [];
	foreach($dirs as $dir)
	{
		if(is_dir($dir) && file_exists($dir."/incipit.txt"))
		{
			array_push($elements, $dir);
		}
	}
	$self = new incipit(getcwd());
?>
<html>
<head>
	<title>
		<?php echo $self->titre." : ".$self->sous_titre ?>
	</title>
	<link rel="stylesheet" type="text/css" href="incipit.css">
</head>
<body>
<h1><?php echo $self->titre ?></h1>
<h2><?php echo $self->sous_titre ?></h2>
<div id="grille">
	<?php foreach($elements as $element)
	{
		$elem = new Incipit($element);
		echo '<div class="element">';
			echo '<a href="'.$elem->path.'">';
				echo '<h3>'.$elem->titre.'</h3>';
			echo '</a>';
			echo '<h4>'.$elem->sous_titre.'</h4>';
			if ($elem->image != "" && $elem->image != "\n")
			{
				echo '<img src="'.$elem->path.'/'.$elem->image.'" class="mImage">';
			}
			echo '<p>'.$elem->description.'</p>';
		echo '</div>';
	}
	?>
</div>
</body>
</html>
