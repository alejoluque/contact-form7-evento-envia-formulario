<?php
/**
 * @package Formulario API
 * @version 1
 */
/*
Plugin Name: Formulario API 
Plugin URI:  https://alejoluque.com
Description: Plugin para enviar datos de formulario
Author: Alejo Luque
Version: 1
Author URI: https://alejoluque.com
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

add_action("vsz_cf7_after_insert_db","ver_form",10,3);
function ver_form($fid,$cf7_id,$data_id){	
	global $wpdb;
	//$cf7_id = 40;
	//$data_id =6;

  if($cf7_id == 2){
    

	
	$sql = "SELECT `name`,`value` FROM `".VSZ_CF7_DATA_ENTRY_TABLE_NAME."` WHERE `cf7_id` = ".$cf7_id." AND `data_id` = ".$data_id."";	
		$data = $wpdb->get_results($sql);
		if(!empty($data)){
			foreach ($data as $k => $v) {
				$fields[$v->name] = htmlspecialchars_decode($v->value);
				
			}
		}
    
	$nombre = $fields['nombre'];
	$apellido = $fields['apellido'];
    
	$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'url',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('arguments' => '{ "nombre":"'.$nombre.'","apellido":"'.$apellido.'"}'),
		  CURLOPT_HTTPHEADER => array(
			'Cookie: 1a99390653=cf1af5bd11d238cae52ce89fbd714eb4; _zcsr_tmp=5a702e9d-98d6-4306-a8d0-96f9779a6e8f; crmcsr=5a702e9d-98d6-4306-a8d0-96f9779a6e8f'
		  ),
		));
		$response_crm = curl_exec($curl);
		curl_close($curl);
	$envia_crm = "Envia_CRM";
		//echo $response;
		$wpdb->query($wpdb->prepare('INSERT INTO '.VSZ_CF7_DATA_ENTRY_TABLE_NAME.' (`cf7_id`, `data_id`, `name`, `value`) VALUES (%d,%d,%s,%s)', $cf7_id, $data_id, $envia_crm, $response_crm));
	
  }
