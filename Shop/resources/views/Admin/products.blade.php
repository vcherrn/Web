@extends('Admin.layout')

@section('title', 'список протезов')

@section('content')


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все товары</h1>
                </div>
            </div>
            
        </div>
    </div>

    <section class="content">
        
        <div class="container-fluid">
           
                <div class="card">
                    <div class="card-header">

                     
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
                              
                                <div class="filter-group">
                                    <label>Название</label>
                                    <input id="product-id" type="text" class="form-control">
                                </div>
                                <div class="filter-group">
                                    <label>В наличии</label>
                                    <select id="status-filter" class="form-control">
                                        <option value="">Все</option>
                                        <option value="1" >Есть</option>
                                        <option value="0" >Нет</option>                     
                                    </select>
                                </div>
                               
                                <div class="filter-group">
                                    <label>Категория</label>
                                    <select  id="category-filter" class="form-control">
                                        <option value="">Все</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                                  
                                    </select>
                                </div>
                                
                                <span class="filter-icon"><i class="fa fa-filter"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                      <table class="table table-striped projects">
                          <thead>
                            
                                
                            
                              <tr>
                                  <th style="width: 1%">
                                      ID
                                  </th>
                                  <th style="width: 20%">
                                        Название
                                  </th>
                                  <th style="width: 30%">
                                      Фото
                                  </th>
                                  <th>
                                     Цена
                                  </th>
                                  <th style="width: 8%" class="text-center">
                                      Наличие
                                  </th>
                                  <th style="width: 20%">
                                  </th>
                              </tr>
                          </thead>
                          <tbody id="table-content">
                            @foreach ($prostheses as $prosthes)
                              <tr>
                                  <td>
                                      {{ $prosthes['id'] }}
                                  </td>
                                  <td>
                                      <a>
                                        {{ $prosthes['name'] }}
                                      </a>
                                      <br/>
                                     
                                      <small>
                                         
                                          Обновлено: {{ date('Y-m-d H:i:s', ($prosthes['updated_at'])) }} 
                                      </small>
                                  </td>
                                  <td>
                                      <ul class="list-inline">
                                        @foreach (json_decode($prosthes->photos) as $photo)
                                        <li class="list-inline-item">
                                            <img alt="Product" class="table-avatar img-square" src="{{ asset('storage/'.$photo) }}">
                                        </li>

                                            
                                        @endforeach
                                          
                                      </ul>
                                  </td>
                                  <td class="project_progress">
                                      {{ $prosthes['price'] }}р
                                  </td>
                                  <td class="project-state">
                                    @if ($prosthes['status'] == 1)
                                        <span class="badge badge-success">Есть</span>
                                    @else
                                        <span class="badge badge-danger">Нет</span>
                                    @endif
                                      
                                  </td>
                                  <td class="project-actions text-right">
                                     
                                      <a class="btn btn-info btn-sm" href="{{ route('product.edit', $prosthes['id']) }}">
                                          <i class="fas fa-pencil-alt">
                                          </i>
                                          Редактировать
                                      </a>
                                      <a class="btn btn-danger btn-sm" href="{{ route('product.delete', $prosthes['id']) }}">
                                          <i class="fas fa-trash">
                                          </i>
                                          Убрать
                                      </a>
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                         
                      </table>
                      {{$prostheses->links()}}
                    </div>
                   
                  </div>
          
        </div>
        
        
      
    
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   
$(document).ready(function() {
    var perPage = $('#entries-select').val();
    var statusFilter = $('#status-filter').val();
    var categoryFilter = $('#category-filter').val();
    let search_string = $('#order-id').val()
    // Функция для обновления содержимого таблицы
    function updateTable() {
        $.ajax({
            url: '{{ route("products.show") }}',
            type: 'GET',
            data: {
                search_string: search_string,
                perPage: perPage,
                statusFilter: statusFilter,
                categoryFilter: categoryFilter,
            },
            success: function(response) {
                var orders = $(response).find('#table-content')
                $('#table-content').html(orders.html());
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

    // Обработчик изменения фильтра статуса
    $('#status-filter').change(function() {
        statusFilter = $(this).val();
        updateTable();
    });

    $('#category-filter').change(function() {
        categoryFilter = $(this).val();
        updateTable();
    });

    $(document).on('keyup', '#product-id', function(e) {
        e.preventDefault();
        search_string = $(this).val();
        updateTable()
    });

// Обработчик события клика по ссылке пагинации
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        show_products(page);
    });
 
    function show_products(page) {
        var perPage = $('#entries-select').val();
        $.ajax({
            url: '{{ route("products.show") }}',
            type: 'GET',
            data: {
                page: page,
                perPage: perPage,
                categoryFilter: categoryFilter,
                statusFilter: statusFilter,
            },
            success: function(response) {
                var orders = $(response).find('#table-content');
                $('#table-content').html(orders.html());
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
    .table-avatar {
    border-radius: 0 !important; 
    object-fit: cover; 
    width: 50px; 
    height: 50px;
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
</style>

@endsection
