@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid">
            <h2 class="no-margin-bottom" id="h2" style="margin-left: 2%">&nbsp; Yetki Rol</h2>
        </div>
    </header>
    <section>


        {{ Form::open(array('url' => 'yonetim/permission/roles')) }}
        <div class="card" style="background-color: white" id="deneme">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4"><i class='fa fa-key'></i>Rol Ekle</h3>
            </div>
            <div class="row" id="deneme"><br>
                <div class="form-group">
                    {{ Form::label('name', 'İsim') }}
                    {{ Form::text('name', null, array('class' => 'form-control','required'=>'')) }}
                </div>

                <h5><b>Yetkileri Ata</b></h5>

                <div class='col-md-12'>
                    @foreach ($permissions as $permission)
                        <div class="col-md-3">
                            {{ Form::checkbox('permissions[]',  $permission->id ) }}
                            {{ Form::label($permission->name, ucfirst($permission->name)) }}
                        </div>
                    @endforeach
                </div>

                {{ Form::submit('Kaydet', array('class' => 'btn btn-primary','style'=>'float:right')) }}
            </div><br>
        </div>
        {{ Form::close() }}

    </section>

@endsection
