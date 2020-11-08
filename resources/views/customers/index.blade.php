@extends('master')
@section('body')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                @include('includes.message')
                <h2 style="margin-bottom: 10px;">
                    Customers
                </h2>
                <a href="{{route('customers.create')}}" class="btn btn-primary waves-effect">
                    <i class="material-icons">add</i>
                    <span>Create</span>
                </a>
                <div class="form-group form-float" style="margin-top:50px;">
                    <div class="form-line">
                        <input type="text" class="form-control" id="search" name="search" required>
                        <label class="form-label">* Search</label>
                    </div>
                </div>
            </div>
            @if(count($customers)>0)
            <div class="body table-responsive customers">
                @include('customers.table')
            </div>
            @else
            <div class="alert bg-red">
                no customers found
            </div>
            @endif
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
            var url = "{{route('customers.index')}}";
            var url = url + '?keyword=' + keyword + '&page=' + page;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('.customers').html(data);
                }
            });
        }
    });
</script>
@endsection