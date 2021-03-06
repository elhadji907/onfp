@extends('layout.default')
@section('title', 'ONFP - Enregistrement opérateurs')
@section('content')
    <div class="content">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
            <div class="container-fluid">
                {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger mt-2">
                        <strong>Oups!</strong> Il y a eu quelques problèmes avec vos entrées.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif --}}
                <div class="row pt-0"></div>
                <div class="card border-success">
                    <div class="card">
                        <div class="card-header card-header-primary text-center border-success">
                            <h4 class="card-title">Enregistrement opérateurs</h3>
                        </div>
                        <div class="card-body">
                            <b> NB </b> : Les champs<span class="text-danger"> <b>*</b> </span>sont obligatoires
                            <form method="POST" action="{{ url('operateurs') }}">
                                @csrf
                                <div class="bg-gradient-secondary text-center">
                                    <p class="h5 text-white mb-2 mt-0">INFORMATIONS GENERALES</p>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="operateur">{{ __('Opérateur') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <textarea id="operateurAdd" rows="2" class="form-control @error('operateur') is-invalid @enderror" name="operateur"
                                            placeholder="Opérateur" autocomplete="operateur"
                                            autofocus>{{ old('operateur') }}</textarea>
                                        @error('operateur')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                        <label for="sigle">{{ __('Sigle') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <textarea id="sigle" rows="2" class="form-control @error('sigle') is-invalid @enderror" name="sigle" placeholder="Sigle"
                                            autocomplete="sigle">{{ old('sigle') }}</textarea>
                                        @error('sigle')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        <label for="numero_agrement">{{ __('numero agrement') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="numero_agrement" type="text"
                                            class="form-control @error('numero_agrement') is-invalid @enderror"
                                            name="numero_agrement" placeholder="numero agrement"
                                            value="{{ old('numero_agrement') }}" autocomplete="numero_agrement">
                                        @error('numero_agrement')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        <label for="email1">{{ __('E-mail') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="email1" type="text"
                                            class="form-control @error('email1') is-invalid @enderror" name="email1"
                                            placeholder="adresse e-mail" value="{{ old('email1') }}"
                                            autocomplete="email1">
                                        @error('email1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label>{{ __('Type structure :') }}</label>(<span
                                            class="text-danger">*</span>)
                                        <br />
                                        {{ Form::radio('type_structure', 'Publique', false, ['class' => 'name']) }}
                                        {{ __('Publique') }}
                                        {{ Form::radio('type_structure', 'Privé', false, ['class' => 'name']) }}
                                        {{ __('Privé') }}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('type_structure'))
                                                @foreach ($errors->get('type_structure') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label>{{ __('Type opérateur :') }}</label>(<span
                                            class="text-danger">*</span>)
                                        <br />
                                        {{ Form::radio('type_operateur', 'GIE', false, ['class' => 'name']) }}
                                        {{ __('GIE') }}
                                        {{ Form::radio('type_operateur', 'Association', false, ['class' => 'name']) }}
                                        {{ __('Association') }}
                                        {{ Form::radio('type_operateur', 'Entreprise', false, ['class' => 'name']) }}
                                        {{ __('Entreprise') }}
                                        {{ Form::radio('type_operateur', 'Institution', false, ['class' => 'name']) }}
                                        {{ __('Institution') }}
                                        {{ Form::radio('type_operateur', 'Autre', false, ['class' => 'name']) }}
                                        {{ __('Autre') }}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('type_operateur'))
                                                @foreach ($errors->get('type_operateur') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="autres_type_operateur">{{ __('Si autre, précisez :') }}</label>
                                        <textarea class="form-control  @error('autres_type_operateur') is-invalid @enderror" name="autres_type_operateur"
                                            id="autres_type_operateur" rows="1"
                                            placeholder="autre type opérateur">{{ old('autres_type_operateur') }}</textarea>
                                        @error('autres_type_operateur')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="operateur">{{ __('Type opérateur') }}(<span
                                                class="text-danger">*</span>)</label>
                                        {!! Form::select('type_operateur', $types_operateurs, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'type_operateur', 'data-width' => '100%']) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('type_operateur'))
                                                @foreach ($errors->get('type_operateur') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="operateur">{{ __('Type structure') }}(<span
                                                class="text-danger">*</span>)</label>
                                        {!! Form::select('type_structure', ['Publique' => 'Publique', 'Privé' => 'Privé'], null, ['placeholder' => 'sélectionner type structure', 'class' => 'form-control', 'id' => 'type_structure', 'data-width' => '100%']) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('type_structure'))
                                                @foreach ($errors->get('type_structure') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div> --}}
                                    <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        {!! Form::label('Commune :') !!}(<span class="text-danger">*</span>)
                                        {!! Form::select('commune', $communes, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'commune', 'data-width' => '100%']) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('commune'))
                                                @foreach ($errors->get('commune') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        <label for="adresse">{{ __('Adresse complète') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <textarea id="adresse_op" rows="2" class="form-control @error('adresse_op') is-invalid @enderror" name="adresse_op"
                                            placeholder="adresse de la structure" autocomplete="adresse_op"
                                            autofocus>{{ old('adresse_op') }}</textarea>
                                        @error('adresse_op')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--  <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        <label for="operateur">{{ __('Région d\'intervention') }}(<span
                                                class="text-danger">*</span>)</label>
                                        {!! Form::select('regions[]', $regions, null, ['multiple' => 'multiple', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'regions_op']) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('regions'))
                                                @foreach ($errors->get('regions') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>  --}}
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        <label for="fixe_op">{{ __('Fixe') }}</label>
                                        <input id="fixe_op" type="text"
                                            class="form-control @error('fixe_op') is-invalid @enderror" name="fixe_op"
                                            placeholder="Téléphone fixe opérateur" value="{{ old('fixe_op') }}"
                                            autocomplete="fixe_op" autofocus>
                                        @error('fixe_op')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        <label for="telephone1">{{ __('Téléphone') }}</label>
                                        <input id="telephone1" type="text"
                                            class="form-control @error('telephone1') is-invalid @enderror" name="telephone1"
                                            placeholder="Téléphone fixe opérateur" value="{{ old('telephone1') }}"
                                            autocomplete="telephone1" autofocus>
                                        @error('telephone1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        {!! Form::label('E-mail secondaire:') !!}
                                        {!! Form::text('email2', null, ['placeholder' => 'adresse e-mail secondaire de la structure', 'class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        {!! Form::label('Téléphone secondaire:') !!}
                                        {!! Form::text('telephone2', null, ['placeholder' => 'Numero de telephone secondaire de la structure', 'class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        <label for="bp">{{ __('Boite postale') }}</label>
                                        <input id="bp" type="text" class="form-control @error('bp') is-invalid @enderror"
                                            name="bp" placeholder="Votre adresse postale" value="{{ old('bp') }}"
                                            autocomplete="bp" autofocus>
                                        @error('bp')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        <label for="fax">{{ __('Téléphone fax') }}</label>
                                        <input id="fax" type="text" class="form-control @error('fax') is-invalid @enderror"
                                            name="fax" placeholder="Votre numero de fax" value="{{ old('fax') }}"
                                            autocomplete="fax" autofocus>
                                        @error('fax')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        <label for="ninea">{{ __('Ninéa ') }}</label>
                                        <input id="ninea" type="text"
                                            class="form-control @error('ninea') is-invalid @enderror" name="ninea"
                                            placeholder="Ninea" value="{{ old('ninea') }}" autocomplete="ninea"
                                            autofocus>
                                        @error('ninea')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        {!! Form::label('Régistre de commerce:') !!}
                                        {!! Form::text('registre', null, ['placeholder' => 'Le registre de commerce de votre établissement', 'class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="quitus">{{ __('Quitus ') }}</label>
                                        <input id="quitus" type="text"
                                            class="form-control @error('quitus') is-invalid @enderror" name="quitus"
                                            placeholder="Votre numero de quitus" value="{{ old('quitus') }}"
                                            autocomplete="quitus" autofocus>
                                        @error('quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="debut_quitus">{{ __('Date délivrance') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="debut_quitus" {{ $errors->has('debut_quitus') ? 'is-invalid' : '' }}
                                            type="date" class="form-control @error('debut_quitus') is-invalid @enderror"
                                            name="debut_quitus" placeholder="Votre date de naissance"
                                            value="{{ old('debut_quitus') }}" autocomplete="username" autofocus>
                                        @error('debut_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="fin_quitus">{{ __('Date fin') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="fin_quitus" {{ $errors->has('fin_quitus') ? 'is-invalid' : '' }}
                                            type="date" class="form-control @error('fin_quitus') is-invalid @enderror"
                                            name="fin_quitus" placeholder="Votre date de naissance"
                                            value="{{ old('fin_quitus') }}" autocomplete="username" autofocus>
                                        @error('fin_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="bg-gradient-secondary text-center">
                                    <p class="h5 text-white mb-2">RESPONSABLE</p>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        {!! Form::label('civilite :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                        {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], null, ['placeholder' => 'sélectionner civilite', 'class' => 'form-control', 'id' => 'civilite', 'data-width' => '100%']) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('civilite'))
                                                @foreach ($errors->get('civilite') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="prenom">{{ __('Prénom ') }}</label>
                                        <input id="prenom" type="text"
                                            class="form-control @error('prenom') is-invalid @enderror" name="prenom"
                                            placeholder="Votre numero de prenom" value="{{ old('prenom') }}"
                                            autocomplete="prenom" autofocus>
                                        @error('prenom')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="nom">{{ __('Nom ') }}</label>
                                        <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
                                            name="nom" placeholder="Votre numero de nom" value="{{ old('nom') }}"
                                            autocomplete="nom" autofocus>
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="cin">{{ __('Cin  ') }}</label>
                                        <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror"
                                            name="cin" placeholder="Votre numero de cin" value="{{ old('cin') }}"
                                            autocomplete="cin" autofocus>
                                        @error('cin')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="email">{{ __('E-mail  ') }}</label>
                                        <input id="email" type="text"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            placeholder="Votre numero de email" value="{{ old('email') }}"
                                            autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="telephone">{{ __('Téléphone  ') }}</label>
                                        <input id="telephone" type="text"
                                            class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                            placeholder="Votre numero de telephone" value="{{ old('telephone') }}"
                                            autocomplete="telephone" autofocus>
                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="fonction_responsable">{{ __('Fonction  ') }}</label>
                                        <input id="fonction_responsable" type="text"
                                            class="form-control @error('fonction_responsable') is-invalid @enderror"
                                            name="fonction_responsable" placeholder="Votre numero de fonction_responsable"
                                            value="{{ old('fonction_responsable') }}" autocomplete="fonction_responsable"
                                            autofocus>
                                        @error('fonction_responsable')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="date_naiss">{{ __('Date de naissance') }}</label>
                                        <input id="date_naiss" {{ $errors->has('date_naiss') ? 'is-invalid' : '' }}
                                            type="date" class="form-control @error('date_naiss') is-invalid @enderror"
                                            name="date_naiss" placeholder="Votre date de naissance"
                                            value="{{ old('date_naiss') }}" autocomplete="username" autofocus>
                                        @error('date_naiss')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="lieu_naissance">{{ __('Lieu de naissance') }}</label>
                                        <input id="lieu_naissance" type="text"
                                            class="form-control @error('lieu_naissance') is-invalid @enderror"
                                            name="lieu_naissance" placeholder="Votre lieu de naissance"
                                            value="{{ old('lieu_naissance') }}" autocomplete="lieu_naissance">
                                        @error('lieu_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="adresse">{{ __('Adresse') }}</label>
                                        <textarea id="adresse" rows="1" class="form-control @error('adresse') is-invalid @enderror" name="adresse"
                                            placeholder="adresse du responsable" autocomplete="adresse"
                                            autofocus>{{ old('adresse') }}</textarea>
                                        @error('adresse')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mot de passe">
                                {!! Form::hidden('password', null, ['placeholder' => 'Votre mot de passe', 'class' => 'form-control']) !!}

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-outline-primary"><i
                                            class="far fa-paper-plane"></i>&nbsp;Enregistrer</button>
                                </div>
                                {{-- <button type="submit" class="btn btn-primary"><i
                                        class="far fa-paper-plane"></i>&nbsp;Enregistrer</button> --}}
                                <br />
                                <br />
                                <div class="bg-gradient-secondary text-center">
                                    <p class="h5 text-white mb-2">CHOIX ET LOCALISATION</p>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        <strong>Regions :</strong>
                                        <br />
                                        @foreach ($region as $value)
                                        <label>{{ Form::checkbox('region[]', $value->id, false, ['class' => 'name-input']) }}
                                            {{ $value->nom }}</label>
                                            <br />
                                        @endforeach
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('region'))
                                                @foreach ($errors->get('region') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </form>
                            <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
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
