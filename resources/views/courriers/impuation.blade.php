@extends('layout.default')
@section('title', 'ONFP - Modification des courriers arrivées')
@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @elseif (session('messages'))
                    <div class="alert alert-danger">
                        {{ session('messages') }}
                    </div>
                @endif
                <div class="row pb-2">
                    <div class="col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('recues.index') }}">Retour</a></li>
                            <li class="breadcrumb-item active">Imputer ce courrier</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-12 pt-2">
                        <span class="card-category"><b>Date réception </b>: {!! optional($courrier->date_recep)->format('d/m/Y') !!}</span><br />
                        <span class="card-category"><b>Expéditeur </b>: {!! $courrier->expediteur !!}</span> <br />
                        <span class="card-category"><b>Objet </b>: {!! $courrier->objet !!}</span><br /><br />
                        <div class="card">
                            <div class="card-body custom-edit-service">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Imputation</label>
                                            <input type="text" placeholder="Imputation"
                                                class="form-control form-control-sm @error('product') is-invalid @enderror"
                                                name="product" id="product" value="">
                                            <div class="col-lg-12" id="productList">
                                            </div>
                                            @error('product')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Personne ressource</label>
                                            <input type="text" placeholder="Nom du responsable"
                                                class="form-control form-control-sm @error('total_price') is-invalid @enderror"
                                                name="total_price" id="total_price" value="" readonly>
                                            @error('total_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" placeholder="Entrer quantite"
                                        class="form-control form-control-sm @error('quantite') is-invalid @enderror"
                                        name="quantite" id="quantite" value="0.0" min="0">
                                    <input type="hidden" placeholder="ID"
                                        class="form-control form-control-sm @error('id_produit') is-invalid @enderror"
                                        name="id_produit" id="id_produit" value="0.0" min="0">

                                    <input type="hidden" placeholder=""
                                        class="form-control form-control-sm @error('quantite_insuffisante') is-invalid @enderror"
                                        name="quantite_insuffisante" id="quantite_insuffisante" value="">
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button id="addMore" class="btn btn-success btn-sm"><i class="fa fa-plus"
                                                aria-hidden="true"></i>&nbsp;Ajouter</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <small class="row form-row justify-content-center pb-4">
                        {{--  @foreach ($sales as $sale)
                                    <a href="{{ url('admin/sales/facture', ['$id' => $sale->id]) }}" class="showbtn"
                                        target="_blank" title="Télécharger la dernière facture"><button
                                            class="btn btn-outline-secondary btn-sm"><i class="fa fa-print"
                                                aria-hidden="true">&nbsp;Télécharger la facture de la dernière
                                                vente</i></button></a>
                                @endforeach  --}}
                    </small>
                    <div class="col-lg-12">
                        <form method="POST" action="#">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered" style="display: none;">
                                    <thead>
                                        <tr>
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                            <th>Direction</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="addRow" class="addRow">
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Imputer</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
                    <script src="//code.jquery.com/jquery.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
                    <script id="document-template" type="text/x-handlebars-template">
                    <tr class="delete_add_more_item" id="delete_add_more_item">    
                        <td>
                            <input type="text" name="product[]" value="@{{ product }}" placeholder="Prénom" class="form-control form-control-sm" readonly>
                        </td>
                            <td>
                            <input type="text" class="quantity form-control form-control-sm" name="quantity[]" value="@{{ quantity }}" required min="1" placeholder="Nom" readonly>
                            </td>
                            <td>
                            <input type="text" class="tva_app form-control form-control-sm" name="tva_app[]" value="@{{ tva_app }}" required min="0" placeholder="Direction" readonly>
                            </td>
                        <td>
                        <i class="removeaddmore" style="cursor:pointer;color:red;" title="supprimer"><i class="fas fa-trash"></i></i>
                        </td>    
                    </tr>
                    </script>
                    <script type="text/javascript">
                        $(document).on('click', '#addMore', function() {
                            $('.table').show();
                            var product = $("#product").val();
                            var source = $("#document-template").html();
                            var template = Handlebars.compile(source);
                            var data = {
                                product: product,
                            }
                            var html = template(data);
                            $("#addRow").append(html)
                            total_ammount_price();
                        });
                        $(document).on('click', '.removeaddmore', function(event) {
                            $(this).closest('.delete_add_more_item').remove();
                            total_ammount_price();
                        });

                        $('#product').keyup(function() {
                            var query = $(this).val();
                            if (query != '') {
                                var _token = $('input[name="_token"]').val();
                                $.ajax({
                                    url: "{{ route('courrier.fetch') }}",
                                    method: "POST",
                                    data: {
                                        query: query,
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#productList').fadeIn();
                                        $('#productList').html(data);
                                    }
                                });
                            }
                        });
                        $(document).on('click', 'li', function() {
                            $('#product').val($(this).text());
                            $('#productList').fadeOut();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
