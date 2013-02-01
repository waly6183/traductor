function traducir(div){
	var datos=$('#'+div).serialize();
	$.ajax({
	type: 'post',
	url:'envio.php',
	data:datos,
	beforeSend: function(objeto){
           $('#cargar').show();
    },
	complete: function(objeto, exito){
           if(exito=="success"){
				$('#cargar').hide();
            }
    },
	success: function(data){
		//alert(data);
		$('#traducido').html(data);
	  } 
	});
}

