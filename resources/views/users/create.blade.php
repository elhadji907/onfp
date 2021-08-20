@extends('layout.default')
@section('title', 'ONFP - Enregistrement user')
@section('content')
    <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger mt-2">
                    <strong>Oups!</strong> Il y a eu quelques problèmes avec vos entrées.<br><br>
                    {{-- <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul> --}}
                </div>
            @endif
            <div class="row pt-5"></div>
            <div class="card border-primary">
                <div class="card-header card-header-primary text-center border-primary">
                    <h3 class="card-title">{{ 'Enregistrement' }}</h3>
                    <p class="card-category">{{ 'utilisateur' }}</p>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
                    <div class="form-row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <strong>Prénom:</strong>
                            {!! Form::text('firstname', null, ['placeholder' => 'Prénom', 'class' => 'form-control']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('firstname'))
                                    @foreach ($errors->get('firstname') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <strong>Nom:</strong>
                            {!! Form::text('name', null, ['placeholder' => 'Nom', 'class' => 'form-control']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('name'))
                                    @foreach ($errors->get('name') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <strong>Date naissance:</strong>
                            {!! Form::date('date', null, ['placeholder' => 'Date', 'class' => 'form-control']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('date'))
                                    @foreach ($errors->get('date') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <strong>Lieu naissance:</strong>
                            {!! Form::text('lieu', null, ['placeholder' => 'Lieu de naissance', 'class' => 'form-control']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('lieu'))
                                    @foreach ($errors->get('lieu') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <strong>Email:</strong>
                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('email'))
                                    @foreach ($errors->get('email') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <strong>Téléphone:</strong>
                            {!! Form::text('telephone', null, ['placeholder' => 'Téléphone', 'class' => 'form-control']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('telephone'))
                                    @foreach ($errors->get('telephone') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <strong>Mot de passe:</strong>
                            {!! Form::password('password', ['placeholder' => 'Mot de passe', 'class' => 'form-control']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('password'))
                                    @foreach ($errors->get('password') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <strong>Confirmez le mot de passe:</strong>
                            {!! Form::password('confirm-password', ['placeholder' => 'Confirmez le mot de passe', 'class' => 'form-control']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('confirm-password'))
                                    @foreach ($errors->get('confirm-password') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple', 'id' => 'role']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Soumettre</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- <p class="text-center text-primary"><small>Tutorial by tutsmake.com</small></p> --}}
@endsection
