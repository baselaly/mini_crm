@extends('master')
@section('styles')
<link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection
@section('body')
<!-- Horizontal Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Edit User
                </h2>
            </div>
            <div class="body">
                @include('includes.errors')
                @include('includes.message')
                <form id="form_advanced_validation" method="POST" action="{{route('users.update',$user)}}">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="email" type="email" value="{{$user->email}}" class="form-control" name="email" maxlenght="200" required>
                            <label class="form-label">* Email</label>
                        </div>
                        <div class="help-info">Max. Char: 200</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="phone" type="text" value="{{$user->phone}}" class="form-control" name="phone" maxlenght="200" required>
                            <label class="form-label">* Phone</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="name" type="text" value="{{$user->name}}" class="form-control" name="name" maxlenght="200" required>
                            <label class="form-label">* Name</label>
                        </div>
                        <div class="help-info">Max. Char: 200</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="password" type="password" class="form-control" name="password">
                            <label class="form-label">password</label>
                        </div>
                        <div class="help-info"></div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="password_confirmation" type="password" value="" class="form-control" name="password_confirmation">
                            <label class="form-label">password confirmation</label>
                        </div>
                        <div class="help-info"></div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <p><b>* Roles</b></p>
                            <select name="role" value="{{old('role')}}">
                                @foreach($roles as $role)
                                <option {{$user->type==$role->name?'selected':''}} value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button style="margin-top:20px;" class="btn btn-primary waves-effect" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Validation Plugin Js -->
<script src="{{asset('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/form-validation.js')}}"></script>
@endsection