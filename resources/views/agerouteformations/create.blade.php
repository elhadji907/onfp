@extends('layout.default')
@section('title', 'ONFP - Enregistrement formation individuelle')
@section('content')
    <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
        <div class="container-fluid">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            <div class="row pt-1"></div>
            <div class="card">
                <div class="card-header card-header-primary text-center">
                    <h3 class="card-title">Enregistrement</h3>
                    <p class="card-category">formation individuelle</p>
                </div>
                <div class="card-body">
                    <div class="row pt-5 pl-1">
                        <h5>
                            <b>Opérateur choisi : </b>
                            {{ $operateur->name ?? 'Non disponible' }}<br />
                            <b>N° agrément : </b> {{ $operateur->numero_agrement ?? 'Aucun numéro' }}
                        </h5>
                    </div>
                    <div class="row pt-2"></div>
                    <form method="POST" action="{{ url('agerouteformations') }}">
                        @csrf
                        <div class="form-row">
                            {{-- <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="code">{{ __('CODE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="code" type="text"
                                    class="form-control @error('code') is-invalid @enderror" name="code"
                                    placeholder="Code formation" value="{{ old('code') }}"
                                    autocomplete="code">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div> --}}
                            {{--  <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                {!! Form::label('Type de formation:') !!}(<span class="text-danger">*</span>)  --}}
                                {!! Form::hidden('types_formations', $types_formations, null, ['placeholder' => 'types_formations', 'class' => 'form-control', 'id' => 'types_formations', 'data-width' => '100%']) !!}
                                {{--  <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('types_formations'))
                                        @foreach ($errors->get('types_formations') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small> 
                            </div> --}}
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('module :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('modules', $modules, null, ['placeholder' => 'module', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'moduleageroute']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('modules'))
                                        @foreach ($errors->get('modules') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="beneficiaire">{{ __('Bénéficiaires') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('beneficiaire') is-invalid @enderror" name="beneficiaire" id="beneficiaire"
                                    rows="1"
                                    placeholder="Ex : Jeune de la région de dakar">{{ old('beneficiaire') }}</textarea>
                                @error('beneficiaire')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Programme :') !!}
                                {!! Form::select('programme', $programmes, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'programme', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('programme'))
                                        @foreach ($errors->get('programme') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div> --}}
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="adresse">{{ __('Localisation') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('adresse') is-invalid @enderror" name="adresse" id="adresse" rows="1"
                                    placeholder="Votre adresse complète">{{ old('adresse') }}</textarea>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-lg-16 col-xs-12 col-sm-12">
                                {!! Form::label('Localité:') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('commune', $communes, null, ['placeholder' => 'commune', 'class' => 'form-control', 'id' => 'commune', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('commune'))
                                        @foreach ($errors->get('commune') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                {!! Form::label('Choix opérateur:') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('choixoperateur', $choixoperateur, null, ['placeholder' => 'choix operateur', 'class' => 'form-control', 'id' => 'choixoperateur', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('choixoperateur'))
                                        @foreach ($errors->get('choixoperateur') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Projet:') !!}
                                {!! Form::select('projet', $projets, null, ['placeholder' => 'projet', 'class' => 'form-control', 'id' => 'projet', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('projet'))
                                        @foreach ($errors->get('projet') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Programme:') !!}
                                {!! Form::select('programme', $programmes, null, ['placeholder' => 'programme', 'class' => 'form-control', 'id' => 'programme', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('programme'))
                                        @foreach ($errors->get('programme') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="date_debut">{{ __('Début') }}</label>
                                <input id="date_debut" {{ $errors->has('date_debut') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_debut') is-invalid @enderror" name="date_debut"
                                    placeholder="Votre date de debutance" value="{{ old('date_debut') }}"
                                    autocomplete="username">
                                @error('date_debut')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="date_fin">{{ __('Fin') }}</label>
                                <input id="date_fin" {{ $errors->has('date_fin') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_fin') is-invalid @enderror" name="date_fin"
                                    placeholder="Votre date de finance" value="{{ old('date_fin') }}"
                                    autocomplete="username">
                                @error('date_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {!! Form::hidden('operateur', $operateur->name, null, ['placeholder' => 'operateur', 'class' => 'form-control', 'id' => 'operateur', 'data-width' => '100%']) !!}
                        <button type="submit" class="btn btn-primary"><i
                                class="far fa-paper-plane"></i>&nbsp;Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
