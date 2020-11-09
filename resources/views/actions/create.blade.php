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
                    <div class="form-group form-float">
                        <div class="form-line">
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
                    <div class="form-group form-float" style="width:90%">
                        <p><b>Record (optional)</b></p>
                        <div class="form-line">
                            <input style="margin-left: 50px;" type="file" hidden class="form-control" name="record">
                        </div>
                        <div class="help-info">upload the recorded file from here</div>
                    </div>
                    <p>You May Record the results from here and download your appropriate record</p>
                    <div id="controls">
                        <button class="btn bg-green waves-effect" type="button" id="recordButton">Record</button>
                        <button class="btn bg-blue waves-effect" type="button" id="pauseButton" disabled>Pause</button>
                        <button class="btn bg-red waves-effect" type="button" id="stopButton" disabled>Stop</button>
                    </div>
                    <h3>Recordings</h3>
                    <ul style="list-style:none;" id="recordingsList"></ul>
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
<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script type="text/javascript" src="{{asset('site/js/record.js')}}"></script>
@endsection