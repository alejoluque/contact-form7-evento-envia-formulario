<?php
add_action( 'wpcf7_before_send_mail',
  function( $contact_form, $abort, $submission ) {
	  
	  $contact_form = WPCF7_ContactForm::get_current();
		$contact_form_id = $contact_form -> id;
    // Buscamos los datos guardados
    $nombre = $submission->get_posted_data( 'nombre' ); 
    $apellido = $submission->get_posted_data( 'apellidos' );
	  $array = ($_POST['nombre-array']);
    
    //Identificamos el ID del formulario
  if($contact_form_id== 9911){
    		////Ejecuta el código
		}
  },
  10, 3
);
?>
