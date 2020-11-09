@if(count($actions)>0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Type</th>
            <th>Description</th>
            <th>Record</th>
        </tr>
    </thead>
    <tbody>
        @foreach($actions as $action)
        <tr>
            <td>{{$action->type}}</td>
            <td>{{$action->description}}</td>
            <td>
                @if($action->record)
                <audio controls>
                    <source src="{{$action->record}}" type="audio/mpeg">
                </audio>
                @else
                N/A
                @endif
            </td>
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