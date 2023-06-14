@extends('layout.default')
@section('title', 'ONFP - Enregistrement demandeur individuelle')
@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('individuelles.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                        <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">Enregistrement demande individuelle</span></h1>
                    </div>
                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <hr class="sidebar-divider my-0"><br>
                        <form method="POST" action="{{ url('individuelles') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="email">{{ __('E-mail') }}(<span class="text-danger">*</span>)</label>
                                    <input id="email" type="email"
                                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        name="email" placeholder="Votre adresse e-mail" value="{{ old('email') }}"
                                        autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="cin">{{ __('CIN') }}(<span class="text-danger">*</span>)</label>
                                    <input id="cin" type="text"
                                        class="form-control form-control-sm @error('cin') is-invalid @enderror"
                                        name="cin" placeholder="Votre et cin" value="{{ old('cin') }}"
                                        autocomplete="cin">
                                    @error('cin')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="prenom">{{ __('Prénom') }}(<span class="text-danger">*</span>)</label>
                                    <input id="prenom" type="text"
                                        class="form-control form-control-sm @error('prenom') is-invalid @enderror"
                                        name="prenom" placeholder="Votre et prenom" value="{{ old('prenom') }}"
                                        autocomplete="prenom">
                                    @error('prenom')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="nom">{{ __('Nom') }}(<span class="text-danger">*</span>)</label>
                                    <input id="nom" type="text"
                                        class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                        name="nom" placeholder="Votre et nom" value="{{ old('nom') }}"
                                        autocomplete="nom">
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
                                        class="form-control form-control-sm @error('date_naiss') is-invalid @enderror"
                                        name="date_naiss" placeholder="Votre date de naissance"
                                        value="{{ old('date_naiss') }}" autocomplete="username">
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
                                        class="form-control form-control-sm @error('lieu_naissance') is-invalid @enderror"
                                        name="lieu_naissance" placeholder="Votre lieu de naissance"
                                        value="{{ old('lieu_naissance') }}" autocomplete="lieu_naissance">
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
                                        class="form-control form-control-sm @error('telephone') is-invalid @enderror"
                                        name="telephone" placeholder="+221 .. ... .. .." value="{{ old('telephone') }}"
                                        autocomplete="telephone">
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="autre_tel">{{ __('Téléphone secondaire') }}</label>
                                    <input id="autre_tel" type="text"
                                        class="form-control form-control-sm @error('autre_tel') is-invalid @enderror"
                                        name="autre_tel" placeholder="+221 .. ... .. .." value="{{ old('autre_tel') }}"
                                        autocomplete="autre_tel">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="adresse">{{ __('Adresse de résidence') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control form-control-sm  @error('adresse') is-invalid @enderror" name="adresse" id="adresse"
                                        rows="1" placeholder="Votre adresse complète">{{ old('adresse') }}</textarea>
                                    @error('adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('sexe :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('sexe', ['M' => 'M', 'F' => 'F'], null, [
                                        'placeholder' => 'sélectionner sexe',
                                        'class' => 'form-control form-control-sm-lg',
                                        'id' => 'sexe',
                                        'data-width' => '100%',
                                    ]) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('sexe'))
                                            @foreach ($errors->get('sexe') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Situation professionnelle :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('professionnelle', $professionnelle, null, [
                                        'placeholder' => 'Votre situation professionnelle',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'professionnelle',
                                        'data-width' => '100%',
                                    ]) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('professionnelle'))
                                            @foreach ($errors->get('professionnelle') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Situation familiale :') !!}
                                    {!! Form::select('familiale', $familiale, null, [
                                        'placeholder' => 'Votre situation familiale',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'familiale',
                                        'data-width' => '100%',
                                    ]) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('familiale'))
                                            @foreach ($errors->get('familiale') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Commune :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('commune', $communes, null, [
                                        'placeholder' => '',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'commune',
                                        'data-width' => '100%',
                                    ]) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('commune'))
                                            @foreach ($errors->get('commune') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                {{-- <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12"> --}}
                                {{-- {!! Form::label('Dépot :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>) --}}
                                {!! Form::hidden('date_depot', $date_depot->format('Y-m-d'), [
                                    'placeholder' => 'La date de dépot',
                                    'class' => 'form-control form-control-sm',
                                ]) !!}
                                {{-- <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('date_depot'))
                                            @foreach ($errors->get('date_depot') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div> --}}
                                {{--   <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('module demandé :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('modules', $modules, null, ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'module']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('modules'))
                                            @foreach ($errors->get('modules') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>  --}}
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Niveau :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('etude', $etude, null, [
                                        'placeholder' => 'Niveau d\'étude',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'etude',
                                        'data-width' => '100%',
                                    ]) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('etude'))
                                            @foreach ($errors->get('etude') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>

                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('module :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('modules', $modules, null, [
                                        'placeholder' => '',
                                        'data-width' => '100%',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'module',
                                    ]) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('modules'))
                                            @foreach ($errors->get('modules') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Diplômes :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('diplome', $diplomes, null, [
                                        'placeholder' => 'diplome',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'diplome',
                                        'data-width' => '100%',
                                    ]) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('diplome'))
                                            @foreach ($errors->get('diplome') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="optiondiplome">{{ __('Option du diplôme') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <input id="optiondiplome" type="optiondiplome"
                                        class="form-control form-control-sm @error('optiondiplome') is-invalid @enderror"
                                        name="optiondiplome" placeholder="Ex: Gestion finance"
                                        value="{{ old('optiondiplome') }}" autocomplete="optiondiplome">
                                    @error('optiondiplome')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="etablissement">{{ __('Etablissement d\'obtention') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control form-control-sm  @error('etablissement') is-invalid @enderror" name="etablissement"
                                        id="etablissement" rows="1" placeholder="Votre etablissement complète">{{ old('etablissement') }}</textarea>
                                    @error('etablissement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Nbre pièces fournis:') !!}(<span class="text-danger">*</span>)
                                    {!! Form::number('nombre_de_piece', 3, [
                                        'placeholder' => 'Le nombre de pièces fournis',
                                        'class' => 'form-control form-control-sm',
                                        'min' => '3',
                                        'max' => '10',
                                    ]) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('nombre_de_piece'))
                                            @foreach ($errors->get('nombre_de_piece') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <label for="autres_diplomes">{{ __('Autres diplomes') }}</label>
                                    <textarea class="form-control form-control-sm  @error('autres_diplomes') is-invalid @enderror" name="autres_diplomes"
                                        id="autres_diplomes" rows="1" placeholder="Si vous possédez d'autres diplômes">{{ old('autres_diplomes') }}</textarea>
                                    @error('autres_diplomes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <label for="motivation">{{ __('Pourquoi voulez-vous faire cette formation ?') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control form-control-sm  @error('motivation') is-invalid @enderror" name="motivation"
                                        id="motivation" rows="3" placeholder="Décrire en quelques lignes votre motivation à faire cette formation">{{ old('motivation') }}</textarea>
                                    @error('motivation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label for="prerequis">{{ __('Avez-vous des prerequis ?') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control form-control-sm  @error('prerequis') is-invalid @enderror" name="prerequis"
                                        id="prerequis" rows="1" placeholder="Prérequis par rapport à la formation demandée">{{ old('prerequis') }}</textarea>
                                    @error('prerequis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Qualifications :') !!}
                                    {!! Form::textarea('qualification', null, [
                                        'placeholder' => 'Qualifications',
                                        'rows' => 1,
                                        'class' => 'form-control form-control-sm',
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('experience :') !!}
                                    {!! Form::textarea('experience', null, [
                                        'placeholder' => 'Experience, stage, attestions, ...',
                                        'rows' => 2,
                                        'class' => 'form-control form-control-sm',
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <label for="projet_professionnel">{{ __('Projet professionnel') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control form-control-sm  @error('projet_professionnel') is-invalid @enderror"
                                        name="projet_professionnel" id="projet_professionnel" rows="5" placeholder="Votre projet professionnel">{{ old('projet_professionnel') }}</textarea>
                                    @error('projet_professionnel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('Informations :') !!}
                                    {!! Form::textarea('information', null, [
                                        'placeholder' => 'Informations complémenaires',
                                        'rows' => 2,
                                        'class' => 'form-control form-control-sm',
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Programme :') !!}
                                    {!! Form::select('programme', $programmes ?? '', null, [
                                        'placeholder' => 'sélectionner un programme',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'programme',
                                        'data-width' => '100%',
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Projet :') !!}
                                    {!! Form::select('projet', $projets ?? '', null, [
                                        'placeholder' => 'sélectionner un projet',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'projet',
                                        'data-width' => '100%',
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Convention :') !!}
                                    {!! Form::select('convention', $conventions ?? '', null, [
                                        'placeholder' => 'sélectionner une convention',
                                        'class' => 'form-control form-control-sm',
                                        'id' => 'convention',
                                        'data-width' => '100%',
                                    ]) !!}
                                </div>
                            </div>
                            <input type="hidden" name="password" class="form-control form-control-sm"
                                id="exampleInputPassword1" placeholder="Mot de passe">
                            {!! Form::hidden('password', null, [
                                'placeholder' => 'Votre mot de passe',
                                'class' => 'form-control form-control-sm',
                            ]) !!}
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Enregistrer</button>
                        </form>
                        <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
                                            saisies svp</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
@endsection
