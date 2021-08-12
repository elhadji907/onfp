<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    @hasrole('Administrateur|Courrier|Gestionnaire|Demandeur')
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('img/ONFP.png') }}" class="img-fluid logo_onfp w-75" alt="LOGO">
        </div>
        <div class="sidebar-brand-text mx-3">ONFP<sup>{{ __('1') }}</sup></div>
    </a>
    @else
    @endhasrole
   

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @hasrole('Demandeur')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
       
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
       
    </li>
    @else
    @endhasrole

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/home') }}">
            <span data-feather="home"></span>
            <span>Accueil</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white">
        <a class="nav-link d-flex align-items-center text-white"
            href="{{ route('profiles.show', ['user' => auth()->user()]) }}">
            {{-- <span data-feather="settings"></span> --}}

            <span data-feather="user"></span>
            <span> Gérer mon profil </span>
        </a>
    </h6>
   <class="sidebar-divider my-0">
  {{--    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white">
        <a class="nav-link d-flex align-items-center text-white" href="#">
            <span data-feather="settings"></span>

            <span data-feather="user"></span>
            <span>Programme PDCEJ </span>
        </a>
    </h6>  --}}
   
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse"
             data-target="#collapsePages_courrier" aria-expanded="true" aria-controls="collapsePages_courrier">
             <span data-feather="mail"></span>
             <span>Gestion du courrier</span>
         </a>
         <div id="collapsePages_courrier" class="collapse" aria-labelledby="headingPages"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="#">
                     <span>Tous</span>
                 </a>
                 <a class="collapse-item" href="#">
                     <span>Courrier arrivé</span>
                 </a>
                 <a class="collapse-item" href="#">
                     <span>Courrier départ</span>
                 </a>
                 <a class="collapse-item" href="#">
                     <span>Courrier interne</span>
                 </a>
             </div>
         </div>
     </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse"
            data-target="#collapsePages_demande" aria-expanded="true" aria-controls="collapsePages_demande">
            <span data-feather="layers"></span>
            <span>Gestion des demandes</span>
        </a>
        <div id="collapsePages_demande" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">
                    <span>Toutes</span>
                </a>
                <a class="collapse-item" href="#">
                    <span>individuelles</span>
                </a>
                <a class="collapse-item" href="#">
                    <span>collectives</span>
                </a>
            </div>
        </div>
       
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
       <a class="nav-link collapsed" href="" data-toggle="collapse"
            data-target="#collapsePages_formation" aria-expanded="true" aria-controls="collapsePages_formation">
            <span data-feather="layers"></span>
            <span>Gestion des formations</span>
        </a>
        <div id="collapsePages_formation" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">
                    <span>Toutes</span>
                </a>
                <a class="collapse-item" href="#">
                    <span>individuelles</span>
                </a>
                <a class="collapse-item" href="#">
                    <span>collectives</span>
                </a>
            </div>
        </div>
       
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
       <a class="nav-link collapsed" href="" data-toggle="collapse"
            data-target="#collapsePages_localite" aria-expanded="true" aria-controls="collapsePages_localite">
            <span data-feather="layers"></span>
            <span>Localités</span>
        </a>
        <div id="collapsePages_localite" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">
                    <span>Régions</span>
                </a>
                <a class="collapse-item" href="#">
                    <span>Départements</span>
                </a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages_daf"
            aria-expanded="true" aria-controls="collapsePages_daf">
            <span data-feather="folder"></span>
            <span>DOSSIERS DAF</span>
        </a>
        <div id="collapsePages_daf" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @guest
                    <a class="collapse-item" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                    @if (Route::has('register'))
                        <a class="collapse-item" href="{{ route('register') }}">{{ __("S'inscrire") }}</a>
                    @endif
                @else
                    <a class="collapse-item" href="#">
                        <span>Bordereaux</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>Factures</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>Recettes Trésor</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>Frais Bancaire</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>Ordres de missions</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>Etat paiement</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>EPP</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>FAD</span>
                    </a>
                @endguest
            </div>
        </div>
       
    </li>
    <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages_projet"
            aria-expanded="true" aria-controls="collapsePages_projet">
            <span data-feather="folder"></span>
            <span>PROJETS</span>
        </a>
       
        <div id="collapsePages_projet" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header"></h6> --}}
                @guest
                    <a class="collapse-item" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                    @if (Route::has('register'))
                        <a class="collapse-item" href="{{ route('register') }}">{{ __("S'inscrire") }}</a>
                    @endif
                @else
                    {{-- <h6 class="collapse-header">UTILISATEURS</h6> --}}
                    <a class="collapse-item" href="#">
                        <span>Activites</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>Projets</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span>Dépenses</span>
                    </a>
                @endguest
            </div>
        </div>
    </li>

    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="users"></span>
            <span>Gestion opérateurs</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="users"></span>
            <span>Nineas</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="users"></span>
            <span>Ingénieurs</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Gestion demandes</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Lister demandes</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Gestion des employees</span>
        </a>
       
    </li>
    <li class="nav-item">
       
        <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Directions / Services</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Secteurs</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Domaines</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Modules</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Diplômes</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Option diplômes</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Programmes</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            <span>Niveaux</span>
        </a>
       
    </li>
    <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <span data-feather="folder"></span>
            <span>Pages</span>
        </a>
       
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Écrans de connexion:</h6>
                <a class="collapse-item" href="{{ route('profiles.show', ['user' => auth()->user()]) }}">
                    {{-- {{ str_limit(Auth::user()->email, 18, '...') }} --}}
                </a>
                <!-- Authentication Links -->
                @guest
                    <a class="collapse-item" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                    @if (Route::has('register'))
                        <a class="collapse-item" href="{{ route('register') }}">{{ __("S'inscrire") }}</a>
                    @endif
                @else
                    <h6 class="collapse-header">UTILISATEURS</h6>
                    <a class="collapse-item" href="#">
                        <span data-feather="user"></span>
                        <span>Administrateurs</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span data-feather="user"></span>
                        <span>Gestionnaires</span>
                    </a>
                    </a>
                    <a class="collapse-item" href="#">
                        <span data-feather="user"></span>
                        <span>Villages</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <span data-feather="user"></span>
                        <span>Utilisateurs</span>
                    </a>
                @endguest
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
