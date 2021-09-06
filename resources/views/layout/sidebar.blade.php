<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('img/ONFP.png') }}" class="img-fluid logo_onfp w-75" alt="LOGO">
        </div>
        <div class="sidebar-brand-text mx-3">ONFP<sup>{{ __('1') }}</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
@else
    @endhasrole

    <!-- Nav Item - Dashboard -->
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
@else
<li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">
        <span data-feather="home"></span>
        <span>Accueil</span></a>
</li>
    @endhasrole
    @unlessrole('Nologin')
    <hr class="sidebar-divider my-0">
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white">
        <a class="nav-link d-flex align-items-center text-white"
            href="{{ route('profiles.show', ['user' => auth()->user()]) }}">
            <span data-feather="user"></span>
            <span> Gérer mon profil </span>
        </a>
    </h6>
@else
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white">
        <a class="nav-link d-flex align-items-center text-white" href="{{ url('/home') }}">
            <span data-feather="user"></span>
            <span> Gérer mon profil </span>
        </a>
    </h6>
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire|Courrier|ACourrier')
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages_courrier"
            aria-expanded="true" aria-controls="collapsePages_courrier">
            <span data-feather="mail"></span>
            <span>Gestion du courrier</span>
        </a>
        <div id="collapsePages_courrier" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('courriers.index') }}">
                    <span>Tous</span>
                </a>
                <a class="collapse-item" href="{{ route('recues.index') }}">
                    <span>Courrier arrivé</span>
                </a>
                <a class="collapse-item" href="{{ route('departs.index') }}">
                    <span>Courrier départ</span>
                </a>
                <a class="collapse-item" href="{{ route('internes.index') }}">
                    <span>Courrier interne</span>
                </a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire|DIOF|ADIOF')
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('demandeurs.index') }}" data-toggle="collapse"
            data-target="#collapsePages_demande" aria-expanded="true" aria-controls="collapsePages_demande">
            <span data-feather="layers"></span>
            <span>Gestion des demandes</span>
        </a>
        <div id="collapsePages_demande" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('demandeurs.index') }}">
                    <span>Toutes</span>
                </a>
                <a class="collapse-item" href="{{ route('individuelles.index') }}">
                    <span>individuelles</span>
                </a>
                <a class="collapse-item" href="{{ route('collectives.index') }}">
                    <span>collectives</span>
                </a>
                <a class="collapse-item" href="{{ route('pcharges.index') }}">
                    <span>Prise en charge</span>
                </a>
            </div>
        </div>
    </li>
@else
{{--      <li class="nav-item">
        <a class="nav-link" href="{{ route('individuelles.create') }}">
            <span data-feather="users"></span>
            <span>Demande individuelle</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('collectives.create') }}">
            <span data-feather="users"></span>
            <span>Demande collective</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pcharges.create') }}">
            <span data-feather="users"></span>
            <span>Demande prise en charge</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('operateurs.create') }}">
            <span data-feather="users"></span>
            <span>Devenir opérateur</span>
        </a>
    </li>  --}}
    <hr class="sidebar-divider my-0">
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire|DIOF|DEC|ADEC|ADIOF')
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages_formation"
            aria-expanded="true" aria-controls="collapsePages_formation">
            <span data-feather="layers"></span>
            <span>Gestion des formations</span>
        </a>
        <div id="collapsePages_formation" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('formations.index') }}">
                    <span>Toutes</span>
                </a>
                <a class="collapse-item" href="{{ route('findividuelles.index') }}">
                    <span>individuelles</span>
                </a>
                <a class="collapse-item" href="{{ route('fcollectives.index') }}">
                    <span>collectives</span>
                </a>
            </div>
        </div>
    </li>
