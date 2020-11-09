@extends('master')
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
            <div class="header">
                @include('includes.message')
                <h2 style="margin-bottom: 10px;">
                    Actions
                </h2>
                <a href="{{route('actions.create',$customer->id)}}" class="btn btn-primary waves-effect">
                    <i class="material-icons">add</i>
                    <span>Create</span>
                </a>
                <div class="form-group form-float" style="margin-top:50px;">
                    <div class="form-line">
                        <input type="text" value="{{request('keyword')}}" class="form-control" id="search" name="search" required>
                        <label class="form-label">* Search actions</label>
                    </div>
                </div>
            </div>
            <div class="body table-responsive actions">
                @include('actions.table')
            </div>
        </div>
    </div>
</div>
<!-- #END# Bordered Table -->
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        var keyword = '';

        $(document).on('keyup', '#search', function(e) {
            keyword = $.trim($('#search').val());
            fetch_data(1);
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            var url = "{{route('customers.action',$customer->id)}}";
            var url = url + '?keyword=' + keyword + '&page=' + page;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('.actions').html(data);
                }
            });
        }
    });
</script>
@endsection