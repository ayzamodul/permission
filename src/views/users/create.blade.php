@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid" >
            <h2 class="no-margin-bottom"  id="h2" style="margin-left: 2%" >&nbsp; Yetki Rol</h2>
        </div>
    </header>
<section>

    @if(Session::has('success'))
        <div class="alert alert-success jquery-error-alert">
            <ul>
                <li>{{Session::get('success')}}</li>
            </ul>
        </div>

    @elseif(Session::has('errors'))
        <div class="alert alert-danger jquery-error-alert">
            <ul>
                <li>{{Session::get('errors')}}</li>
            </ul>
        </div>
    @endif


        {{ Form::open(array('url' => 'yonetim/permission/users')) }}

        <div class="card" style="background-color: white" id="deneme">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Kullanıcı Ekle</h3>
            </div>
<div class="row" id="deneme"><br>
    <div class="col-md-12">
        <div class="col-md-6">
        <div class="form-group col-md-10">
            {{ Form::label('name', 'Ad Soyad') }}
            {{ Form::text('name', '', array('class' => 'form-control','required'=>'')) }}
        </div>

        <div class="form-group col-md-10">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', '', array('class' => 'form-control','required'=>'')) }}<hr>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group col-md-10">
            {{ Form::label('sifre', 'Şifre') }}
            {{ Form::password('sifre', array('class' => 'form-control','required'=>'')) }}

        </div>

        <div class="form-group col-md-10">
            {{ Form::label('sifre', 'Şifre Tekrar') }}
            {{ Form::password('sifre', array('class' => 'form-control','required'=>'')) }}<hr>

        </div>
        </div>
    </div>
        <div class='form-group col-md-12'>
            <h5><b>Rol Seç:</b></h5>
            @foreach ($roles as $role)
                <div class="col-md-2">
                {{ Form::checkbox('roles[]',  $role->id ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}
                </div>
            @endforeach <br><br><br><hr>
              </div>


</div>
        {{ Form::submit('Ekle', array('class' => 'btn btn-primary','style'=>'float:right')) }}
      <br><br>  </div>
        {{ Form::close() }}

</section>

@endsection
