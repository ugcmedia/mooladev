<?php

    header("Content-type: text/css; charset: UTF-8");
	
	$colors = json_decode( file_get_contents('../../../config/colorsConfig.json')  );
	foreach($colors as $color)
	{
		if(strpos($color->element_class,'primary'))
		echo $color->element_class.'{'.$color->color_type.':'.$color->color_value.' !important;}
		';
		else echo $color->element_class.'{'.$color->color_type.':'.$color->color_value.';}
		';
	}
	
?>
