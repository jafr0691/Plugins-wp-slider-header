<?php

function isNull($title, $enlace, $url)
{
    if (strlen(trim($title)) < 1 || strlen(trim($enlace)) < 1 || strlen(trim($url)) < 1) {
        return true;
    } else {
        return false;
    }
}

function Existe($key,$valor,$id='')
{
    global $wpdb;
    if ($id=='') {
        $valort = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "sliderTapa where {$key}='{$valor}'");
    }else{
        $valort = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "sliderTapa where id_slider <> ".$id." and {$key}='{$valor}'");
    }
    if ($valort > 0) {
        return true;
    } else {
        return false;
    }
}

function resultBlock($errors, $color)
{
    $html = '';
    if (count($errors) > 0) {
        $html .= "<div id='msg' class='alert alert-".$color."' role='alert'>
			<ul>";
        foreach ($errors as $error) {
            $html .= "<li>" . $error . "</li>";
        }
        $html .= "</ul>";
        $html .= "</div>";
    }
    return $html;
}

function registraSlider($title,$enlace,$url)
{
    global $wpdb;
    $errors = array();
    $regiSlider = $wpdb->insert( $wpdb->prefix . 'sliderTapa',
        array(
            'title'=> $title,
            'enlaceimg'=> $enlace,
            'url'=> $url
        )
    );
    $slider = $wpdb->get_row("SELECT id_slider FROM " . $wpdb->prefix . "sliderTapa where title='{$title}' and enlaceimg='{$enlace}' and url='{$url}'");
    if($regiSlider){
        $errors[] = "EXITO: Los campos fueron guadados. ".$title;
        $data = array('res'=>true,'title' => $title, 'enlace'=> $enlace, 'url'=> $url,'id'=>$slider->id_slider,'msg'=>resultBlock($errors,'success'));
        return $data;
    } else {
        $errors[] = "ERROR: Del Servidor no se logro guardar, intente nuevamente. ".$title;
        $data = array('res'=>false,'msg'=>resultBlock($errors,'danger'));
        return $data;
    }
}

function updateslider($title,$enlace,$url,$id)
{
    global $wpdb;
    $errors = array();
    $upd = $wpdb->update($wpdb->prefix . 'sliderTapa',
                array('title'=> $title,
            'enlaceimg'=> $enlace,
            'url'=> $url),
                array('id_slider' => $id)  );
    if($upd){
        $errors[] = "EXITO: Los campos fueron editados. ".$title;
        $data = array('res'=>true,'title' => $title, 'enlace'=> $enlace, 'url'=> $url,'id'=>$slider->id_slider,'msg'=>resultBlock($errors,'success'));
        return $data;
    } else {
        $errors[] = "ERROR: Los campos no han cambiado o algun problemacon en el servidor. ".$title;
        $data = array('res'=>false,'msg'=>resultBlock($errors,'danger'));
        return $data;
    }
}















