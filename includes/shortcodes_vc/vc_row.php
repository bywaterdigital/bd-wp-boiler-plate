<?php
//extend VC default component

//add type to row
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"group" => "Design+",
	"class" => "",
	"heading" => "Type",
	"param_name" => "type",
	"value" => array(
		"Light" => "light-section",	
		"Dark" => "dark-section",
		"Primary Colour" => "primary-colour"	
	)
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"group" => "Design+",
	"class" => "",
	"heading" => "Vertical Padding",
	"param_name" => "vertical_padding",
	"value" => array(
		"Normal" => "",	
		"None" => "no-v-pad"
	)
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"group" => "Design+",
	"class" => "",
	"heading" => "Pullup",
	"param_name" => "pullup",
	"value" => array(
		"None" => "",	
		"Small" => "pullup-small pullup",
		"Medium" => "pullup-medium pullup",
		"Large" => "pullup-large pullup"
	)
));
?>