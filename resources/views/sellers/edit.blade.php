@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Seller Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('agents.update', $seller->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{translate('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" value="{{$seller->name}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{translate('Email Address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Email Address')}}" id="email" name="email" class="form-control" value="{{$seller->email}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{translate('Password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" placeholder="{{translate('Password')}}" id="password" name="password" class="form-control">
                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{translate('Phone')}}</label>
                    <div class="col-sm-9">
                        <input type="number" placeholder="{{translate('Phone Number')}}" id="phone" name="phone" class="form-control" value="{{$seller->phone}}" required>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{translate('Address')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" placeholder="{{translate('Address')}}" id="address" name="address" class="form-control" required rows="4">{{$seller->address}}</textarea>
                    </div>
                </div>              
                 <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{translate('profile')}}</label>
                    <div class="col-sm-9">
                        <input type="file"  id="password" name="profile" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
