@extends('Admin.layout')

@section('title', 'Заказ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="grid invoice">
                    
                    <div class="grid-body">
                        <div class="invoice-title">
                            <br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2>ИНФОРМАЦИЯ О ЗАКАЗЕ<br>
                                    <span class="small">заказ #{{$order->id}}</span></h2>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                <address>
                                    <strong>Информация о клиенте:</strong><br>
                                        <br>
                                        ФИО: {{$order->surname}} {{$order->name}} {{$order->patronymic}} <br>
                                        Адрес: <br> {{$order->country}}, {{$order->town}}, {{$order->area}}, ул. {{$order->street}},
                                        д. {{$order->house}}, кв. {{$order->apartment}} <br>
                                        <p  title="Phone" > Номер телефона: {{$order->telephone_number}}</p> 
                                        <p  title="Phone" > Почта: {{$order->user_email}}   </p> 
                                </address>
                            </div>                
                        </div>
                        <div>
                            <h5>ПРИМЕЧАНИЯ:</h5>
                            <h6> {{$order->message_text}}</h6>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                    <strong>Способ оплаты:</strong><br>
                                    {{$order->payment_method}}  <br>
                            </div>
                            <div class="col-xs-6 text-right " style="margin-left: 10vh">
                                    <strong>Время заказа:</strong><br>
                                    {{date('H:i Y-m-d', ($order->created_at))}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>ПОДРОБНОСТИ</h3>
                                <form method="POST" action="{{ route('order.updatePrices', ['id' => $order->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="line">
                                                <td><strong>#</strong></td>
                                                <td class="text-center"><strong>Продукт</strong></td>
                                                <td class="text-center"><strong></strong></td>
                                                <td class="text-right"><strong>Сторона</strong></td>
                                                <td class="text-right"><strong>Число</strong></td>
                                                <td class="text-right"><strong>Цена</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = 0;
                                                $canChangePrice = false;
                                            @endphp
                                        
                                            @foreach ($prostheses as $prosthes)
                                                @php
                                                    $counter++;
                                                @endphp
                                                <tr>
                                                    <td>{{$counter}}</td>
                                                    <td class="text-center" style="width: 100vh"><strong>{{$prosthes[0]->name}}</strong><br>
                                                
                                                    </td>
                                                    
                                                    <td class="text-center"></td>
                                                    <td class="text-center">{{$prosthes_order[$counter-1]->side}}</td>
                                                    <td class="text-center">{{$prosthes_order[$counter-1]->count}}</td>
                                                
                                                    <td class="text-right"> 
                                                        @if ($prosthes_order[$counter-1]->price)
                                                            <input style="max-width: 100px" type="text" 
                                                                name="prices[{{$prosthes[0]->id}}_{{$prosthes_order[$counter-1]->side}}]" 
                                                                value="{{$prosthes_order[$counter-1]->price}}">
                                                        @else
                                                            <input style="max-width: 100px; background-color:#dee2e6" type="text" 
                                                                name="prices[{{$prosthes[0]->id}}_{{$prosthes_order[$counter-1]->side}}]" 
                                                                value="{{$prosthes[0]->price}}" readonly>
                                                            
                                                        @endif
                                                    </td>
                                                    @if ($prosthes_order[$counter-1]->specification != null)
                                                        <td style="display: none" class="text-right">{{ $canChangePrice = true }}</td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                                            
                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="text-right"><strong></strong></td>
                                                <td class="text-right">
                                                    <div class="input-group-append">
                                                        <button {{ $order->isactive ? '' : 'disabled ' }} 
                                                            class="btn btn-primary" type="submit">ИЗМЕНИТЬ</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                </td><td class="text-right"><strong>Всего</strong></td>
                                                <td class="text-right"><strong>{{$order->order_sum}}</strong></td>
                                            
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>									
                        </div>
                        
                        <div class="col-md-12">
                            <h3>ПРАВКИ В СПЕЦИФИКАЦИИ</h3>
                            @php
                                $processedProstheses = [];
                            @endphp
                            @foreach ($prostheses as $prosthesis)
                                @php
                                    $hasSpecification = false;
                                    $prosthesisId = $prosthesis[0]->id;
                                @endphp
                                @if (!in_array($prosthesisId, $processedProstheses))
                                    @foreach ($prosthes_order as $item)
                                        @if ($item->prosthes_id == $prosthesisId && $item->specification != null)
                                            @php
                                                $hasSpecification = true;
                                                $specification = json_decode($item->specification);
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($hasSpecification)
                                        @php
                                            $processedProstheses[] = $prosthesisId;
                                        @endphp
                                        <h4> <strong> {{ $prosthesis[0]->name }} </strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                                @foreach ($specification as $key => $value)
                                                    <tr>
                                                        <th style="width: 30%">{{ $key }}</th>
                                                        <td style="width: 70%">{{ $value }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                      
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        
                        <div class="row">
                            <div class="col-md-12 text-right identity">
                                <p>Магазин протезов<br><strong>ProtoType</strong></p>
                            </div>
                            <div class="col-md-12 text-right">
                                <form method="POST" action="{{ route('order.success', $order->id) }}">
                                    
                                </form>
                                <div class="btn-group" role="group">
                                    <form method="POST" action="{{ route('order.success', $order->id) }}">
                                        @csrf
                                        @method('PUT')
                                
                                        <button {{ $order->isactive ? '' : 'disabled ' }} 
                                            class="btn btn-success" type="submit">   Выполнить заказ</button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('order.cancel', $order->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button {{ $order->isactive ? '' : 'disabled ' }} 
                                            class="btn btn-danger" type="submit"> 
                                            <i class="fas fa-trash"></i>
                                            Аннулировать</button>
                                
                                    </form>
                                </div>      
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
                           
    </div>
</div>

<style>
    .invoice {
    padding: 30px;
}

.invoice h2 {
	margin-top: 0px;
	line-height: 0.8em;
}

.invoice .small {
	font-weight: 300;
}

.invoice hr {
	margin-top: 10px;
	border-color: #ddd;
}


.invoice .identity {
	margin-top: 10px;
	font-size: 1.1em;
	font-weight: 300;
}

.invoice .identity strong {
	font-weight: 600;
}


.grid {
    position: relative;
	width: 100%;
	background: #fff;
	color: #666666;
	border-radius: 2px;
	margin-bottom: 25px;
	box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
}
    </style>
@endsection