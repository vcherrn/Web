@extends('Admin.orders')


@section('tableContent')

  
    @foreach ($orders as $order)
   
    <tr  id="orders-contentT" >
        <td id="order-row">{{$order->id}}</td>
        <td> {{$order->name}} {{$order->surname}}</a></td>
        <td>{{$order->country}}</td>
        <td>{{date('Y-m-d H:i:s', ($order->created_at))}}</td>                        
    
        <td><span class="status text-success"></span> 
            @if ($order->isactive == 1)
                <span >Активен</span>
            @else
                <span >Неактивен</span>
            @endif
        </td>

        <td>
            @if ($order->ispayed == 1)
                <span class="status text-success"></span> 
                <span >Оплачен</span>
            @else
                <span class="status text-danger"></span> 
                <span >Не оплачен</span>
            @endif
        </td>

        <td>{{$order->order_sum}}</td>
        <td><a href="{{ route('order.edit', $order->id) }}" class="view" title="View Details" data-toggle="tooltip">
            <i class="material-icons">&#xE5C8;</i>
        </a></td>
    </tr>
    
    @endforeach
  
 
@endsection
