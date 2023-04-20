<?php
/****************** Crear tabla con la clase wpdb *****************/
global $wpdb;

// Con esto creamos el nombre de la tabla y nos aseguramos que se cree con el mismo prefijo que ya tienen las otras tablas creadas (wp_form).
$table_sliderTapa    = $wpdb->prefix . 'sliderTapa';

$sql = "CREATE TABLE $table_sliderTapa  (
`id_slider` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(100) NOT NULL,
`enlaceimg` varchar(100) NOT NULL,
`url` varchar(200) NOT NULL,
UNIQUE KEY id_slider (id_slider)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";


// upgrade contiene la función dbDelta la cuál revisará si existe la tabla.
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// Creamos la tabla
dbDelta($sql);
$sql2 = "INSERT INTO $table_sliderTapa (id_slider, title, enlaceimg, url) VALUES
(1, 'Tapa del diario Clarín ', 'https://tapas.grupoevolucion.com.ar/AR/ar_clarin.750.jpg', 'clarin'),
(2, 'Tapa del diario La Nacion', 'https://tapas.grupoevolucion.com.ar/AR/nacion.750.jpg', 'nacion'),
(3, 'Tapa del diario La Gaceta', 'https://tapas.grupoevolucion.com.ar/AR/ar_gaceta.750.jpg', 'gaceta'),
(4, 'Tapa del diario El Día', 'https://tapas.grupoevolucion.com.ar/AR/ar_eldia.750.jpg', 'dia'),
(5, 'Tapa del diario Ámbito Financiero', 'https://tapas.grupoevolucion.com.ar/AR/ar_ambito.750.jpg', 'ambito'),
(6, 'Tapa del diario Olé', 'https://tapas.grupoevolucion.com.ar/AR/ole.750.jpg', 'ole'),
(7, 'Tapa del diario El Cronista', 'https://tapas.grupoevolucion.com.ar/AR/ar_cronista.750.jpg', 'cronista'),
(8, 'Tapa del diario Crónica', 'https://tapas.grupoevolucion.com.ar/AR/ar_cronica.750.jpg', 'cronica'),
(9, 'Tapa del diario El Litoral', 'https://tapas.grupoevolucion.com.ar/AR/ar_litoral.750.jpg', 'litoral'),
(10, 'Tapa del diario Popular', 'https://tapas.grupoevolucion.com.ar/AR/ar_diario_popular.750.jpg', 'popular'),
(11, 'Tapa del diario Pagina 12', 'https://tapas.grupoevolucion.com.ar/AR/ar_pagina12.750.jpg', 'pagina12'),
(12, 'Tapa del diario La Capital', 'https://tapas.grupoevolucion.com.ar/AR/la_capital.750.jpg', 'lacapital');"; 
// upgrade contiene la función dbDelta la cuál revisará si existe la tabla.
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// Creamos la tabla
dbDelta($sql2);
$diario1 = "UPDATE $table_sliderTapa SET title = 'Tapa del diario Clarín ', enlaceimg = 'https://tapas.grupoevolucion.com.ar/AR/ar_clarin.750.jpg', url = 'clarin' WHERE id_slider=1";
dbDelta($diario1);