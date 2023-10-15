<?php
// mail de destino: cambiarlo por tu mail personal

$enviaPara = 'omar.toyos@davinci.edu.ar'; 

// subject del mail: el asunto que quiero que muestre

$subject = 'Contacto desde la web'; 

/* ruta relativa desde ESTE documento al html que quiero que se abra después de mandar el mail. 

También, en vez de utilizar otro html para el mensaje de enviado, se podría volver al mismo html donde se encuentra el formulario, pero, aún así, hay que informar que el mail fue enviado, para que al usuario no se le generen dudas, ya que el php no se verá en pantalla.

Para ello, se puede poner en target una caja que estuviera con display none en el mismo html que contiene el formulario y que al enviar el mail y volver a ese mismo html, se ajuste display block al entrar en target (en vez de ponerla en target con un vínculo lo hacemos al volver desde el php luego de enviar el mail).

Por ejemplo, index.html#enviado (si tenemos una caja con id enviado en display none y una regla #enviado:target que la ponga en display block, solo se hará visible cuando desde el php se navegue al html poniendo en target a esa caja). */

$enviado="enviado.html";




//DE ACÁ PARA ABAJO NO TOCAR...

$mensaje = '';
$primero = true;
foreach($_POST as $indice => $valor){
	if(is_array($valor)){
		$mensaje .= '<strong>'.$indice.': </strong><ul>';
		foreach($valor as $item){
			$mensaje .= '<li>'.$item .'</li>';
		}				
		$mensaje .= '</ul><br>'; 
	}else{
		if($primero){
			$from = $valor;
			$primero = false;
		}
		$mensaje .= '<strong>'.$indice.': </strong>';
		$mensaje .= $valor . '<br>';
		if(strpos($valor, '@')>3 && strpos($valor, '.') > -1){
			$from = $valor;
		}
	}
}
$mail_headers  = "MIME-Version: 1.0\r\n";
$mail_headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$mail_headers .= 'From: ' . $from . "\r\n";
mail($enviaPara, $subject, $mensaje, $mail_headers); 
header("Location: $enviado");
?>