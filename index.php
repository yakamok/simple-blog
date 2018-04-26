<!DOCTYPE html>
<html>
<head>
<meta name=viewport content="width=device-width, initial-scale=1">
<title>title</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
function variable_check($input_check){
	if(isset($input_check)){
		if (ctype_alnum(str_replace("/","",$input_check))){
			return $input_check;
		}else{
			header('location: /?p=pages/404');// you need to add the 404.md to the pages dir
		}
	}else{
		return NULL;
	}
}

function pagnation($data0, $data, $data2, $data3){
	echo "<div class=\"pagnation\">";
		echo "<div id='newleft'>";
			if ($data0 < $data){
				echo "<span class='pages'><a href='index.php?index=" . $data2 . "'>Newer Posts</a></span>";
			}
		echo "</div>";
		echo "<div id='oldright'>";
			if ($data0 > 10){
				echo "<span class='pages'><a href='index.php?index=" . $data3 . "'>Older Posts</a></span>";
			}else{
				echo "<span class='pagesnot'>Older Posts</span>";
			}
		echo "</div>";
	echo "</div>";
}
require_once 'Parsedown.php';
$index = 0;
$count = 0;
$images_find = array();
foreach (glob("posts/*.md") as $filename) {
	$images_find[] = $filename;
	$count++;
}

$single_page = variable_check($_GET['p']);
$index_num = variable_check($_GET['index']);

if (isset($single_page)){
	$index = $single_page;
}else if(isset($index_num)){
	$index = $index_num;
}else{
	$index = $count;
}
?>
<div id="header">
	<div id="title"><a href="index.php">yakamo )*(</a></div>
</div>
<div id="wrapper">
<div id="content">
<?php
if ($index > 14){
	$next = $index - 14;
}else{
	$next = 14;
}
if ($index < $count){
	$prev = $index + 14;
}else if($index == $count){
	$prev = $count;
}
$menu = $index;
if (!isset($single_page)){
	pagnation($menu, $count, $prev, $next);
}
if (isset($single_page)){
	echo Parsedown::instance()->text(file_get_contents($single_page . ".md"));
}else{
	$total = $index - 14;
	if ($index > 0){
		while ($index > $total){
			if (isset($images_find[$index])){
				if (file_exists("posts/" . $index . ".md") == "True") {
					$crap = file_get_contents("posts/" . $index . ".md");
					$file_array = explode("\n",$crap);
					if ($index != $count -1){
						echo  '<span class="date">' . str_replace("_","",$file_array[1]) . '</span>' . '   <span class="linklist"><a href="/?p=' . 'posts/'  . $index . '">' . str_replace("# ","",$file_array[0]) . '</a></span><br />';
					}else{
								echo  '<span class="latest">Latest </span>   <span class="new"><a href="/?p=' . 'posts/'  . $index . '">' . str_replace("# ","",$file_array[0]) . '</a></span><br />';
							 }
				}
			}
		$index--;
		}
	}
}
?>
</div>
<div id="footer">
<?php
echo Parsedown::instance()->text(file_get_contents("sidebar.md"));
?>
</div>
</div>
</body>
</html>
