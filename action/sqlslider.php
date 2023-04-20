<?php
global $wpdb;
if ($_POST['acti']=='saveslider') {
	$errors = array();
	if(!empty($_POST))
	{
		$title = $_POST['title'];
		$enlace = $_POST['enlace'];
        $url = str_replace(" ", "-", $_POST['url']);
		if(isNull($title,$enlace,$url))
		{
			$errors[] = "Debe llenar todos los campos";
		}
        if(Existe('title',$title))
        {
            $errors[] = "Titulo ya exite";
        }
        if(Existe('enlaceimg',$enlace))
        {
            $errors[] = "Enlace de imagen ya exite";
        }

		if(Existe('url',$url))
		{
			$errors[] = "Nombre de la Url ya exite";
		}
		if(count($errors) == 0)
		{
			$registro = registraSlider($title,$enlace,$url);
			if($registro['res'])
			{
				exit(json_encode($registro));
				} else {
				$errors[] = "Error al Registrar Slider";
			}
		}
	}

    $data = array('res' => false, 'msg'=>resultBlock($errors,'danger'));
	exit(json_encode($data));
}else if ($_POST['acti']=='savEditSlider') {
$errors = array();
    if(!empty($_POST))
    {
        $title = $_POST['title'];
        $enlace = $_POST['enlace'];
        $url = str_replace(" ", "-", $_POST['url']);
        $id = $_POST['ideditar'];
        if(isNull($title,$enlace,$url,$id))
        {
            $errors[] = "Debe llenar todos los campos";
        }

        if(Existe('title',$title,$id))
        {
            $errors[] = "Titulo ya exite";
        }
        if(Existe('enlaceimg',$enlace,$id))
        {
            $errors[] = "Enlace de imagen ya exite";
        }

        if(Existe('url',$url,$id))
        {
            $errors[] = "Nombre de la Url ya exite";
        }
        if(count($errors) == 0)
        {
            $updatsli = updateslider($title,$enlace,$url,$id);
            // if($updatsli['res'])
            // {
                exit(json_encode($updatsli));
            // } else {
            //     $errors[] = "Error al Editar Slider";
            // }
        }
    }

    $data = array('res' => false, 'msg'=>resultBlock($errors,'danger'));
    exit(json_encode($data));
}else if ($_POST['acti']=='deletslider') {
    $wpdb->delete($wpdb->prefix . 'sliderTapa', array('id_slider' => $_POST['id']));
}else if($_POST['acti']=='verEdiSlider'){
$id = $_POST['slider'];
$vsli = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "sliderTapa where id_slider=".$id);

$dato = array('id'=>$vsli->id_slider,
    'title' => $vsli->title,
    'enlace'=>$vsli->enlaceimg,
    'url'=>$vsli->url);

exit(json_encode($dato));

}