@if(count($actions)>0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($actions as $action)
        <tr>
            <td>{{$action->type}}</td>
            <td>{{$action->description}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div style="text-align:center;">
    {{ $actions->links("pagination::bootstrap-4") }}
</div>
@else
<div class="alert bg-red">
    no actions found
</div>
@endif