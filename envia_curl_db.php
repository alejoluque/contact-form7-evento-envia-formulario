<?php
/**
 * @package Formulario API
 * @version 1
 */
/*
Plugin Name: Formulario API 
Plugin URI:  https://alejoluque.com
Description: Plugin para enviar datos de formulario a CRM
Author: Alejo Luque
Version: 1
Author URI: https://alejoluque.com
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

 add_action("vsz_cf7_after_insert_db","vsz_cf7_after_insert_db_callback",10,3);
    
    function vsz_cf7_after_insert_db_callback($fid,$cf7_id,$data_id){
      global $wpdb;
      $sql = "SELECT `name`,`value` FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$cf7_id." AND `data_id` = ".$data_id."";
      $data = $wpdb->get_results($sql);
        if(!empty($data)){
          foreach ($data as $k => $v) {
            $fields[$v->name] = htmlspecialchars_decode($v->value);
            
          }
        }
 $nombre = $fields['nombre'];
 $apellido = $fields['apellido'];
		
		if($cf7_id == 95){
			<?php

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'url',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;

			
			
			//$envia = "Guarda_CRM";
          
          //$wpdb->query($wpdb->prepare('INSERT INTO '.VSZ_CF7_DATA_ENTRY_TABLE_NAME.' (`cf7_id`, `data_id`, `name`, `value`) VALUES (%d,%d,%s,%s)', $cf7_id, $data_id, $envia, $response));
       
		}
}
