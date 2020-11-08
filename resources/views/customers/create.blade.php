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
                    Create Customer
                </h2>
            </div>
            <div class="body">
                @include('includes.errors')
                @include('includes.message')
                <form id="form_advanced_validation" method="POST" action="{{route('customers.store')}}">
                    {{ csrf_field() }}
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="email" type="email" value="{{old('email')}}" class="form-control" name="email" maxlenght="200" required>
                            <label class="form-label">* Email</label>
                        </div>
                        <div class="help-info">Max. Char: 200</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="phone" type="text" value="{{old('phone')}}" class="form-control" name="phone" maxlenght="200" required>
                            <label class="form-label">* Phone</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="name" type="text" value="{{old('name')}}" class="form-control" name="name" maxlenght="200" required>
                            <label class="form-label">* Name</label>
                        </div>
                        <div class="help-info">Max. Char: 200</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input id="name" type="text" value="{{old('source')}}" class="form-control" name="source" maxlenght="200" required>
                            <label class="form-label">* Source</label>
                        </div>
                        <div class="help-info">ex:(compaign-email-facebook...)</div>
                    </div>
                    @role('admin')
                    <div>
                        <div>
                            <p><b>* Employee</b></p>
                            <select name="employee_id">
                                @foreach($employees as $employee)
                                <option {{old('employee_id')==$employee->id?'selected':''}} value="{{$employee->id}}">{{$employee->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endrole
                    <button style="margin-top:20px;" class="btn btn-primary waves-effect" type="submit">Create</button>
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