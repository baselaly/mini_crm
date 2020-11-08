@if(count($customers)>0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Employee</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{$customer->name}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->employee->name}}</td>
            <td>
                <a href="{{route('customers.edit',$customer->id)}}" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">edit</i>
                </a>
                <a href="{{route('customers.action',$customer->id)}}" type="button" class="btn bg-green">
                    actions
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div style="text-align:center;">
    {{ $customers->links("pagination::bootstrap-4") }}
</div>
@else
<div class="alert bg-red">
    no customers found
</div>
@endif