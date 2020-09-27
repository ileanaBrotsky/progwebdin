<?php 
//funci�n que va a tomar los datos que llegan AL APRETAR SUBMIT identificando si son por m�todo $_POST o por $_GET
//es decir que no importa por qu� m�todo vengan se va  a armar el array de datos.
function data_submitted() {
	$arrayMetodo= array();
    if (!empty($_POST)) 
        $arrayMetodo =$_POST;
    else 
		if(!empty($_GET)) {
		    $arrayMetodo =$_GET;
		}
    if (count($arrayMetodo)){
        foreach ($arrayMetodo as $indice => $valor) {
				if ($valor=="")
				    $arrayMetodo[$indice] = 'null'	;
			}
	}
	return $arrayMetodo;

}


spl_autoload_register(function ($clase) {
//	echo "Cargamos la clase  ".$clase."<br>" ;
	$directorys = array(
		$GLOBALS['ROOT'].'modelo/',
		$GLOBALS['ROOT'].'control/',
	);
   // print_r($directorys) ;
	foreach($directorys as $directory){
	  if(file_exists($directory.$clase . '.php')){  
			  // echo "se incluyo".$directory.$class_name . '.php';
			require_once($directory.$clase . '.php');
			return;
		}           
	}

   
});

?>