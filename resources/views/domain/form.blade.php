@extends('admin_template')
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset ('/bower_components/AdminLTE/plugins/select2/select2.min.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset ('/bower_components/AdminLTE/plugins/iCheck/all.css') }}">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset ('/bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}">
@endsection
@section('header')
    <h1>
        Formulario do Dománio
        <small>Aqui você pode criar os domínios do sistema</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-globe"></i> Domínio</a></li>
        <li class="active">Formulario</li>
    </ol>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('domain.create') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <select name="client_id" class="form-control select2" style="width: 100%;" data-placeholder="Selecione um cliente">
                                <option></option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                            <input name="nome" type="text" class="form-control" placeholder="Nome" value="{{ old('nome') }}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                            <input name="dominio" type="text" class="form-control" placeholder="Domínio" value="{{ old('dominio') }}">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="input-group">
                            <input type="checkbox" name="publicado" value="1"> Publicar
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input name="data_registro" type="text" class="form-control datepicker" placeholder="Data de Registro do Domínio" value="{{ old('data_registro') }}">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input name="data_vencimento" type="text" class="form-control datepicker" placeholder="Data de Vencimento do Domínio" value="{{ old('data_vencimento') }}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-registered"></i></span>
                            <input name="orgao_registro" type="text" class="form-control" placeholder="Orgão a onde o Domínio foi registrado" value="{{ old('orgao_registro') }}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input name="valor" type="text" class="form-control money" placeholder="Valor de Renovação do Domínio" value="{{ number_format(old('valor'),2,",",".") }}">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-info"></i></span>
                            <input name="status" type="text" class="form-control" placeholder="Status do Domínio" value="{{ old('status') }}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
                            <input name="image" type="file" class="form-control">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <textarea name="descricao" class="textarea" placeholder="Descrição do serviço" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('descricao') }}</textarea>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a id="btn-whois" class="btn btn-primary pull-right">Consultar Whois</a>
            </div>
        </div><!-- /.box -->
    </form>
@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{ asset ('/bower_components/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset ('/js/select2.js') }}"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{ asset ('/bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset ('/js/icheck.js') }}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{ asset ('/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset ('/js/datepicker.js') }}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{ asset ('/js/maskInputMoney.js') }}"></script>
    <script src="{{ asset ('/js/maskmoney.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#btn-whois").click(function () {
                $.post( "{{ url("/domain/consultwhois") }}", { domain: $("input[name='dominio']").val(), _token: "{{ csrf_token() }}" }, function (data) {
                    resp = JSON.parse(data);
                    $("input[name='data_registro']").val(resp.data_registro)
                    $("input[name='data_vencimento']").val(resp.data_vencimento)
                    $("input[name='status']").val(resp.status)
                    console.log(resp.status)
                });
            })

        })
    </script>
@endsection