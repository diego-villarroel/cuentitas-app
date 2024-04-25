<section class="menu">
    <ul class="pc-menu">
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn" href="/">🏠 Inicio</a>
        </li>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn" href="{{ env('URL_HOST') }}/cauciones">💲 Cauciones</a>
        </li>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn" href="{{ env('URL_HOST') }}/plazos-fijos">🏛️ Plazos Fijos</a>
        </li>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn" href="{{ env('URL_HOST') }}/servicios">💡 Servicios
            </a>
        </li>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn" href="{{ env('URL_HOST') }}/tarjetas">💳 Tarjetas
            </a>
        </li>
        <span class="new badge"></span>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn" href="" disabled>🦈 Cartera de Inversiones</a>
        </li>
        <hr>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn" href="{{ env('URL_HOST') }}/cerrar-sesion">⏻ Cerrar Session de {{Session::get('usuario')['nombre']}}</a>
        </li>
    </ul>
    <ul class="mobile-menu">
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn tooltipped" data-position="right" data-tooltip="Inicio" href="/">🏠</a>
        </li>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn tooltipped" data-position="right" data-tooltip="Cauciones" href="{{ env('URL_HOST') }}/cauciones">💲</a>
        </li>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn tooltipped" data-position="right" data-tooltip="Plazos Fijos" href="{{ env('URL_HOST') }}/plazos-fijos">🏛️</a>
        </li>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn tooltipped" data-position="right" data-tooltip="Servicios" href="{{ env('URL_HOST') }}/servicios">💡</a>
        </li>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn tooltipped" data-position="right" data-tooltip="Tarjetas" href="{{ env('URL_HOST') }}/tarjetas">💳</a>
        </li>
        <span class="new badge"></span>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn tooltipped" data-position="right" data-tooltip="Cartera de Inversiones" href="" disabled>🦈</a>
        </li>
        <hr>
        <li>
            <a class="waves-effect waves-teal btn-flat menu-btn tooltipped" href="{{ env('URL_HOST') }}/cerrar-sesion" data-position="right" data-tooltip="Cerrar Session de {{Session::get('usuario')['nombre']}}">⏻</a>
        </li>
    </ul>
</section>