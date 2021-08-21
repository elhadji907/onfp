@extends('layout.default')
@section('title', 'ONFP - Modification users')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('users.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-header card-header-primary text-center border-success">
                        <h3 class="card-title">Modification utilisateur</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => 'users/' . $user->id, 'method' => 'PATCH', 'files' => true]) !!}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label('civilite') !!}
                                {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], $user->civilite, ['placeholder' => '', 'class' => 'form-control', 'id' => 'civilite']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label('prenom') !!}
                                {!! Form::text('prenom', $user->firstname, ['placeholder' => 'Votre prenom', 'class' => 'form-control']) !!}
                            </div>
                            <div class="invalid-feedback">
                                {{ $errors->first('prenom') }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label('nom') !!}
                                {!! Form::text('nom', $user->name, ['placeholder' => 'Votre nom', 'class' => 'form-control', 'id' => 'nom']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label("Nom d'utilisateur") !!}
                                {!! Form::text('username', $user->username, ['placeholder' => 'Votre username', 'class' => 'form-control', 'id' => 'username']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label('Email') !!}
                                {!! Form::text('email', $user->email, ['placeholder' => 'Numero de email', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label('Telephone') !!}
                                {!! Form::text('telephone', $user->telephone, ['placeholder' => 'Numero de telephone', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label('role') !!}
                                {!! Form::select('role', $roles, $userRole, ['placeholder' => 'sélectionner un rôle', 'class' => 'form-control', 'id' => 'role']) !!}
                            </div>
                        </div>
                        {!! Form::submit('Modifier', ['class' => 'btn btn-outline-primary pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
