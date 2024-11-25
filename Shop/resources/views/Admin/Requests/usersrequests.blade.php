@extends('Admin.layout')

@section('title', 'заявки клиентов')

@section('content')

    <div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Заявки клиентов</h2>
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
                            <label>Тип заявки</label>
                            <select id="type-filter" class="form-control">
                                <option value="">Все</option>
                                @foreach ($requestTypes as $requestType)
                                <option value="{{$requestType->id}}">
                                    {{ $requestType->title }}
                                  </option>
                                @endforeach
                                							
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Статус</label>
                            <select id="status-filter" class="form-control">
                                <option value="">Все</option>
                                <option value="1">Активные</option>
                                <option value="0">Неактивные</option>		
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
                        <th>Имя</th>
                        <th>Страна</th>
                        <th>Город</th>						
                        <th>Номер телефона</th>	
                        <th>Почта</th>					
                        <th>Дата</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody id="orders-container">
                    @foreach ($activeRequests as $activeRequest)
                        <tr  id="orders-contentT" >
                            <td id="order-row">{{$activeRequest->id}}</td>
                            <td> {{ $users->firstWhere('id', $activeRequest->user_id)->name }} </a></td>
                            <td>{{$activeRequest->country}}</td>
                            <td>{{$activeRequest->town}}</td>
                            <td>{{$activeRequest->telephone_number}}</td>
                            <td>{{$activeRequest->user_email}}</td>
                            <td>{{date('Y-m-d H:i:s', ($activeRequest->created_at))}}</td>                        
                        
                            <td><span class="status text-success"></span> 
                                @if ($activeRequest->request_status == 1)
                                    <span class = "text-success" >Активен</span>
                                @else
                                    <span class = "text-danger" >Неактивен</span>
                                @endif
                            </td>

                            

                            <td>{{$activeRequest->order_sum}}</td>
                            <td><a href="{{ route('activerequests.edit', [ 'id' => $activeRequest->id , 
                                'user' => $users->firstWhere('id', $activeRequest->user_id)]) }}" class="view" title="View Details" data-toggle="tooltip">
                                >
                            </a></td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
          
            
                {{ $activeRequests->links() }}
            
          
        </div>
    </div>        
</div>   
        
        
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   
$(document).ready(function() {
    var perPage = $('#entries-select').val();
    var typeFilter = $('#type-filter').val();
    var statusFilter = $('#status-filter').val();
    let search_string = $('#order-id').val()
    // Функция для обновления содержимого таблицы
    function updateTable() {
        $.ajax({
            url: '{{ route("activerequests.index") }}',
            type: 'GET',
            data: {
                search_string: search_string,
                perPage: perPage,
                typeFilter: typeFilter,
                statusFilter: statusFilter,
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

   
    $('#type-filter').change(function() {
        typeFilter = $(this).val();
        updateTable();
    });

    $('#status-filter').change(function() {
        statusFilter = $(this).val();
        updateTable();
    });

    $(document).on('keyup', '#order-id', function(e) {
        e.preventDefault();
        search_string = $(this).val();
    updateTable()
       
      
    });


//     // Обработчик события клика по ссылке пагинации
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        product(page);
       
      
    });

    function product(page) {
        var perPage = $('#entries-select').val();
        $.ajax({
            url: '{{ route("activerequests.index") }}',// '/admin/home/orders',
            type: 'GET',
            data: {
                page: page,
                perPage: perPage,
                typeFilter: typeFilter,
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
            table.table td a:hover {
                color: #2196F3;
            }
            table.table td a.view {        
                width: 30px;
                height: 30px;
                color: #2196F3;
                border: 2px solid;
                border-radius: 30px;
                text-align: center;
            }
            table.table td a.view i {
                font-size: 22px;
                margin: 2px 0 0 1px;
            }   
            table.table .avatar {
                border-radius: 50%;
                vertical-align: middle;
                margin-right: 10px;
            }
            .status {
                font-size: 30px;
                margin: 2px 2px 0 0;
                display: inline-block;
                vertical-align: middle;
                line-height: 10px;
            }
            .text-success {
                color: #10c469;
            }
            .text-info {
                color: #62c9e8;
            }
            .text-warning {
                color: #FFC107;
            }
            .text-danger {
                color: #ff5b5b;
            }
            .pagination {
                float: right;
                margin: 0 0 5px;
            }
            .pagination li a {
                border: none;
                font-size: 13px;
                min-width: 30px;
                min-height: 30px;
                color: #999;
                margin: 0 2px;
                line-height: 30px;
                border-radius: 2px !important;
                text-align: center;
                padding: 0 6px;
            }
            .pagination li a:hover {
                color: #666;
            }	
            .pagination li.active a {
                background: #03A9F4;
            }
            .pagination li.active a:hover {        
                background: #0397d6;
            }
            .pagination li.disabled i {
                color: #ccc;
            }
            .pagination li i {
                font-size: 16px;
                padding-top: 6px
            }
            .hint-text {
                float: left;
                margin-top: 10px;
                font-size: 13px;
            }    
            </style>
   
    
@endsection
