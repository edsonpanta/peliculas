<?php 

require_once(APP_DIR_CLASS . 'configuracion/men_peliculas.class.php');

class InterfazPeliculas
{
	
	function interfazPrincipal(){

		$titulo = 'Listado de Peliculas';

		$html = '<ul class="breadcrumb">                            
                    <li>
                    	<a href="'. APP_INDEX .'" style="color: orangered;">Inicio</a><span class="divider">&raquo;</span>
                    </li>
                    <li>'.$titulo.'</li>
                </ul>

                <div id="ajaxFormulario"></div>
                ';

        $html .='<div class="well form-inline">
                           
                    <div class="nonboxy-widget ">
                                
                        <div class="widget-head">
                            <h5 class="pull-left"><i class="black-icons list_images"></i>'.$titulo.'</h5>
                        </div> 

                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered table-condensed table-hover">

                                        <thead>
                                            <tr>
                                                <th style="width: 1%; text-align: center">Nro.</th>
                                                <th style="width: 1%; text-align: center" colspan=""></th>
                                                <th style="width: 20%; text-align: center">Titulo</th>
                                                
                                            </tr>
                                        </thead>

                 	                    <tbody id="td_listado">
                 	                    '.$this->interfazListado().'
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>';

		return $html;
	}

    function interfazListado(){

        $html = '';
        $contador = 0;

        $obj = new MenPelicula();
        $response = $obj->consultarPeliculas(1);
        $datos = json_decode($response);

        $msg = $datos->results;

        if ($response == "1"){  
            $html = showEror($obj->getMsgErr()); 
        }else{
            foreach ($msg as $key => $value) {

                $html .= '
                <tr>
                    <td style="text-align: center">' . (++$contador) . '</td> 

                    <td style="text-align: center">
                        <a title = "'.MSG_0010.'" href = javascript:void(0) 
                        onclick="
                            xajax__InterfazPeliculaFormulario(\''.$value->url.'\');
                        ">
                        <i class="color-icons icons_editar"></i>
                        </a>                       
                    </td>
                    <td style="text-align: center">'.$value->title.'</td>
                    
                    
                </tr>'; 
            }

        }
        return $html;
    }

    function formularioPelicula($url=''){

        $html = '

        <div class="modal" id="modal-default" data-backdrop="static" >
            <div class="modal-dialog" style="width: 70%">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="formTitle01">Detalle de la Pelicula</h4>
                    </div>  

                    <div class="modal-body">
                            <div class="well-login">
                                <input type="hidden" id="idSalon" name="idPelicula" value="'.$url.'">
                                
                                    <div class="row">

                                        <div class="form-group col-lg-12">
                                            <label>Title:</label>
                                            <input type="text" id="txt_title" name="txt_title" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Opening Crawl:</label>
                                            <input type="textarea" id="txt_opening_crawl" name="txt_opening_crawl" class="form-control" readonly>
                                        </div>
                                
                                        <div class="form-group col-lg-4">
                                            <label>Director:</label>
                                            <input type="text" id="txt_director" name="txt_director" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Producer:</label>
                                            <input type="text" id="txt_producer" name="txt_producer" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Release Date:</label>
                                            <input type="text" id="txt_release_date" name="txt_release_date" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-lg-4">
                                        <label>Personajes:</label>
                                    </div>
                                    </div>
                                    <div class="container-personajes" id="container-personajes">

                                    </div>

                               
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button data-dismiss="modal" type="button" class="btn pull-left">
                            <i class="icon-remove"></i>Cerrar
                        </button> 
                    </div>

                </div>
            </div>
        </div>';

        return $html;
    }

}


function _InterfazPeliculaPrincipal() {

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazPeliculas();
    $html = $objIn->interfazPrincipal();

	$rpta->addScript('
		$(document).ready(function(){
    		$(".table").DataTable();
  		});'
  	);

    $rpta->addAssign("container-fluid", "innerHTML", $html);

	return $rpta;
}

function _interfazpeliculaListado() {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazPeliculas();
    $rptaHtml = $objIn->interfazListado();

    $rpta->addAssign("td_listado", "innerHTML", $rptaHtml);
    
    return $rpta;
}

function _InterfazPeliculaFormulario($url = ''){

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazPeliculas();
    $rpta->addAssign("ajaxFormulario", "innerHTML", $objIn->formularioPelicula($url));
    
    $obj = new MenPelicula();
    $response = $obj->peliculaDetalle($url);
    $resultado = json_decode($response, true);

    $rpta->addAssign("txt_title","value",$resultado["title"]);
    $rpta->addAssign("txt_opening_crawl","value",$resultado["opening_crawl"]);
    $rpta->addAssign("txt_director","value",$resultado["director"]);
    $rpta->addAssign("txt_producer","value",$resultado["producer"]);
    $rpta->addAssign("txt_release_date","value",$resultado["release_date"]);
    $rpta->addAssign("container-personajes","innerHTML", getListadoPersonajes($resultado["characters"]));
    

    $rpta->addScript("
            $('#modal-default').modal('show');
        ");


    return $rpta;
    
}


function  getListadoPersonajes($datosPersonajes){

    $obj = new MenPelicula();
    $cantidad = count($datosPersonajes);

    $html = "";



    $html = '<div class="well form-inline">
                    <div class="nonboxy-widget ">        
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%; text-align: center">Personaje</th>                                                
                                            </tr>
                                        </thead> ';

    for ($i=0; $i < $cantidad; $i++) { 
        
        $response = $obj->peliculaDetalle($datosPersonajes[$i]);
        $resultado = json_decode($response, true);

        $html .='

                 	                    <tbody id="td_listado">
                                            <tr>
                                                <td style="text-align: center">'.$resultado['name'].'</td>
                                            </tr>
                                        </tbody>

                                   ';


    }

    $html .=' </table>

    </div>
</div>
</div>

</div>
</div>';


    return $html;
}

$xajax->registerFunction("_InterfazPeliculaPrincipal");
$xajax->registerFunction("_interfazpeliculaListado");
$xajax->registerFunction("_InterfazPeliculaFormulario");

?>
