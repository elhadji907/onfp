@extends('layout.default')
@section('title', 'ONFP - Modification demande individuelle')
@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
            <div class="container-fluid">
            {{--      @if (count($errors) > 0)
                    <div class="alert alert-danger mt-2">
                        <strong>Oups!</strong> Il y a eu quelques problèmes avec vos entrées.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif  --}}
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row pt-0"></div>
                <div class="card">
                    <div class="card-header bg-gradient-info text-center">
                        <h1 class="h4 text-white mb-0"><span data-feather="info"></span>Modification demande
                            individuelle [{!! $individuelle->demandeur->numero !!}]</h1>
                    </div>
                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <div class="bg-gradient-secondary text-center">
                            <p class="h4 text-white mb-2 mt-0">IDENTIFICATION</p>
                        </div>
                        {!! Form::open(['url' => 'individuelles/' . $individuelle->id, 'method' => 'PATCH', 'files' => true]) !!}
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="cin">{{ __('CIN') }}(<span class="text-danger">*</span>)</label>
                                <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror"
                                    name="cin" placeholder="Votre et cin" value="{{ $individuelle->cin ?? old('cin') }}"
                                    autocomplete="cin">
                                @error('cin')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="prenom">{{ __('Prénom') }}(<span class="text-danger">*</span>)</label>
                                <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror"
                                    name="prenom" placeholder="Votre et prenom"
                                    value="{{ $individuelle->demandeur->user->firstname ?? old('prenom') }}"
                                    autocomplete="prenom">
                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="nom">{{ __('Nom') }}(<span class="text-danger">*</span>)</label>
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
                                    name="nom" placeholder="Votre et nom"
                                    value="{{ $individuelle->demandeur->user->name ?? old('nom') }}" autocomplete="nom">
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="date_naiss">{{ __('Date de naissance') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="date_naiss" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_naiss') is-invalid @enderror" name="date_naiss"
                                    placeholder="Votre date de naissance"
                                    value="{{ $individuelle->demandeur->user->date_naissance->format('Y-m-d') ?? old('date_naiss') }}"
                                    autocomplete="username">
                                @error('date_naiss')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="lieu_naissance">{{ __('Lieu de naissance') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="lieu_naissance" type="text"
                                    class="form-control @error('lieu_naissance') is-invalid @enderror" name="lieu_naissance"
                                    placeholder="Votre lieu de naissance"
                                    value="{{ $individuelle->demandeur->user->lieu_naissance ?? old('lieu_naissance') }}"
                                    autocomplete="lieu_naissance">
                                @error('lieu_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="telephone">{{ __('Telephone') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="telephone" type="text"
                                    class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                    placeholder="+221 .. ... .. .."
                                    value="{{ $individuelle->demandeur->user->telephone ?? old('telephone') }}"
                                    autocomplete="telephone">
                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="fixe">{{ __('Fixe') }}(<span class="text-danger">*</span>)</label>
                                <input id="fixe" type="text" class="form-control @error('fixe') is-invalid @enderror"
                                    name="fixe" placeholder="+221 .. ... .. .."
                                    value="{{ $individuelle->demandeur->user->fixe ?? old('fixe') }}" autocomplete="fixe"
                                    >
                                @error('fixe')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div> --}}
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="autre_tel">{{ __('Téléphone secondaire') }}</label>
                                <input id="autre_tel" type="text"
                                    class="form-control @error('autre_tel') is-invalid @enderror" name="autre_tel"
                                    placeholder="+221 .. ... .. .."
                                    value="{{ $individuelle->demandeur->telephone ?? old('autre_tel') }}"
                                    autocomplete="autre_tel">
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-4">
                                <label for="adresse">{{ __('Adresse de résidence') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('adresse') is-invalid @enderror" name="adresse"
                                    id="adresse" rows="1"
                                    placeholder="Votre adresse complète">{{ $individuelle->demandeur->user->adresse ?? old('adresse') }}</textarea>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('sexe :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                {!! Form::select('sexe', ['M' => 'M', 'F' => 'F'], $individuelle->demandeur->user->sexe ?? old('sexe'), ['placeholder' => 'sélectionner sexe', 'class' => 'form-control', 'id' => 'sexe', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('sexe'))
                                        @foreach ($errors->get('sexe') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Situation familiale :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                {!! Form::select('familiale', $familiale, $individuelle->demandeur->user->familiale->name ?? old('familiale'), ['placeholder' => 'Situation familiale', 'class' => 'form-control', 'id' => 'familiale', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('familiale'))
                                        @foreach ($errors->get('familiale') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Situation professionnelle:') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('professionnelle', $professionnelle, $individuelle->demandeur->user->professionnelle->name ?? old('professionnelle'), ['placeholder' => 'Situation professionnelle', 'class' => 'form-control', 'id' => 'professionnelle', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('professionnelle'))
                                        @foreach ($errors->get('professionnelle') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Commune') !!}
                                {!! Form::select('commune', $communes, $individuelle->commune->nom ?? old('nom'), ['placeholder' => '', 'class' => 'form-control', 'id' => 'commune']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('commune'))
                                        @foreach ($errors->get('commune') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="bp">{{ __('Boite postale') }}</label>
                                <input id="bp" type="text" class="form-control @error('bp') is-invalid @enderror" name="bp"
                                    placeholder="Votre adresse postale"
                                    value="{{ $individuelle->demandeur->user->bp ?? old('bp') }}" autocomplete="bp">
                                @error('bp')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="fax">{{ __('Téléphone fax') }}</label>
                                <input id="fax" type="text" class="form-control @error('fax') is-invalid @enderror"
                                    name="fax" placeholder="Votre numero de fax"
                                    value="{{ $individuelle->demandeur->user->fax ?? old('fax') }}" autocomplete="fax">
                                @error('fax')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div> --}}
                            {{-- <div class="form-row"> --}}
                            {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12"> --}}
                            {{-- {!! Form::label('N° courrier :') !!}(<span class="text-danger">*</span>) --}}
                            {!! Form::hidden('numero_courrier', null, ['placeholder' => 'Le numéro du courrier', 'class' => 'form-control']) !!}
                            {{-- <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('numero_courrier'))
                                            @foreach ($errors->get('numero_courrier') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12"> --}}
                            {{-- {!! Form::label('Nbre pièces:') !!}(<span class="text-danger">*</span>) --}}
                            {!! Form::hidden('nombre_de_piece', 3, ['placeholder' => 'Le nombre de pièces fournis', 'class' => 'form-control', 'min' => '3', 'max' => '20']) !!}
                            {{-- <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('nombre_de_piece'))
                                            @foreach ($errors->get('nombre_de_piece') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12"> --}}
                            {{-- {!! Form::label('Dépot :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>) --}}
                            {!! Form::hidden('date_depot', $date_depot->format('Y-m-d'), ['placeholder' => 'La date de dépot', 'class' => 'form-control']) !!}
                            {{-- <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('date_depot'))
                                            @foreach ($errors->get('date_depot') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div> --}}
                            {{-- </div> --}}
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Niveau :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('etude', $etude, $individuelle->etude->name ?? old('etude'), ['placeholder' => '', 'class' => 'form-control', 'id' => 'etude', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('etude'))
                                        @foreach ($errors->get('etude') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Diplômes :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('diplome', $diplomes, $individuelle->diplome->name ?? old('diplome'), ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'diplome']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('diplome'))
                                        @foreach ($errors->get('diplome') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Module demandé') !!}
                                {!! Form::select('modules', $modules, null, ['class' => 'form-control', 'id' => 'moduleup']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('modules'))
                                        @foreach ($errors->get('modules') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="Option">{{ __('Option du diplôme') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="optiondiplome" type="optiondiplome" class="form-control @error('optiondiplome') is-invalid @enderror"
                                    name="optiondiplome" placeholder="Ex: Gestion finance"
                                    value="{{ $individuelle->optiondiplome ?? old('optiondiplome') }}"
                                    autocomplete="optiondiplome">
                                @error('option')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="etablissement">{{ __('Etablissement d\'obtention') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('etablissement') is-invalid @enderror"
                                    name="etablissement" id="etablissement" rows="1"
                                    placeholder="Votre etablissement complète">{{ $individuelle->etablissement ?? old('etablissement') }}</textarea>
                                @error('etablissement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="autres_diplomes">{{ __('Autres diplomes') }}</label>
                                <textarea class="form-control  @error('autres_diplomes') is-invalid @enderror"
                                    name="autres_diplomes" id="autres_diplomes" rows="1"
                                    placeholder="Si vous possédez d'autres diplômes">{{ $individuelle->autres_diplomes ?? old('autres_diplomes') }}</textarea>
                                @error('autres_diplomes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="motivation">{{ __('Pourquoi voulez-vous faire cette formation ?') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('motivation') is-invalid @enderror" name="motivation"
                                    id="motivation" rows="2"
                                    placeholder="Décrire en quelques lignes votre motivation à faire cette formation">{{ $individuelle->motivation ?? old('motivation') }}</textarea>
                                @error('motivation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="prerequis">{{ __('Avez-vous des prerequis ?') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('prerequis') is-invalid @enderror" name="prerequis"
                                    id="prerequis" rows="1"
                                    placeholder="Prérequis par rapport à la formation demandée">{{ $individuelle->prerequis ?? old('prerequis') }}</textarea>
                                @error('prerequis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Qualifications :') !!}
                                {!! Form::textarea('qualification', $individuelle->qualification, ['placeholder' => 'Qualifications et autres diplômes', 'rows' => 2, 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('experience :') !!}
                                {!! Form::textarea('experience', $individuelle->experience, ['placeholder' => 'Experience, stage, attestions, ...', 'rows' => 2, 'class' => 'form-control']) !!}
                            </div>                       
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="projet_professionnel">{{ __('Projet professionnel') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('projet_professionnel') is-invalid @enderror" name="projet_professionnel"
                                    id="projet_professionnel" rows="5"
                                    placeholder="Votre projet professionnel">{{ $individuelle->projetprofessionnel ?? old('projet_professionnel') }}</textarea>
                                @error('projet_professionnel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Informations :') !!}
                                {!! Form::textarea('information', $individuelle->information, ['placeholder' => 'Informations complémenaires', 'rows' => 2, 'class' => 'form-control']) !!}
                            </div>
                            @can('user-list')
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Statut :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('statut', ['Attente' => 'Attente', 'Validé' => 'Validé', 'Rejeté' => 'Rejeté'], $individuelle->statut, ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'statut']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('statut'))
                                            @foreach ($errors->get('statut') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            @endcan
                            @can('user-list')
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Programme :') !!}
                                    {!! Form::select('programme', $programmes, $individuelle->programme->sigle ?? ' ', ['placeholder' => 'Choir un programme', 'class' => 'form-control', 'id' => 'programme', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('programme'))
                                            @foreach ($errors->get('programme') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            @endcan
                            @can('user-list')
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('projet :') !!}
                                    {!! Form::select('projets', $projets, null, ['class' => 'form-control', 'id' => 'projet']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('projets'))
                                            @foreach ($errors->get('projets') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            @endcan
                            @can('user-list')
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('convention :') !!}
                                    {!! Form::select('convention', $conventions, $individuelle->convention->name ?? ' ', ['placeholder' => 'Choir une convention', 'class' => 'form-control', 'id' => 'convention', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('convention'))
                                            @foreach ($errors->get('convention') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            @endcan
                            {!! Form::hidden('username', $individuelle->demandeur->user->username, ['placeholder' => 'Votre nom', 'class' => 'form-control']) !!}
                            {!! Form::hidden('numero', $individuelle->demandeur->numero, ['placeholder' => '', 'class' => 'form-control']) !!}
                            <input type="hidden" name="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Mot de passe">
                            {!! Form::hidden('password', null, ['placeholder' => 'Votre mot de passe', 'class' => 'form-control']) !!}
                            {!! Form::submit('Modifier', ['class' => 'btn btn-outline-primary pull-right']) !!}
                            {!! Form::close() !!}
                            <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Verifier les
                                                donn&eacute;es
                                                saisies svp</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->any())

                                                @if (count($errors) > 0)
                                                    <div class="alert alert-danger mt-2">
                                                        <strong>Oups!</strong> Il y a eu quelques problèmes avec vos
                                                        entrées.
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @push('scripts')
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $("#error-modal").modal({
                                                                'show': true,
                                                            })
                                                        });
                                                    </script>

                                                @endpush
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script type="text/javascript">
        $('#moduleup').select2().val({!! json_encode($individuelle->modules()->allRelatedIds()) !!}).trigger('change');
    </script>
    <script type="text/javascript">
        $('#projet').select2().val({!! json_encode($individuelle->projets()->allRelatedIds()) !!}).trigger('change');
    </script>
@endsection
