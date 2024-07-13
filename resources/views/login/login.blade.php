@include('/generico/header_login')
<div class="container">
    <div class="row">
        <div class="col m2"></div>
        <form id="login" class="col m8 s12 card" style="padding:50px">
            {{ csrf_field() }}
            <h5 class="center-align">Login</h5>
            <div class="row" style="margin-top:30px">
                <div class="input-field col s10">
                    <input name="email" id="email" type="email" class="">
                    <label for="email">Email</label>
                    <small class="red-text hide" id="email_aviso">Debe ser en formato email: <i>ejemplo@ejemplo.com</i> </small>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10">
                    <input name="contraseña" id="contraseña" type="password" class="">
                    <label for="contraseña">Password</label>
                    <small class="red-text hide" id="pass_aviso1">Debe contener al menos una MAYÚSCULA</small><br>
                    <small class="red-text hide" id="pass_aviso2">Debe contener al menos un NÚMERO</small><br>
                    <small class="red-text hide" id="pass_aviso3">Debe contener entre 8 y 20 caracteres</small><br>
                </div>
            </div>
            <small>
                <a href="/reset-password">Olvide mi password</a>
                <br>
                <a href="/registro">Registrarme</a>
            </small>
            <div class="row right-align">                
                <button id="logearse" class="btn purple darken-4 waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
                        
            </div>
        </form>
    </div>
                
</div>

@include('/generico/footer')