
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>TRADUCTOR</title>
        <link href="main.css" rel="stylesheet" type="text/css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="script_traduccion.js"></script>
    </head>
    <body>
       
     <div class="pricipal">
          <h1>TRADUCTOR</h1>
         <h2>Ejemplo Simple</h2>
       <?php 
            include ('traductor.php');
            $or='es';
            $de='en';
            $traduccion=new Traductor($or,$de);
            $texto='El desarrollo de capacidades técnicas es una tarea comunal. La organización social expresada en la asamblea comunal, asume el protagonismo en actividades de deliberación, planificación, control y redistribución de los beneficios del aprovechamiento forestal. La organización social es la responsable por el aprovechamiento y manejo de los recursos forestales comunales, enmarcados en sus normas comunitarias, las leyes nacionales y los reglamentos técnicos. Son las asambleas comunales que definen el uso que darán al; tanto para el uso doméstico como para el uso comercial.';
            $texto= $traduccion->traducir_texto($texto);
            echo '<p>'.$texto.'</p>';		
            
        ?> 
         <br>
            <h2>Ejemplo Con ajax</h2>
            <div>
             <div class="contenedor_izq">
            <form action="javascript:traducir('traductor');" method="post" enctype="application/x-www-form-urlencoded" name="" id="traductor">
                <textarea name="texto" cols="46" rows="6"></textarea>
                <div>
                <label for="or">Idioma origen</label>
                <select name="or" size="1" id="or">
                    <option value="es">Español</option>
                     <option value="en">Ingles</option>
                     <option value="pt">Portugues</option>
                     <option value="fr">Frances</option>
                </select>
                <label for="des">Idioma destino</label>
                <select name="des" id="des">
                    <option value="en">Ingles</option>
                     <option value="pt">Portugues</option>
                     <option value="fr">Frances</option>
                     <option value="es">Español</option>
                </select>
            </div>
            <input name="Traducir" type="submit" value="Traducir" class="botonS">
        </form>
</div>
    <div class="contenedor_izq">
        <div id="traducido">
       
        </div>
        <div id="cargar">
        TRADUCIENDO...
        </div>
    </div>
  </div>
           <div class="limpiar"></div>
        </div>
    </body>
</html>
