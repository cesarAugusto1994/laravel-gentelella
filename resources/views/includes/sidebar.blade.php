<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-home"></i> <span>Controle Ativos</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bem Vindo,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Painel</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-laptop"></i> Equipamentos <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{route('equipments')}}">Listagem</a>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::user()->isAdmin())
                      <li><a><i class="fa fa-laptop"></i> Gerencial <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                              <li><a href="{{route('warehouses')}}">Estoques</a></li>
                              <li><a href="{{route('models')}}">Modelos</a></li>
                              <li><a href="{{route('statuses')}}">Situações</a></li>
                              <li><a href="{{route('subjects')}}">Assuntos Chamados</a></li>
                              <li><a href="{{route('users')}}">Usuários</a></li>
                          </ul>
                      </li>
                        <li><a><i class="fa fa-laptop"></i> Cadastros <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('equipments_create')}}">Equipamentos</a></li>
                                <li><a href="{{route('warehouses_create')}}">Estoques</a></li>
                                <li><a href="{{route('models_create')}}">Modelos</a></li>
                                <li><a href="{{route('status_create')}}">Situações</a></li>
                                <li><a href="{{route('subjects_create')}}">Assuntos Chamados</a></li>
                                <li><a href="{{route('users_create')}}">Usuários</a></li>
                            </ul>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('calls')}}">
                            <i class="fa fa-calendar"></i>
                            Solicitar Equipamentos
                        </a>
                    </li>
                    @if(Auth::user()->isAdmin())
                    <li>
                        <a href="{{route('calls_entry')}}">
                            <i class="fa fa-calendar"></i>
                            Entrada Equipamentos
                        </a>
                    </li>
                    <li>
                        <a href="{{route('screenings')}}">
                            <i class="fa fa-calendar"></i>
                            Triagem
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports') }}">
                            <i class="fa fa-file-pdf-o"></i>
                            Relatorios
                        </a>
                    </li>
                     @endif
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">

        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
