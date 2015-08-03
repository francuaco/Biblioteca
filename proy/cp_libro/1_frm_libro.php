<?php 
    date_default_timezone_set('America/Guatemala');
    include_once("1_xajax_libro.php");
    session_start();

    $bandera = 0;
    $usuario = $_SESSION['cat'];
    $cls_login = new cls_login();


    $res = $cls_login->trae_usuario($usuario);
        foreach($res as $row){
            $_SESSION['nom'] = trim($row['usu_nom1'])." ".trim($row['usu_nom2']);
            $_SESSION['ape'] = trim($row['usu_ape1'])." ".trim($row['usu_ape2']);
            $_SESSION['nom_ape'] = trim($row['usu_nom1'])." ".trim($row['usu_ape1']);
            $arma = $row['arm_desc_md'];
            $armcod = $row['usu_arma'];
            $_SESSION['gra'] = $row['gra_desc_md'];
            $gracod = $row['usu_grado'];
            $nivel = $row['usu_nivel'];
            $_SESSION['nivel'] = $nivel;            
            $curso = $row['usu_curso'];
            $_SESSION['curso'] = $curso;
            $_SESSION['fec_u'] = $row['usu_fecha_pass'];
            $_SESSION['dias'] = $row['usu_dias_pass'];
            $avilita = $row['usu_avilita'];
            $_SESSION['usu_situacion'] = $row['usu_situacion'];
        }

        if ($gracod > 40 && $gracod < 90){
            $bandera = 1;
        }
        if($armcod != 6 && $bandera == 1){
            $_SESSION['arma'] = 'DE '.$arma;
        }else{
            $_SESSION['arma'] = " ";
        }
    
    //================CAMBIA PASSWORD====================
    if ($avilita == 1){
        $cls_util = new cls_util();
        $usuario = $cls_util->encrypt($usuario, 'A');
        header('Location: ../cp_usuario/0_frm_usuario.php?id='.$usuario.'');
    }
    //=================USUARIO ACTIVO=====================
    if ($_SESSION['usu_situacion'] != 1){
       
        header('Location: ../cp_login/logout.php');
    }
    //===================================================

        $verificar = $_GET['valor'];

        