@else
    @endhasrole


    @hasrole('super-admin|Administrateur|Gestionnaire|Courrier|ACourrier')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pcharges.index') }}">
            <span data-feather="folder"></span>
            <span>Prises en charge</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('scolarites.index') }}">
            <span data-feather="folder"></span>
            <span>Scolarité</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('operateurs.index') }}">
            <span data-feather="users"></span>
            <span>Gestion opérateurs</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages_localite"
            aria-expanded="true" aria-controls="collapsePages_localite">
            <span data-feather="layers"></span>
            <span>Localités</span>
        </a>
        <div id="collapsePages_localite" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('regions.index') }}">
                    <span>Régions</span>
                </a>
                <a class="collapse-item" href="{{ route('departements.index') }}">
                    <span>Départements</span>
                </a>
                <a class="collapse-item" href="{{ route('arrondissements.index') }}">
                    <span>Arrondissements</span>
                </a>
                <a class="collapse-item" href="{{ route('communes.index') }}">
                    <span>Communes</span>
                </a>
            </div>
        </div>
    </li>
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|DAF|FDAF|RHDAF|LOGDAF')
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
                    <a class="collapse-item" href="{{ route('bordereaus.index') }}">
                        <span>Bordereaux</span>
                    </a>
                    <a class="collapse-item" href="{{ route('facturesdafs.index') }}">
                        <span>Factures</span>
                    </a>
                    <a class="collapse-item" href="{{ route('tresors.index') }}">
                        <span>Recettes Trésor</span>
                    </a>
                    <a class="collapse-item" href="{{ route('banques.index') }}">
                        <span>Frais Bancaire</span>
                    </a>
                    <a class="collapse-item" href="{{ route('bordereaus.index') }}">
                        <span>Ordres de missions</span>
                    </a>
                    <a class="collapse-item" href="{{ route('bordereaus.index') }}">
                        <span>Etat paiement</span>
                    </a>
                    <a class="collapse-item" href="{{ route('bordereaus.index') }}">
                        <span>EPP</span>
                    </a>
                    <a class="collapse-item" href="{{ route('bordereaus.index') }}">
                        <span>FAD</span>
                    </a>
                @endguest
            </div>
        </div>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|DAF|DPP|ADPP|PRDPP|PLDPP')
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
                    <a class="collapse-item" href="{{ route('activites.index') }}">
                        <span>Activites</span>
                    </a>
                    <a class="collapse-item" href="{{ route('projets.index') }}">
                        <span>Projets</span>
                    </a>
                    <a class="collapse-item" href="{{ route('depenses.index') }}">
                        <span>Dépenses</span>
                    </a>
                @endguest
            </div>
        </div>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('nineas.index') }}">
            <span data-feather="users"></span>
            <span>Nineas</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ingenieurs.index') }}">
            <span data-feather="users"></span>
            <span>Ingénieurs</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('etablissements.index') }}">
            <span data-feather="layers"></span>
            <span>Etablissements</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('filieres.index') }}">
            <span data-feather="layers"></span>
            <span>Filières</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('filierespecialites.index') }}">
            <span data-feather="layers"></span>
            <span>Filières spécialités</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|DAF|RHDAF')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('employees.index') }}">
            <span data-feather="users"></span>
            <span>Gestion des employees</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('directions.index') }}">
            <span data-feather="layers"></span>
            <span>Directions / Services</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('secteurs.index') }}">
            <span data-feather="layers"></span>
            <span>Secteurs</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('domaines.index') }}">
            <span data-feather="layers"></span>
            <span>Domaines</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('modules.index') }}">
            <span data-feather="layers"></span>
            <span>Modules</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('diplomes.index') }}">
            <span data-feather="layers"></span>
            <span>Diplômes</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('options.index') }}">
            <span data-feather="layers"></span>
            <span>Option diplômes</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire|DIOF')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('programmes.index') }}">
            <span data-feather="layers"></span>
            <span>Programmes</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur|Gestionnaire')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('niveauxs.index') }}">
            <span data-feather="layers"></span>
            <span>Niveaux</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('specialites.index') }}">
            <span data-feather="layers"></span>
            <span>Spécialités</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
@else
    @endhasrole
    @hasrole('super-admin|Administrateur')
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
                    <a class="collapse-item" href="{{ route('administrateurs.index') }}">
                        <span data-feather="user"></span>
                        <span>Administrateurs</span>
                    </a>
                    <a class="collapse-item" href="{{ route('gestionnaires.index') }}">
                        <span data-feather="user"></span>
                        <span>Gestionnaires</span>
                    </a>
                    </a>
                    <a class="collapse-item" href="{{ route('users.index') }}">
                        <span data-feather="user"></span>
                        <span>Utilisateurs</span>
                    </a>
                    <a class="collapse-item" href="{{ route('roles.index') }}">
                        <span data-feather="user"></span>
                        <span>Roles</span>
                    </a>
                @endguest
            </div>
        </div>
    </li>
@else
    @endhasrole
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
