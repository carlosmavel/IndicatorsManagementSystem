@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row'>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center"><strong><i class="fa fa-pencil" aria-hidden="true"></i> Editar Informações do Perfil </strong></div>
                <div class="panel-body">
                    <h4 class="" id="name" name="name">Nome: {{ Auth::user()->name }}</h4>
                    <h4 class="" id="email" name="email">Email: {{ Auth::user()->email }}</h4>
                    @if(isset($departments))
                    <h4>Setores:</h4>
                    @foreach($departments as $dept)
                    <h5 style="margin-left: 10px">* {{ $dept->name }}</h5>
                    @endforeach
                    @else
                    <h4>Nenhum Setor Definido</h4>
                    @endif
                    <hr>
                    @if(null !== session('status'))
                    @if(session('status') == 'Senha Atual Não Confere!')
                    <div class="alert alert-danger alert-dismissable fade in text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ session('status') }}</strong>
                    </div>
                    <hr>
                    @else
                    <div class="alert alert-success alert-dismissable fade in text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ session('status') }}</strong>                           
                    </div>
                    <hr>
                    @endif
                    @endif
                    <button class="btn btn-success" data-toggle="collapse" data-target="#passwordUpdate">Alterar Senha</button>

                    <div id="passwordUpdate" class="{{ $errors->has('old_password', 'password') ? 'collapse in' : 'collapse' }}">
                        <hr>
                        <form class="form-horizontal" method="POST" action="/update">                        

                            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="old_password" class="col-md-4 control-label">Senha Atual: </label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control" name="old_password" required>

                                    @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Senha: </label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirmar Senha: </label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <button type="reset" class="btn btn-success" style="margin-left: 15px;">Limpar</button>                                
                                    <a type="button" class="btn btn-success" href="/home" style="margin-left: 15px;">Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>    


                </div>            
            </div>
        </div>    
    </div>
</div>

@endsection