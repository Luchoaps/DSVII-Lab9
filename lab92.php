<HTML lang="es">
<head>
    <TITLE>laboratorio 9.2</TITLE>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <h1>Consulta de noticias</h1>
    <form name="FormFiltro" method="post" action="lab92.php">    
        <BR>
        Filtrar por: 
        <select name="campos">
            <option value="texto" selected>Descripcion</option>
            <option value="titulo">Titulo</option>
            <option value="categoria">Categoria</option>
        </select>
        
        con el valor
        <input type="text" name="valor">
        <input name="ConsultarFiltro" value="Filtar Datos" type="submit" />
        <input name="ConsultarTodos" value="Ver Todos" type="submit" />

    </form>
    <?php
    require_once("class/noticias.php");
    $obj_noticia = new noticia();
    $noticias = $obj_noticia->consultar_noticias();
    if(array_key_exists('ConsultarTodos', $_POST)){
        $obj_noticia = new noticia();
        $noticias_new = $obj_noticia->consultar_noticias();
    }

    if(array_key_exists('ConsultarFiltro', $_POST)){
        $obj_noticia = new noticia();
        $noticias = $obj_noticia->consultar_noticias_filtro($_REQUEST['campos'],$_REQUEST['valor']);
    }
    $nfilas=count($noticias);

    if($nfilas > 0){
        print ("<TABLE>\n");
        print ("<TR>\n");
        print ("<TH>Titulo</TH>\n");
        print ("<TH>Texto</TH>\n");
        print ("<TH>Categoria</TH>\n");
        print ("<TH>Fecha</TH>\n");
        print ("<TH>Imagen</TH>\n");
        print ("</TR>\n");

        foreach ($noticias as $resultado) {
            print("<TR>\n");
            print("<TD>" . $resultado['titulo'] . "</TD>\n");
            print("<TD>" . $resultado['texto'] . "</TD>\n");
            print("<TD>" . $resultado['categoria'] . "</TD>\n");
            print("<TD>" . date("j/n/Y", strtotime($resultado['fecha'])) . "</TD>\n");


            if ($resultado['imagen'] != "") {
                print("<TD><A TARDET='_blank' HREF='img/". $resultado['imagen'] . "'><IMG BORDER='0' SRC='img/iconotexto.gif'></A></TD>\n");
            } else {
                print("<TD>&nbsp;</TD>\n");
            }
            print("</TR>\n");
        }
        print ("</TABLE>\n");
    }
    else{
        print ("No hay noticias disponibles");
    }
    ?>
</body>
</HTML>