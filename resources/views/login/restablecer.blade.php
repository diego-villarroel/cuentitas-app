@include('/generico/header_login')
<div class="container">
    <div class="row">
        <div class="col m2"></div>
        <form id="restablecer" action="/regenerar-clave" method="post" class="col m8 s12 card" style="padding:50px">
            {{ csrf_field() }}
            <h5 class="center-align">Restablecer Contraseña</h5>
            <div class="row" style="margin-top:30px">
                <div class="input-field col s10">
                    <input name="email" id="first_name" type="text" class="validate">
                    <label for="first_name">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10">
                    <input name="contraseña" id="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <small>
                <a href="/login">Logearse</a>
                <br>
                <a href="/registro">Registrarme</a>
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