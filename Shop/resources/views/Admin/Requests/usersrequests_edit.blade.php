@extends('Admin.layout')

@section('title', 'Заказ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="grid invoice">
                    <div class="grid-body">
                        <div class="invoice-title">
                            <div class="row">
                                <div class="col-xs-12">
                                    <img src="http://vergo-kertas.herokuapp.com/assets/img/logo.png" alt="" height="35">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2><br>
                                    <span class="small">ЗАЯВКА #{{$order->id}}</span></h2>
                                </div>
                                                

                            </div>
                            <strong> ДОПОЛНИТЕЛЬНЫЫЕ СВЕДЕНИЯ О КЛИЕНТЕ: </strong>
                                
                                    <br>
                                    Вес: {{$user_characteristics[0]->weight}} <br>
                                    Рост:  {{$user_characteristics[0]->height}} <br>
                                    Возраст:  {{$user_characteristics[0]->age}} <br>
                                    Подробности травмы:  {{$user_characteristics[0]->details}} <br>
                               
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                               <strong> ИНФОРМАЦИЯ О КЛИЕНТЕ: </strong>
                                <br>
                                        ФИО: {{$order->surname}} {{$order->name}} {{$order->patronymic}} <br>
                                        Адрес: {{$order->country}}, {{$order->town}}, {{$order->area}}, ул. {{$order->street}},
                                        д. {{$order->house}}, кв. {{$order->apartment}} <br>
                                        Почта: {{$order->user_email}} <br>
                                        Номер телефона: {{$order->telephone_number}} 
                                       
                               
                            </div>
                                            
                        </div>
                        
                        <div class="row">
                        <div class="col-xs-6 ">
                            <address>
                                <strong>Дата:</strong><br>
                                {{date('H:i Y-m-d', ($order->created_at))}}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>ПОДРОБНОСТИ</h3>
                            <div style="width: 120vh; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{$order->message_text}}
                            </div>
                            </div>									
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right identity">
                                <p>Магазин протезов<br><strong>ProtoType</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                      
                        <a class="btn btn-primary"  href="{{ route('activerequests.delete', $order->id) }}">
                            
                            Выполнить
                        </a>
                                      
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

.invoice .table tr.line {
	border-bottom: 1px solid #ccc;
}

.invoice .table td {
	border: none;
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