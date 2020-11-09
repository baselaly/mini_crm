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
                <div id="error-container" class="alert bg-red" style="text-align: center; display:none;">
                </div>
                <div id="message-container" class="alert bg-green" style="text-align: center; display:none;">
                </div>
                <form id="form_advanced_validation" method="POST" action="{{route('actions.store',$customer->id)}}">
                    {{ csrf_field() }}
                    <input type="file" id="recordFile" style="opacity:0;" name="record">
                    <div class="form-group form-float">
                        <label class="form-label">* Result Description</label>
                        <div class="form-line">
                            <textarea name="description" id="description" value="{{old('description')}}" cols="30" rows="5" class="form-control no-resize" required>{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <p><b>* Type</b></p>
                            <select name="type" id="type" required>
                                @if(!old('type'))
                                <option selected disabled>select type</option>
                                @endif
                                @foreach($types as $type)
                                <option {{old('type')==$type?'selected':''}} value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <p>You May Record the results from here..</p>
                    <button class="record btn bg-green" type="button">Record</button>
                    <button class="stop btn bg-red" type="button" disabled>Stop</button>
                    <p style="display:inline-block; margin:10px;" id="recordState"></p>
                    <div class="sound-clips" style="padding:20px;">
                    </div>
                    <button style="margin-top:20px;" class="btn btn-primary waves-effect createButton" type="button">Create</button>
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
<script type="text/javascript" src="{{asset('site/js/record.js')}}"></script>
@endsection