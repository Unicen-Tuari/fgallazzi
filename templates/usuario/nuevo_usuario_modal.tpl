
{extends file="layout-trastos-ajax.tpl"}


{block name = scriptJS}
  <script type="text/javascript" src="js/jquery.form.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/additional-methods.min.js"></script>
  <script type="text/javascript" src="js/formNuevoUsuario.js"></script>
{/block}

{block name = body}

<div class="modal fade" id="modal-nuevo-usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Trastos.com <small>Registrarme</small></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class = "col-sm-6 col-sm-push-3"> 
            <form class="form-horizontal" role="form" id = "form_nuevo_usuario" action = "index.php">
              <div class="form-group">
                <label class="sr-only" for="nombre">Nombre</label>
                <div class="marca">
                  <input type="text" class="form-control" id="nombre" name="nombre"
                       placeholder="Nombre">
                </div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="apellido">Apellido</label>
                <div class="marca">
                  <input type="text" class="form-control" id="apellido" name="apellido"
                       placeholder="Apellido">
                </div>
              </div>
              
              <div class="form-group">
                <label class="sr-only" for="email">Email</label>
                <div class="marca">
                  <input type="text" class="form-control" id="email" name="email"
                       placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="telefono">Telefono</label>
                <div class="marca">
                  <input type="text" class="form-control" id="telefono" name="telefono"
                       placeholder="Telefono">
                </div>
              </div>

              <div class="form-group">
                <label class="sr-only" for="password">Contraseña</label>
                <div class = "marca">
                  <input type="password" class="form-control" id="password" name="password"
                       placeholder="Contraseña">
                </div>
                
              </div>
              <div class="form-group">
                <label class="sr-only" for="passwordConfirm">Confirme la contraseña</label>
                <div class = "marca">
                  <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm"
                       placeholder="Confirme la contraseña">
                </div>
                
              </div>
              
            </form>
            
          </div>  
          
        </div>
        

        
      </div>
      <div class="modal-footer">

        <button type="submit" name = "enviar" form = "form_nuevo_usuario" class="btn btn-default" >Guardar</button>
       
      </div>
    </div>
  </div>
</div>

{/block}