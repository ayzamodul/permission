@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid" >
            <h2 class="no-margin-bottom"  id="h2" style="margin-left: 2%" >&nbsp; Yetki Rol</h2>
        </div>
    </header>
    <section>

        <div class="card-header d-flex align-items-center">
            <h3 class="h4">Kullanıcı Düzenle</h3>
        </div>

        {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

        <div class="card" style="background-color: white" id="">
            <div class=" card-body row" style="background-color: white;" id="deneme">


    <div class="col-md-5">
        <div class="form-group row">
            {{ Form::label('name', 'Ad Soyad') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group row">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>

    </div>
    <div class="col-md-7">
        <div class='form-group'>
<h5><b>Rol Seç:</b></h5>
            @foreach ($roles as $role)
                <div class="col-md-3">
                {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                </div>
            @endforeach
        </div></div>



        {{ Form::submit('Kaydet', array('class' => 'btn btn-primary','style'=>'float:right')) }}
            </div>
        </div>
        {{ Form::close() }}


      </section>
@endsection
