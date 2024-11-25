@extends('Admin.layout')

@section('title', 'Пользователи')

@section('content')

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Пользователи</h2>
                    </div>
                    
                </div>
            </div>
            <div class="table-filter">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="show-entries">
                            <span>Показать</span>
                            <select id="entries-select" class="form-control">
                                <option>5</option>
                                <option>10</option>
                                <option>15</option>
                                <option>20</option>
                            </select>
                            <span>записей</span>
                        </div>
                    </div>
                    
                    <div class="col-sm-9">
                        <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <div class="filter-group">
                            <label>ID</label>
                            <input id="user-name" type="text" class="form-control">
                        </div>
                        
                        <div class="filter-group">
                            <label>Роль</label>
                            <select id="user-filter" class="form-control">
                                  <option value="">Все</option>
                                <option value="1"  >Админы</option>
                                <option value="0" >Клиенты</option>
                                <option value="2" >Заблокированные</option>
                                
                            </select>
                        </div>
                        <span class="filter-icon"><i class="fa fa-filter"></i></span>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Почта</th>
                        <th>Дата создания учентой записи</th>						
                        <th>Админ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="users-container">
                   

                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td> {{$user->name}} </a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>                        
                           
                           
                            <td>
                               
                                  <label class="label">
                                    <div class="toggle">
                                        <input class="toggle-state" type="checkbox" name="user_role" 
                                               data-user-id="{{ $user->id }}"
                                               {{ $user->user_role == 1 ? 'checked' : '' }} />
                                        <div class="indicator"></div>
                                    </div>
                                </label>

                                
                            </td>
                            <?php
                                $linkText = $user->user_role == 2 ? 'Разблокировать' : 'Заблокировать';
                            ?>
                            <td> 
                                <a id="ban-option" data-user-id="{{ $user->id }}"
                                    href=""  >{{$linkText}} </a> 
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
                
            </table>
            {!! $users->links() !!}
           
        </div>
    </div>  
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
    $('.toggle-state').on('change', function() {
        var input = $(this);
        var newValue = input.is(':checked') ? 0 : 1;
        var userId = input.data('user-id');
        
        $.ajax({
            url: 'users/edit-role/' + userId,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                user_role: newValue
                
            },
            error: function(xhr, status, error) {
                // input.prop('checked', !input.is(':checked'));
            }
        });
    });

    var perPage = $('#entries-select').val();
    var userFilter = $('#user-filter').val();
    let search_string = $('#user-name').val()
    function updateTable() {
        $.ajax({
            url: '{{ route("users.show") }}',//'/admin/home/users',
            type: 'GET',
            data: {
                search_string: search_string,
                perPage: perPage,
                userFilter: userFilter,
            },
            success: function(response) {
              
                var users = $(response).find('#users-container')
                
                $('#users-container').html(users.html());
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
    $('#user-filter').change(function() {
        userFilter = $(this).val();
        updateTable();
    });


    $(document).on('keyup', '#user-name', function(e) {
        e.preventDefault();
        search_string = $(this).val();
    updateTable()
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        product(page);
    });
    function product(page) {
        var perPage = $('#entries-select').val();
        $.ajax({
            url: '{{ route("users.show") }}',
            type: 'GET',
            data: {
                page: page,
                perPage: perPage,
                userFilter: userFilter,
            },
            success: function(response) {
                var orders = $(response).find('#users-container');
                $('#users-container').html(orders.html());
                var pagination = $(response).find('.pagination');
                $('.pagination').html(pagination.html());
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    $(document).on('click', '#ban-option', function(e) {
        var input = $(this);
        var newValue = 2;
        console.log(input)
        var userId = input.data('user-id');
        
        $.ajax({
            url: 'users/edit-role/' + userId,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                user_role: newValue
            },
            error: function(xhr, status, error) {
                // input.prop('checked', !input.is(':checked'));
            }
        });
    });
   

});

            
        </script>

<style>
    /*  */
  .toggle {
    isolation: isolate;
    position: relative;
    height: 30px;
    width: 60px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow:
    -8px -4px 8px 0px #ffffff,
    8px 4px 12px 0px #d1d9e6,
    4px 4px 4px 0px #d1d9e6 inset,
    -4px -4px 4px 0px #ffffff inset;
    }

    .toggle-state {
    display: none;
    }

    .indicator {
    height: 100%;
    width: 200%;
    background: #92d7ec;
    border-radius: 15px;
    transform: translate3d(-75%, 0, 0);
    transition: transform 0.4s cubic-bezier(0.85, 0.05, 0.18, 1.35);
    box-shadow:
        -8px -4px 8px 0px #ffffff,
        8px 4px 12px 0px #d1d9e6;
    }

    .toggle-state:checked ~ .indicator {
    transform: translate3d(25%, 0, 0);
    }
   /*  */
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
   
    </style>

@endsection