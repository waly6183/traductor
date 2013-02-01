<?php
/*Clase de traduccion para para traducir de un idioma atro
 * usado la libreria curl
 * autor:Walter Mejia Apaza
 */
class Traductor
{       
    public $len_origen;
	public $len_destino;
	public $url;
	public $texto;
	public $yatraducido;
        /* Se establece la los datos  de idioma original al idioma deseado*/
	function Traductor($origen='es',$destino='en'){
		$this->url='http://translate.google.com';
		$this->destino($destino);
		$this->origen($origen);		
	}
	function destino($d){
		$this->len_destino=$d;
	}
	function origen($o){
		$this->len_origen=$o;
	}
        /*Codifica los datos antes de ser enviados*/
	function codificar_url($dato,$separador='',$clave=''){
		$vector_aux=array();
		foreach($dato as $indice => $valor){
			$indice=urlencode($indice);
			if ( !empty($clave)){
                            $indice= $clave . "[" . $indice . "]";
			}
			if ( is_array($valor) || is_object($valor) ){
                            array_push( $vector_aux, http_build_query($valor, "", $separador, $indice) );							
			}
			else{	
                            array_push( $vector_aux, $indice . "=" .$valor );					
			}								
		}
		if ( empty($separador) )
		{
                    $separador = ini_get( "arg_separator.output" );
		}
		return implode( $separador, $vector_aux );
					
	}
	function traducir_texto($tex){
            //Comprobamos si hay soporte para curl
            if ( !extension_loaded('curl') ){
                return ( 'Es necesario cargar / activar la extensión CURL (http://www.php.net/cURL).' );
            }	
            if(trim($tex)!=''){
		 $texto1=$tex;
		 $this->texto=urlencode($texto1);
            }
$vector_aso=array("js"=>"n","prev"=>"_t","hl"=>"es","ie"=>"UTF8", "text" =>$this->texto,"file"=>'',"format"=>'html', "sl" =>$this->len_origen,"tl"=>$this->len_destino);
			
			$texto = $this->comunicacion($vector_aso);
			$texto= strip_tags($texto);
			$texto	= explode('>',$texto);
			return $texto[1];

		}
        /*establecer todas las opciones para la transferencia usando curl*/
	function comunicacion($datos){
		$coneccion=curl_init();	
		curl_setopt( $coneccion, CURLOPT_URL, $this->url.'/?'); 
		curl_setopt( $coneccion, CURLOPT_HEADER, 0 ); 
		curl_setopt( $coneccion, CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $coneccion, CURLOPT_POST, true);
		curl_setopt( $coneccion, CURLOPT_POSTFIELDS,$this->codificar_url($datos));
		curl_setopt($coneccion, CURLOPT_USERAGENT, "Mozilla/5.0");
                curl_setopt($coneccion, CURLOPT_ENCODING , "UTF-8");
		// Execute the cURL call
		$resultados = curl_exec($coneccion); 
		curl_close($coneccion); 
                $traducido = $this->filtradoString($resultados, 'result_box', "</div>");
		if ($traducido==""){
                       $traducido = $this->filtradoString($resultados, "'#fff'\">", "</span></span></div>");
		}
                return str_replace("Ã©", "é", $traducido); 
          }
	/*Se obtiene la informacion de traducida haciendo divicion por los factores enviados */	
	function filtradoString($a,$b,$c){ 
                $y = explode($b,$a);
                $x = explode($c,$y[1]);
                return $x[0];
       }
}

?>