
{extends file="layout-trastos-ajax.tpl"}


{block name = scriptJS}
  <script type="text/javascript" src="js/jquery.form.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/additional-methods.min.js"></script>
  <script type="text/javascript" src = "js/formLogin.js"></script>
{/block}

{block name = body}

<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Trastos.com <small>Iniciar Sesi&oacute;n</small></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class = "col-sm-6 col-sm-push-3"> 
            <form class="form-horizontal" role="form" id = "form_sesion_login" action = "index.php">
              <div class="form-group">
                <label class="sr-only" for="usuario">Usuario</label>
                <div class="marca">
                  <input type="text" class="form-control" id="usuario" name="usuario"
                       placeholder="Usuario">
                </div>
                
              </div>
              <div class="form-group">
                <label class="sr-only" for="password">Contraseña</label>
                <div class = "marca">
                  <input type="password" class="form-control" id="password" name="password"
                       placeholder="Contraseña">
                </div>
                
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name = "chk_cerrar_sesion"> No cerrar sesión
                </label>
              </div>
               
              
            </form>
            
          </div>  
          
        </div>
        

        
      </div>
      <div class="modal-footer">
        <button type="submit" name = "enviar" form = "form_sesion_login" class="btn btn-default" >Entrar</button>
       
      </div>
    </div>
  </div>
</div>

{/block}