?>
<!DOCTYPE html>
<html lang="en">
    <!-- ==================================================================================== -->
    <!-- ===================================SCRIPTS GENERALES================================ -->
    <!-- ==================================================================================== -->
    <head>
        <?php
            include_once("../cp_menu/frm_menu_script_top.php");
        ?>
        <!-- ==============================SCRIPTS ESPECIFICOS=============================== -->
        <!-- <link rel="stylesheet" href="css/css.css" /> -->
        <script src="js/1_js.js"></script>
        <!-- ================================================================================ -->
    </head>
    <!-- ==================================================================================== -->
    <!-- ===================================BODY============================================= -->
    <!-- ==================================================================================== -->
    <body class="no-skin">
        <!-- ==============================MENU DE ARRIBA==================================== -->
        <?php
            include_once("../cp_menu/frm_menu_top.php");
        ?>
        <!-- ==============================MENU DEL LADO IZQUIERDO=========================== -->
        <!-- /section:basics/navbar.layout -->
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
            <?php
                include_once("../cp_menu/frm_menu_sidebar.php");
                // ==============================INICIA AREA DE TRABAJO====================== -->
                include_once("../cp_menu/frm_menu_page.php");
            ?>
            

            
            <!-- ==================================================================================== -->
            <!-- ========================== INICIA AREA DE TRABAJO ================================== -->
            <!-- ==================================================================================== -->
            <div class="page-header">
                <h1>
                    Libro
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                            Agregar
                    </small>
                </h1>
            </div>

            <?php 
                if($verificar == 0){

                }elseif ($verificar == 1) {
            ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Exitoso!</strong> La carga se hizo correctamente.
                </div>
            <?php    
                }elseif ($verificar == 2) {
            ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> Hubo error en el proceso, Contacte a su Administrador.
                </div>
            <?php
                }elseif ($verificar == 3) {
            ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Alerta!</strong> No se permiten Archivos Mayores a 1 Gb.
                </div>
            <?php
                }elseif ($verificar == 4) {
            ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Alerta!</strong> El Tipo de Archivo es incorrecto, solo se aceptan Archivos formato PDF
                </div>
            <?php
                }elseif ($verificar == 5) {
            ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Alerta!</strong> Seleccione un Archivo PDF, no puede ir Vacio...
                </div>
            <?php
                }

            ?>
                
            <div class="row">

                <div class="col-sm-3"></div>

                <div class="col-sm-6" id="div_all">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Formulario</h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <form id="form" enctype="multipart/form-data" method='POST' action='upload.php'>
                                    <!-- <legend>Form</legend> -->
                                    <fieldset>
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="lib_descripcion">Nombre del Libro</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="lib_descripcion" id="lib_descripcion" class="form-control" placeholder="Descripcion"  />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="lib_autor">Autor del Libro</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <input type="text" name="lib_autor" id="lib_autor" class="form-control" placeholder="Autor" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="lib_categoria">Categoria del Libro</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <select name="lib_categoria" id="lib_categoria" class="form-control">
                                                        <option value = ''>-- Seleccione --</option>
                                                        <option value = '1'>PAGO</option>
                                                        <option value = '2'>PUBLICO</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="lib_cursos">Cursos</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </span>

                                                    <?php echo combo_cursos(); ?>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="file">Seleccionar Libro</label>

                                            </div>
                                            <div class="col-sm-8">
                                                <div class="widget-box">
                                                    

                                                    <div class="widget-body">
                                                        <div class="widget-main">
                                                            

                                                            <div class="form-group">
                                                                <div class="col-xs-12">
                                                                    <input  name="id-input-file-3" type="file" id="id-input-file-3" />

                                                                    
                                                                </div>
                                                            </div>

                                                            <!-- #section:custom/file-input.filter -->
                                                            <label>
                                                                
                                                                <span >.</span>
                                                            </label>

                                                            <!-- /section:custom/file-input.filter -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                    </fieldset>

                                    <div class="form-actions center">
                                        <a href="../cp_menu/frm_menu.php"><input type="button" class="btn btn-sm" value="Cancelar" /></a>
                                            
                                            
                                       
                                        <a href="../cp_libro/1_frm_libro.php?valor=0"><input type="button" class="btn btn-sm btn-yellow" value='Limpiar'></a>
                                                                                     
                                        <input type="button" class="btn btn-sm btn-success" value="Aceptar" onclick="validar();">
                                            
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-3"></div>

                
            </div>

            <!-- ==================================================================================== -->
            <!-- ========================== TERMINA AREA DE TRABAJO ================================= -->
            <!-- ==================================================================================== -->

            <!-- ========================== INICIA FOOTER =========================================== -->

            <?php
                include_once('../cp_menu/frm_menu_footer.php');
            ?>

            <!-- ========================== TEMINA FOOTER ======================================= -->

        </div><!-- /.main-container -->

        <!-- ==================================================================================== -->
        <!-- ========================== INICIA SCRIPTS DE FIN DE DOCUMENTO======================= -->
        <!-- ==================================================================================== -->

        <?php
            include_once('../cp_menu/frm_menu_script_bot.php');
        ?>  
        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {          
            
                $('#id-input-file-3').ace_file_input({
                    style:'well',
                    btn_choose:'Arrastre aqui el Libro o click para Seleccionarlo',
                    btn_change:null,
                    no_icon:'ace-icon fa fa-cloud-upload',
                    droppable:true,
                    thumbnail:'large',//large | fit
                    maxSize: 5000000,//bytes
                    allowExt: ["pdf", "doc", "docx"]
                    // allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"]

                    //,icon_remove:null//set null, to hide remove/reset button
                    /**,before_change:function(files, dropped) {
                        //Check an example below
                        //or examples/file-upload.html
                        return true;
                    }*/
                    /**,before_remove : function() {
                        return true;
                    }*/
                    

                    ,
                    preview_error : function(filename, error_code) {
                        //name of the file that failed
                        //error_code values
                        //1 = 'FILE_LOAD_FAILED',
                        //2 = 'IMAGE_LOAD_FAILED',
                        //3 = 'THUMBNAIL_FAILED'
                        //alert(error_code);
                    }
                    
            
                })

               $('#id-input-file-3').on('file.error.ace', function(ev, info) {
                    if(info.error_count['ext']) alert('Solo Archivos pdf, doc, docx, Estan Permitidos!');
                    if(info.error_count['size']) alert('El tamaño del Archivo no puede ser mayor a 5 Mb!');
                    
                    //you can reset previous selection on error
                    //ev.preventDefault();
                    //file_input.ace_file_input('reset_input');
                });
// .on('change', function(){
                    //console.log($(this).data('ace_input_files'));
                    //console.log($(this).data('ace_input_method'));
                // });



                
                $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
                .closest('.ace-spinner')
                .on('changed.fu.spinbox', function(){
                    //alert($('#spinner1').val())
                }); 
                $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
                $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
                $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
            
                
                
                $(document).one('ajaxloadstart.page', function(e) {
                    $('textarea[class*=autosize]').trigger('autosize.destroy');
                    $('.limiterBox,.autosizejs').remove();
                    $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
                });
                
            });
        </script>

        <!-- ==================================================================================== -->
        <!-- ========================== TERMINA SCRIPTS DE FIN DE DOCUMENTO====================== -->
        <!-- ==================================================================================== -->

    </body>
</html>