<div class="table-responsive">
    <table class="table" id="orderdetails-table">
        <thead>
            <tr>
                <th>Productid</th>
        <th>Orderid</th>
        <th>Quantity</th>
        <th>Subtotal</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orderdetails as $orderdetail)
            <tr>
                <td>{{ $orderdetail->productid }}</td>
            <td>{{ $orderdetail->orderid }}</td>
            <td>{{ $orderdetail->quantity }}</td>
            <td>{{ $orderdetail->subtotal }}</td>
                <td>
                    {!! Form::open(['route' => ['orderdetails.destroy', $orderdetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('orderdetails.show', [$orderdetail->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('orderdetails.edit', [$orderdetail->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
