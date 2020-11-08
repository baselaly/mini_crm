@extends('master')
@section('styles')
<link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection
@section('body')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="margin-bottom: 10px;">
                    Customer
                </h2>
            </div>
            <div class="body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>name</th>
                            <td>{{$customer->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$customer->email}}</td>
                        </tr>
                        <tr>
                            <th>Source</th>
                            <td>{{$customer->source}}</td>
                        </tr>
                        <tr>
                            <th>Employee</th>
                            <td>{{$customer->employee->name}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Horizontal Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Create Action
                </h2>
            </div>
            <div class="body">
                @include('includes.errors')
                @include('includes.message')
                <form id="form_advanced_validation" method="POST" action="{{route('actions.store',$customer->id)}}">
                    {{ csrf_field() }}
                    <div class="form-group form-float">
                        <label class="form-label">* Result Description</label>
                        <div class="form-line">
                            <textarea name="description" value="{{old('description')}}" cols="30" rows="5" class="form-control no-resize">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p><b>* Type</b></p>
                            <select name="type">
                                @if(!old('type'))
                                <option selected disabled>select type</option>
                                @endif
                                @foreach($types as $type)
                                <option {{old('type')==$type?'selected':''}} value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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