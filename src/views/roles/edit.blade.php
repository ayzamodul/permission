@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid">
            <h2 class="no-margin-bottom" id="h2" style="margin-left: 2%">&nbsp; Yetki Rol</h2>
        </div>
    </header>



    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
    <div class="card" style="background-color: white" id="deneme">
        <div class="card-header d-flex align-items-center">
            <h3 class="h4"><i class='fa fa-key'></i>Rol Düzenle: {{$role->name}}</h3>
        </div>
        <br>
        <div class="row" id="deneme">
            <div class="form-group">
                {{ Form::label('name', 'Rol Adı') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>

            <h5><b>Yetki Seç:</b></h5>
            <div class="col-md-12">
                @foreach ($permissions as $permission)
                    <div class="col-md-3">
                        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>
                    </div>
                @endforeach
            </div>
            <br>
            {{ Form::submit('Düzenle', array('class' => 'btn btn-primary','style'=>'float:right')) }}
        </div><br>
    </div>
    {{ Form::close() }}


@endsection
