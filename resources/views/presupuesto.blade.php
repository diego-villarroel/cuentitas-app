@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m7">
                <h4>Presupuesto</h4>
            </div>
            <div class="col s12 m5 right-align">
                <button class="btn light-green darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_tipo_presu">Nuevo Tipo Presu</button>
            </div>
            <div class="col s12 m5 right-align" style="margin-top:20px">
                <button class="btn light-green darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_presu">Nuevo Presu</button>
            </div>
        </div>
        @if (!empty($presupuestos) ) 
            <div class="row">
                @foreach ( $presupuestos as $presu)
                    <div class="col s12 m4">
                        <div class="card purple darken-4">
                            <div class="card-content white-text">
                                <span class="card-title">{{ $presu->nombre_presupuesto}} @foreach($tipos_presupuestos as $tp) @if($tp->id_tipo_presupuesto == $presu->id_tipo_presupuesto) {{ $tp->icono }} @endif @endforeach</span>
                                <p>Estado</p>
                                <h5>
                                    <i class="material-icons dp48 tooltipped @if($presu->monto_presupuesto > $presu->gastado_presupuesto) green-text @else red-text @endif" data-tooltip="Pagado">attach_money</i>
                                </h5>
                                <p>Monto:</p>
                                <h5>$ {{ $presu->string_monto_presupuesto }}</h5>
                                <p>Mes:</p>
                                <h5>{{ $presu->string_mes }}</h5>
                                <p>Gastado:</p>
                                <h5>$ {{ $presu->string_gastado_presupuesto }}</h5>
                            </div>
                            <div class="card-action center-align">
                                <a class="btn-floating red waves-effect tooltipped waves-light modal-trigger nuevo-gasto" data-target="modal_add_gasto" data-tooltip="Nuevo gasto" data-presupuesto="{{ $presu->id_presupuesto }}" data-nombre-presupuesto="{{ $presu->nombre_presupuesto }}"><i class="material-icons dp48">attach_money</i></a>
                                &nbsp;
                                <a class="btn-floating red waves-effect tooltipped waves-light modal-trigger borrar-presu" data-target="modal_borrar_presu" data-tooltip="Borrar presu" data-presupuesto="{{ $presu->id_presupuesto }}" data-nombre-presupuesto="{{ $presu->nombre_presupuesto }}" data-monto="{{$presu->string_monto_presupuesto}}" data-mes="{{$presu->string_mes}}"><i class="material-icons dp48">delete_forever</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <h5 class="center-align">Sin presupuestos</h5>
            </div>
        @endif

        @if ( !empty($gastos) )
        
            <ul class="collapsible popout">
                @foreach ($gastos as $g)
                    @if (!empty($g))
                        <li>
                            <div class="collapsible-header" tabindex="0">
                                <i class="material-icons">filter_drama</i>{{$g[0]->nombre_presupuesto}}
                            </div>
                            <div class="collapsible-body" style="">
                                <input type="hidden" class="graf-presupuestos" value="{{$g[0]->id_gasto}}">
                                <input type="hidden" id="valores-{{$g[0]->id_gasto}}" value="{{$g[0]->gastado_presupuesto}},{{ ($g[0]->monto_presupuesto - $g[0]->gastado_presupuesto) }}">

                                <canvas id="presupuesto-{{$g[0]->id_gasto}}"></canvas>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Nombre</th>
                                            <th>Gasto</th>
                                            <th>Presupuesto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($g as $cada_gasto)
                                        @if ( is_object($cada_gasto) )
                                            <tr>
                                                <td>{{$cada_gasto->fecha}}</td>
                                                <td>{{$cada_gasto->nombre_gasto}}</td>
                                                <td>$ {{$cada_gasto->string_monto}}</td>
                                                
                                                <td>$ {{$cada_gasto->string_monto_presupuesto}}</td>
                                                <td>
                                                    <button class="btn red darken-4 waves-effect waves-light modal-trigger tooltipped borrar-gasto" data-tooltip="Borrar" data-id-gasto="{{$cada_gasto->id_gasto}}" data-monto="{{$cada_gasto->string_monto}}" data-nombre="{{$cada_gasto->nombre_gasto}}" data-fecha="{{$cada_gasto->fecha}}" data-target="modal_confirm_borrar_gasto"><i class="material-icons dp48">delete_forever</i></button>
                                                </td>
                                            </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    @endif
                @endforeach
                <!-- </form> -->
            </ul>
        @endif
    </section>
    <form id="frm-accion-gastos-presupuesto">
        {{ csrf_field() }}
        <input type="hidden" name="accion">
        <input type="hidden" name="id">
        <input type="hidden" name="monto_presupuesto">
    </form>
    <div id="modal_borrar_presu" class="modal">
        <div class="modal-content">
            <h4>Borrar Presupuesto</h4>
            <p>Estas a punto de borrar el presupuesto <span id="nombre_presu_borrar"></span> del mes de <span id="mes_presu_borrar"></span>, que tiene un monto de $ <span id="monto_presu_borrar"></span>.</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn red waves-effect waves-light" id="confirm_borrar_presu">Borrar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_confirm_borrar_gasto" class="modal">
        <div class="modal-content">
            <h4>Borrar Gasto</h4>
            <p>Estas a punto de borrar el gasto llamado <b><span id="nombre_gasto_borrar"></span></b> de la fecha <span id="fecha_gasto_borrar"></span> por un total de: <br> $ <span id="monto_gasto_borrar"></span>.</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn red waves-effect waves-light" id="confirm_borrar_gasto">Borrar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_confirm_pagar_resumen" class="modal">
        <div class="modal-content">
            <h4>Pagar Resumen</h4>
            <p>Estas a punto de pagar el resumen de la tarjeta <span id="tarjeta_resumen_pagar"></span> del periodo <span id="periodo_resumen_pagar"></span>, que tiene un gasto de $<span id="monto_resumen_pagar"></span> y vence el <span id="vencimiento_resumen_pagar"></span>.</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn green waves-effect waves-light" id="confirm_pagar_resumen">Pagar</button>
                </div>
            </div>
        </div>
    </div>
@include('/generico/footer')