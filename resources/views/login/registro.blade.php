@include('/generico/header_login')
<div class="container">
    <div class="row">
        <div class="col m2"></div>
        <form id="registrarse" action="/logearse" method="post" class="col m8 s12 card" style="padding:50px">
            {{ csrf_field() }}
            <h5 class="center-align">Registrarse</h5>
            <div class="row" style="margin-top:30px">
                <div class="input-field col s6">
                    <input name="nombre" id="nombre" type="text" class="validate">
                    <label for="nombre">Nombre</label>
                </div>
                <div class="input-field col s6">
                    <input name="apelldo" id="apelldo" type="text" class="validate">
                    <label for="apelldo">Apellido</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input name="email" id="email" type="password" class="validate">
                    <label for="email">email</label>
                </div>
                <div class="input-field col s6">
                    <input name="contraseña" id="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10">
                    <input name="r_password" id="r_password" type="password" class="validate">
                    <label for="r_password">Repetir Password</label>
                </div>
            </div>
            <small>
                <a href="/login">Logearse</a>
                <br>
                <a href="/reset-password">Olvide mi contraseña</a>
            </small>
            <div class="row right-align">                
                <button class="btn waves-effect waves-light purple darken-4" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
                        
            </div>
        </form>
    </div>
                
</div>

@include('/generico/footer')