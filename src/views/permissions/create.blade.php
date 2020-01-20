@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid" >
            <h2 class="no-margin-bottom"  id="h2" style="margin-left: 2%" >&nbsp; Yetki Rol</h2>
        </div>
    </header>
    <section>

        {{ Form::open(array('url' => 'yonetim/permission/permissions')) }}
        <div class="card" style="background-color: white" id="deneme">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4"><i class='fa fa-key'></i>Yetki Ekle</h3>
            </div>
            <div class="row" id="deneme"><br>
                <div class="col-md-12">
                    <div class="col-md-6">
                        {{ Form::label('name', 'İsim') }}
                        {{ Form::text('name', '', array('class' => 'form-control','required'=>'')) }}
                    </div>

                    <div class="col-md-6">
                        @if(!$roles->isEmpty())
                            <h4>Rollere İzin Atama</h4>

                            @foreach ($roles as $role)
                                <div class="col-md-4">
                                    {{ Form::checkbox('roles[]',  $role->id ) }}
                                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div><br>
            {{ Form::submit('Ekle', array('class' => 'btn btn-primary','style'=>'float:right')) }}<br><br>
        </div>
        {{ Form::close() }}
    </section>



@endsection
