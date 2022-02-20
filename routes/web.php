<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\RecueController;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\InterneController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GestionnaireController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\DemandeurController;
use App\Http\Controllers\IndividuelleController;
use App\Http\Controllers\FindividuelleController;
use App\Http\Controllers\CollectiveController;
use App\Http\Controllers\PchargeController;
use App\Http\Controllers\FcollectiveController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\NiveauxController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OperateurController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\NineaController;
use App\Http\Controllers\IngenieurController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FacturedafController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\EtatspreviController;
use App\Http\Controllers\BanqueController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\BordereauController;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\TresorController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\FilierespecialiteController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\ScolariteController;
use App\Http\Controllers\AntenneController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AgerouteController;
use App\Http\Controllers\AgeroutelocaliteController;
use App\Http\Controllers\AgeroutezoneController;
use App\Http\Controllers\AgeroutemoduleController;
use App\Http\Controllers\AgerouteindividuelleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::group([
    'middleware' => 'App\Http\Middleware\Auth',
    ], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/profiles/{user}', [ProfileController::class, 'show'])->name('profiles.show');
        Route::get('/profiles/{user}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
        Route::patch('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');
        Route::get('/postes/create', [PosteController::class, 'create'])->name('postes.create');
        Route::post('/postes', [PosteController::class, 'store'])->name('postes.store');
        Route::get('/postes/{poste}', [PosteController::class, 'show'])->name('postes.show');
        Route::get('/showFromNotification/{courrier}/{notification}', [CourrierController::class, 'showFromNotification'])->name('courriers.showFromNotification');
        Route::get('/directions.selectemployees', function () {
            return view('directions.selectemployees');
        })->name('directions.selectemployees');
        Route::get('/findividuelles.selectingenieurs', function () {
            return view('findividuelles.selectingenieurs');
        })->name('findividuelles.selectingenieurs');
        Route::get('/courriers/list', [CourrierController::class, 'list'])->name('courriers.list');
        Route::get('/roles/list', [RoleController::class, 'list'])->name('roles.list');
        Route::get('/permissions/list', [PermissionController::class, 'list'])->name('permissions.list');
        Route::get('/recues/list', [RecueController::class, 'list'])->name('recues.list');
        Route::get('/departs/list', [DepartController::class, 'list'])->name('departs.list');
        Route::get('/internes/list', [InterneController::class, 'list'])->name('internes.list');
        Route::get('/administrateurs/list', [AdministrateurController::class, 'list'])->name('administrateurs.list');
        Route::get('/formations/list', [FormationController::class, 'list'])->name('formations.list');
        Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
        Route::get('/employees/list', [EmployeeController::class, 'list'])->name('employees.list');
        Route::get('/gestionnaires/list', [GestionnaireController::class ,'list'])->name('gestionnaires.list');
        Route::get('/directions/list', [DirectionController::class, 'list'])->name('directions.list');
        Route::get('/demandeurs/list', [DemandeurController::class, 'list'])->name('demandeurs.list');
        Route::get('/individuelles/list', [IndividuelleController::class, 'list'])->name('individuelles.list');
        Route::get('/findividuelles/list', [FindividuelleController::class, 'list'])->name('findividuelles.list');
        Route::get('/selectdindividuelles/{id_commune}/{id_module}/{id_form}', [FindividuelleController::class, 'selectdindividuelles'])->name('findividuelles.selectdindividuelles');
        Route::get('adddindividuelles/{id_ind}/{id_form}', [FindividuelleController::class, 'adddindividuelles'])->name('adddindividuelles');
        Route::get('deleteindividuelles/{id_ind}/{id_form}', [FindividuelleController::class, 'deleteindividuelles'])->name('deleteindividuelles');
        Route::get('/collectives/list', [CollectiveController::class, 'list'])->name('collectives.list');
        Route::get('/pcharges/list', [PchargeController::class, 'list'])->name('pcharges.list');
        Route::get('/etablissements/list', [EtablissementController::class, 'list'])->name('etablissements.list');
        Route::get('/fcollectives/list', [FcollectiveController::class, 'list'])->name('fcollectives.list');
        Route::get('/beneficiaires/list', [BeneficiaireController::class, 'list'])->name('beneficiaires.list');
        Route::get('/domaines/list', [DomaineController::class, 'list'])->name('domaines.list');
        Route::get('/diplomes/list', [DiplomeController::class, 'list'])->name('diplomes.list');
        Route::get('/modules/list', [ModuleController::class, 'list'])->name('modules.list');
        Route::get('/secteurs/list', [SecteurController::class, 'list'])->name('secteurs.list');
        Route::get('/activites/list', [ActiviteController::class, 'list'])->name('activites.list');
        Route::get('/projets/list', [ProjetController::class, 'list'])->name('projets.list');
        Route::get('/depenses/list', [DepenseController::class, 'list'])->name('depenses.list');
        Route::get('/niveauxs/list', [NiveauxController::class, 'list'])->name('niveauxs.list');
        Route::get('/options/list', [OptionController::class, 'list'])->name('options.list');
        Route::get('/operateurs/list', [OperateurController::class, 'list'])->name('operateurs.list');
        Route::get('/programmes/list', [ProgrammeController::class, 'list'])->name('programmes.list');
        Route::get('/nineas/list', [NineaController::class, 'list'])->name('nineas.list');
        Route::get('/ingenieurs/list', [IngenieurController::class, 'list'])->name('ingenieurs.list');
        Route::get('/factures/list', [FactureController::class, 'list'])->name('factures.list');
        Route::get('/facturesdafs/list', [FacturedafController::class, 'list'])->name('facturesdafs.list');
        Route::get('/etats/list', [EtatController::class, 'list'])->name('etats.list');
        Route::get('/previsions/list', [EtatspreviController::class, 'list'])->name('previsions.list');
        Route::get('/banques/list', [BanqueController::class, 'list'])->name('banques.list');
        Route::get('/missions/list', [MissionController::class, 'list'])->name('missions.list');
        Route::get('/bordereaus/list', [BordereauController::class, 'list'])->name('bordereaus.list');
        Route::get('/listes/list', [ListeController::class, 'list'])->name('listes.list');
        Route::get('/tresors/list', [TresorController::class, 'list'])->name('tresors.list');
        Route::get('/presentations/list', [PresentationController::class, 'list'])->name('presentations.list');
        Route::get('/departements/list', [DepartementController::class, 'list'])->name('departements.list');
        Route::get('/regions/list', [RegionController::class, 'list'])->name('regions.list');
        Route::get('/arrondissements/list', [ArrondissementController::class, 'list'])->name('arrondissements.list');
        Route::get('/communes/list', [CommuneController::class, 'list'])->name('communes.list');
        Route::get('countscolarite/{annee}', [ScolariteController::class, 'countscolarite'])->name('countscolarite');
        Route::get('countype/{type}/{annee}/{effectif}', [ScolariteController::class, 'countype'])->name('countype');
        Route::get('accord/{pcharge}/{statut}/{avis_dg}', [ScolariteController::class, 'accord'])->name('accord');
        Route::get('nonaccord/{pcharge}/{statut}', [ScolariteController::class, 'nonaccord'])->name('nonaccord');
        Route::get('termine/{pcharge}/{statut}', [PchargeController::class, 'termine'])->name('termine');
        Route::get('countpcharge/{etablissement}', [EtablissementController::class, 'countpcharge'])->name('countpcharge');
        Route::get('etabcountype/{type}/{etablissement}/{effectif}', [EtablissementController::class, 'etabcountype'])->name('etabcountype');
        Route::get('countscolaritenbre/{cin}', [PchargeController::class, 'countscolaritenbre'])->name('countscolaritenbre');
        Route::get('diffage/{age}/{id}', [PchargeController::class, 'diffage'])->name('diffage');
        Route::get('indetails/{id}', [IndividuelleController::class, 'details'])->name('indetails');
        Route::get('coldetails/{id}', [CollectiveController::class, 'details'])->name('coldetails');
        Route::get('pdetails/{id}/{pcharge}', [PchargeController::class, 'details'])->name('pdetails');
        Route::get('attente/{statut}', [PchargeController::class, 'attente'])->name('attente');
        Route::get('terminer/{statut}', [PchargeController::class, 'terminer'])->name('terminer');
        Route::get('rejeter/{statut}', [PchargeController::class, 'rejeter'])->name('rejeter');
        Route::get('accorder/{statut}', [PchargeController::class, 'accorder'])->name('accorder');
        Route::get('/ageroutes/list', [AgerouteController::class, 'list'])->name('ageroutes.list');
        Route::get('/ageroutelocalites/list', [AgeroutelocaliteController::class, 'list'])->name('ageroutelocalites.list');
        Route::get('/ageroutezones/list', [AgeroutezoneController::class, 'list'])->name('ageroutezones.list');
        Route::get('/ageroutemodules/list', [AgeroutemoduleController::class, 'list'])->name('ageroutemodules.list');
        Route::get('/agerouteindividuelles/list', [AgerouteindividuelleController::class, 'list'])->name('agerouteindividuelles.list');
        Route::get('listerparlocalite/{projet}/{localite}', [AgerouteindividuelleController::class, 'listerparlocalite'])->name('listerparlocalite');
        Route::get('listerparmodulelocalite/{projet}/{localite}/{module}', [AgerouteindividuelleController::class, 'listerparmodulelocalite'])->name('listerparmodulelocalite');

        Route::get('create-pdf-file', [PchargeController::class, 'index'])->name('create-pdf-file');

        Route::get('/filieres/list', [FiliereController::class, 'list'])->name('filieres.list');
        Route::get('/filierespecialites/list', [FilierespecialiteController::class, 'list'])->name('filierespecialites.list');
        Route::get('/specialites/list', [SpecialiteController::class, 'list'])->name('specialites.list');
        Route::post('/comments/{courrier}', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/commentReply/{comment}', [CommentController::class, 'storeCommentReply'])->name('comments.storeReply');
        
        Route::get('/pcharges.selectetablissements', function () {
            return view('pcharges.selectetablissements');
        })->name('pcharges.selectetablissements');
        Route::get('/etablissements.selectefilieres', function () {
            return view('etablissements.selectefilieres');
        })->name('etablissements.selectefilieres');



        Route::get('preview', [PDFController::class,  'preview']);
        Route::get('download', [PDFController::class, 'download'])->name('download');
        Route::get('contrat/{pcharges}', [PchargeController::class, 'contrat'])->name('contrat');
        Route::get('lettre/{pcharges}', [PchargeController::class, 'lettre'])->name('lettre');
        
        Route::resource('/courriers', CourrierController::class);
        Route::resource('/recues', RecueController::class);
        Route::resource('/departs', DepartController::class);
        Route::resource('/internes', InterneController::class);
        Route::resource('/administrateurs', AdministrateurController::class);
        Route::resource('/formations', FormationController::class);
        Route::resource('/users', UserController::class);
        Route::resource('/employees', EmployeeController::class);
        Route::resource('/gestionnaires', GestionnaireController::class);
        Route::resource('/directions', DirectionController::class);
        Route::resource('/services', ServiceController::class);
        Route::resource('/demandeurs', DemandeurController::class);
        Route::resource('/individuelles', IndividuelleController::class);
        Route::resource('/findividuelles', FindividuelleController::class);
        Route::resource('/collectives', CollectiveController::class);
        Route::resource('/pcharges', PchargeController::class);
        Route::resource('/fcollectives', FcollectiveController::class);
        Route::resource('/domaines', DomaineController::class);
        Route::resource('/diplomes', DiplomeController::class);
        Route::resource('/modules', ModuleController::class);
        Route::resource('/secteurs', SecteurController::class);
        Route::resource('/activites', ActiviteController::class);
        Route::resource('/projets', ProjetController::class);
        Route::resource('/depenses', DepenseController::class);
        Route::resource('/niveauxs', NiveauxController::class);
        Route::resource('/options', OptionController::class);
        Route::resource('/operateurs', OperateurController::class);
        Route::resource('/programmes', ProgrammeController::class);
        Route::resource('/nineas', NineaController::class);
        Route::resource('/ingenieurs', IngenieurController::class);
        Route::resource('/factures', FactureController::class);
        Route::resource('/facturesdafs', FacturedafController::class);
        Route::resource('/etats', EtatController::class);
        Route::resource('/etatsprivis', EtatspreviController::class);
        Route::resource('/banques', BanqueController::class);
        Route::resource('/missions', MissionController::class);
        Route::resource('/bordereaus', BordereauController::class);
        Route::resource('/listes', ListeController::class);
        Route::resource('/tresors', TresorController::class);
        Route::resource('/departements', DepartementController::class);
        Route::resource('/regions', RegionController::class);
        Route::resource('/arrondissements', ArrondissementController::class);
        Route::resource('/communes', CommuneController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/permissions', PermissionController::class);
        Route::resource('/etablissements', EtablissementController::class);
        Route::resource('/filieres', FiliereController::class);
        Route::resource('/filierespecialites', FilierespecialiteController::class);
        Route::resource('/specialites', SpecialiteController::class);
        Route::resource('/scolarites', ScolariteController::class);
        Route::resource('/antennes', AntenneController::class);
        Route::resource('/ageroutes', AgerouteController::class);
        Route::resource('/ageroutelocalites', AgeroutelocaliteController::class);
        Route::resource('/ageroutezones', AgeroutezoneController::class);
        Route::resource('/ageroutemodules', AgeroutemoduleController::class);
        Route::resource('/agerouteindividuelles', AgerouteindividuelleController::class);
    });

require __DIR__.'/auth.php';


//gestion des roles par niveau d'autorisation
Route::get('loginfor/{rolename?}', function ($rolename=null) {
    if (!isset($rolename)) {
        return view('auth.loginfor');
    } else {
        //$role=App\Models\Role::where('name', $rolename)->first();

        $role = \App\Models\Role::findByName($rolename);
        
        if ($role) {
            $user=$role->users()->first();
            Auth::login($user, true);
            return redirect()->route('home');
        }
    }
    return redirect()->route('login');
})->name('loginfor');
