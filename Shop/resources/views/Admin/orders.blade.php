@extends('Admin.layout')

@section('title', 'список заказов')

@section('content')

    <div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Заказы</h2>
                    </div>
                   
                </div>
            </div>
            <div class="table-filter">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="show-entries">
                            <span>Показать</span>
                            <select id="entries-select" name="perPage" class="form-control">
                                
                                <option>5</option>
                                <option>10</option>
                                <option>15</option>
                                <option>25</option>
                            </select>
                            <span>записей</span>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <button id="filter-button"  type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <div class="filter-group">
                            <label>ID</label>
                            <input id="order-id" type="text" class="form-control">
                        </div>
                        <div class="filter-group">
                            <label>Оплата</label>
                            <select id="payment-filter" class="form-control">
                                 <option value="">Все</option>
                                <option value="1" >Есть</option>
                                <option value="0" >Нет</option>
                                							
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Статус</label>
                            <select id="status-filter" class="form-control">
                                  <option value="">Все</option>
                                <option value="1"  >Активные</option>
                                <option value="0" >Неактивные</option>
                            </select>
                        </div>
                        <span class="filter-icon"><i class="fa fa-filter"></i></span>
                    </div>
                </div>
            </div>
            
            <table id="orders-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Клиент</th>
                        <th>Страна</th>
                        <th>Дата заказа</th>						
                        <th>Статус</th>	
                        <th>Оплата</th>					
                        <th>Стоимость</th>
                        <th>Редактировать</th>
                    </tr>
                </thead>
                <tbody id="orders-container">
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
            >
        </a></td>
    </tr>
    
    @endforeach
        </tbody>      
    </table>
            
        </div>
        {{ $orders->links() }}
    </div>        
</div>   
        
        
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   
$(document).ready(function() {
    var perPage = $('#entries-select').val();
    var paymentFilter = $('#payment-filter').val();
    var statusFilter = $('#status-filter').val();
    let search_string = $('#order-id').val()
    // Функция для обновления содержимого таблицы
    function updateTable() {
        $.ajax({
            url: '{{ route("orders.show") }}',
            type: 'GET',
            data: {
                search_string: search_string,
                perPage: perPage,
                paymentFilter: paymentFilter,
                statusFilter: statusFilter
            },
            success: function(response) {
              
                var orders = $(response).find('#orders-container')
                
                $('#orders-container').html(orders.html());
                var pagination = $(response).find('.pagination');
                
                $('.pagination').html(pagination.html());
               
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Обработчик изменения количества записей на странице
    $('#entries-select').change(function() {
        perPage = $(this).val();
        updateTable();
    });

    // Обработчик изменения фильтра оплаты
    $('#payment-filter').change(function() {
        paymentFilter = $(this).val();
        updateTable();
    });

    // Обработчик изменения фильтра статуса
    $('#status-filter').change(function() {
        statusFilter = $(this).val();
        updateTable();
    });

    $(document).on('keyup', '#order-id', function(e) {
        e.preventDefault();
        search_string = $(this).val();
    updateTable()
       
      
    });


    // Обработчик события клика по ссылке пагинации
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        product(page);
       
      
    });

    function product(page) {
        var perPage = $('#entries-select').val();
        $.ajax({
            url: '{{ route("orders.show") }}',
            type: 'GET',
            data: {
                page: page,
                perPage: perPage,
                paymentFilter: paymentFilter,
                statusFilter: statusFilter
            },
            success: function(response) {
                var orders = $(response).find('#orders-container');
                $('#orders-container').html(orders.html());
                var pagination = $(response).find('.pagination');
                $('.pagination').html(pagination.html());
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    updateTable();   
          
});
           
</script>
        
<style>
           
            .table-responsive {
                margin: 30px 0;
            }
            .table-wrapper {
                min-width: 1000px;
                background: #fff;
                padding: 20px 25px;
                border-radius: 3px;
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }
            .table-wrapper .btn {
                float: right;
                color: #333;
                background-color: #fff;
                border-radius: 3px;
                border: none;
                outline: none !important;
                margin-left: 10px;
            }
            .table-wrapper .btn:hover {
                color: #333;
                background: #f2f2f2;
            }
            .table-wrapper .btn.btn-primary {
                color: #fff;
                background: #03A9F4;
            }
            .table-wrapper .btn.btn-primary:hover {
                background: #03a3e7;
            }
            .table-title .btn {		
                font-size: 13px;
                border: none;
            }
            .table-title .btn i {
                float: left;
                font-size: 21px;
                margin-right: 5px;
            }
            .table-title .btn span {
                float: left;
                margin-top: 2px;
            }
            .table-title {
                color: #fff;
                background: #4b5366;		
                padding: 16px 25px;
                margin: -20px -25px 10px;
                border-radius: 3px 3px 0 0;
            }
            .table-title h2 {
                margin: 5px 0 0;
                font-size: 24px;
            }
            .show-entries select.form-control {        
                width: 60px;
                margin: 0 5px;
            }
            .table-filter .filter-group {
                float: right;
                margin-left: 15px;
            }
            .table-filter input, .table-filter select {
                height: 34px;
                border-radius: 3px;
                border-color: #ddd;
                box-shadow: none;
            }
            .table-filter {
                padding: 5px 0 15px;
                border-bottom: 1px solid #e9e9e9;
                margin-bottom: 5px;
            }
            .table-filter .btn {
                height: 34px;
            }
            .table-filter label {
                font-weight: normal;
                margin-left: 10px;
            }
            .table-filter select, .table-filter input {
                display: inline-block;
                margin-left: 5px;
            }
            .table-filter input {
                width: 200px;
                display: inline-block;
            }
            .filter-group select.form-control {
                width: 110px;
            }
            .filter-icon {
                float: right;
                margin-top: 7px;
            }
            .filter-icon i {
                font-size: 18px;
                opacity: 0.7;
            }	
            table.table tr th, table.table tr td {
                border-color: #e9e9e9;
                padding: 12px 15px;
                vertical-align: middle;
            }
            table.table tr th:first-child {
                width: 60px;
            }
            table.table tr th:last-child {
                width: 80px;
            }
            table.table-striped tbody tr:nth-of-type(odd) {
                background-color: #fcfcfc;
            }
            table.table-striped.table-hover tbody tr:hover {
                background: #f5f5f5;
            }
            table.table th i {
                font-size: 13px;
                margin: 0 5px;
                cursor: pointer;
            }	
            table.table td a {
                font-weight: bold;
                color: #566787;
                display: inline-block;
                text-decoration: none;
            }
           
            table.table td a.view {        
                width: 30px;
                height: 30px;
                color: #2196F3;
                border: 2px solid;
                border-radius: 30px;
                text-align: center;
            }
           
            .status {
                font-size: 30px;
                margin: 2px 2px 0 0;
                display: inline-block;
                vertical-align: middle;
                line-height: 10px;
            }
           
            .pagination {
                float: right;
                margin: 0 0 5px;
            }
           
</style>
   
    
@endsection
