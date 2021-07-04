@extends('layouts.app')

@section('content')
<style type="text/css">
    .form-horizontal .form-group{
      margin-left: 0px;
      margin-right: 0px;
    }
    .form-control{
        border: 1px solid black;
    }
    .danger{ color:red; }
</style>

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Customer Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('agent.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label" for="name">{{translate('name')}}</label>
                            <input type="text" tooltip="candidate name" placeholder="{{translate('name')}}" id="name" name="name" class="form-control">
                            {!! $errors->first('name', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label" for="mothername">{{translate('mothername')}}</label>
                            <input type="text" tooltip="candidate name" placeholder="{{translate('mothername')}}" id="mothername" name="mothername" class="form-control">
                            {!! $errors->first('name', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label"  for="fathername">{{translate('fathername')}}</label>
                            <input type="text" placeholder="{{translate('fathername')}}" id="fathername" name="fathername" class="form-control">
                            {!! $errors->first('fathername', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label" for="dob">{{translate('dob')}}</label>
                            <input type="text" tooltip="Date Of Birth" placeholder="{{translate('Date Of Birth')}}" id="dob" name="dob" class="form-control">
                            {!! $errors->first('dob', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label" for="gender">{{translate('gender')}}</label>
                            <select name="gender" class="form-control"> 
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                 <option value="female">female</option>
                            </select>
                            {!! $errors->first('gender', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label"  for="aadhar_no">{{translate('Aadhar No')}}</label>
                            <input type="text" placeholder="{{translate('Aadhar No')}}" id="aadhar_no" name="aadhar_no" class="form-control">
                            {!! $errors->first('aadhar_no', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label" for="pan_number">{{translate('Pan Number')}}</label>
                            <input type="text" tooltip="Date Of Birth" placeholder="{{translate('pan number')}}" id="pan_number" name="pan_number" class="form-control">
                            {!! $errors->first('pan_number', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                          <label class="control-label" for="account">{{translate('Account')}}</label>
                        <input type="text" placeholder="{{translate('account')}}" id="account" name="account" class="form-control" >
                          {!! $errors->first('account', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label" for="ifsc">{{translate('ifsc')}}</label>
                             <input type="text" placeholder="{{translate('ifsc')}}" id="ifsc" name="ifsc" class="form-control" >
                           {!! $errors->first('ifsc', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">                     
                        <div class="form-group">
                          <label class="control-label" for="bankname">{{translate('bankname')}}</label>
                            <input type="text" placeholder="{{translate('bankname')}}" id="bankname" name="bankname" class="form-control">
                            {!! $errors->first('bankname', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                         <label class="control-label" for="branch_name">{{translate('Branch')}}</label>
                        <input type="text" placeholder="{{translate('branch name')}}" id="branch_name" name="branch_name" class="form-control" >
                          {!! $errors->first('branch_name', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label" for="shop_name">{{translate('Shopname')}}</label>
                             <input type="text" placeholder="{{translate('shop_name')}}" id="shop_name" name="shop_name" class="form-control" >
                           {!! $errors->first('shop_name', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-4">                     
                        <div class="form-group">
                          <label class="control-label" for="ponumber">{{translate('ponumber')}}</label>
                            <input type="text" placeholder="{{translate('ponumber')}}" id="ponumber" name="ponumber" class="form-control">
                            {!! $errors->first('ponumber', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                         <label class="control-label" for="psnumber">{{translate('psnumber')}}</label>
                        <input type="text" placeholder="{{translate('psnumber')}}" id="psnumber" name="psnumber" class="form-control" >
                          {!! $errors->first('psnumber', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                            <label class="control-label" for="mobile_number">{{translate('Mobile Number')}}</label>
                             <input type="text" placeholder="{{translate('mobile_number')}}" id="mobile_number" name="mobile_number" class="form-control" >
                           {!! $errors->first('mobile_number', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label" for="district">{{translate('District')}}</label>
                            <input type="text" placeholder="{{translate('district')}}" id="district" name="district" class="form-control">
                            {!! $errors->first('district', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                         <label class="control-label" for="pinnumber">{{translate('Pinnumber')}}</label>
                         <input type="text" placeholder="{{translate('pinnumber')}}" id="pinnumber" name="pinnumber" class="form-control" >
                          {!! $errors->first('pinnumber', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="name">{{translate('type')}}</label>
                            <select name="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="loan">loan</option>
                                 <option value="rd">Rd</option>
                            </select>
                           {!! $errors->first('type', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">                     
                        <div class="form-group">
                          <label class="control-label" for="district">{{translate('Address')}}</label>
                            <textarea type="text" placeholder="{{translate('address')}}" id="address" name="address" class="form-control"></textarea>
                            {!! $errors->first('address', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                         <label class="control-label" for="loan_price">{{translate('Loan Price')}}</label>
                         <input type="text" placeholder="{{translate('loan_price')}}" value="" name="loan_price" class="form-control" >
                          {!! $errors->first('loan_price', '<p class="help-block danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">                     
                        <div class="form-group">
                          <label class="control-label" for="photo">{{translate('photo')}}</label>
                          <input type="file"  id="photo" name="photo" class="form-control" >
                          {!! $errors->first('photo', '<p class="help-block danger">:message</p>') !!}
                        </div>
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
