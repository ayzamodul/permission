@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')

    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid" >
            <h2 class="no-margin-bottom"  id="h2" style="margin-left: 2%" >&nbsp; Yetki Rol</h2>
        </div>
    </header>


        {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}
            <div class="card" style="background-color: white" id="deneme">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4"><i class='fa fa-key'></i>Düzenle: {{$permission->name}}</h3>
                </div><br>
        <div class="form-group col-md-4">
            {{ Form::label('name', 'Permission Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <br>
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
            <br><br><br></div>
        {{ Form::close() }}



@endsection
