@extends('layouts.main') 
@section('title','Profile Edit') 
@section('content')


<div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile-update') }}">
                                {{ csrf_field() }}
                                    <div class="form-body">
                                        <h3 class="card-title">แก้ไขข้อมูล</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <label class="control-label">Name</label>
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                                                    @if ($errors->has('name'))
                                                    <small class="form-control-feedback">{{ $errors->first('name') }}</small>
                                                    @endif </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                                    <label class="control-label">Username</label>
                                                    <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" required >
                                                    @if ($errors->has('username'))
                                                    <small class="form-control-feedback">{{ $errors->first('username') }}</small>
                                                    @endif </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                    <label class="control-label">E-Mail Address</label>
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required >
                                                    @if ($errors->has('email'))
                                                    <small class="form-control-feedback">{{ $errors->first('email') }}</small>
                                                    @endif  </div>
                                            </div>
                                            
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                                    <label class="control-label">Password</label>
                                                    <input id="password" type="password" class="form-control" name="password">
                                                    @if ($errors->has('password'))
                                                    <small class="form-control-feedback">{{ $errors->first('password') }}</small>
                                                    @endif  </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="control-label">Comfirm Password</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                      
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <!--/row-->
                                       
                                        
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>บันทึก</button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection