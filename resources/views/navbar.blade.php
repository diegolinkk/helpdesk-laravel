<nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item"> <a class="nav-link active" aria-current="page" href="{{route('ticket_list')}}">Sistema de Chamados</a> </li>
            <li class="nav-item"> <a class="nav-link" href="{{route('team_list')}}" >Equipes</a> </li>
            <li class="nav-item"> <a class="nav-link disabled " href="#">Usuários</a> </li>
            @if(Auth::user()->is_admin == true)
            <li class="nav-item"><a href="{{route('manage_team')}}" class="nav-link">Gerenciar equipes</a></li>
            @endif
        </ul>
      </div>
  </nav>