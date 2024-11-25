@extends('Admin.layout')

@section('title', 'список категорий')

@section('content')


    
        
    
<!-- Site wrapper -->
<div class="wrapper">
  
  <div class="content-wrapper">
  
    <section class="content ">
      <div class="row ">
        <div class="col-md-10">
        
          <div class="card card-info mt-5">
            <div class="card-header">
              <h3 class="card-title">Категории</h3>

            
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Категория</th>
                    <th>Тип</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                    <tr>
                      <td>{{$category->name}}</td>
                      <td>{{$types[$category->type_id]}}</td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">

                          <a href="{{ route('categorylist.edit', $category->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>

                          <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger" onclick="event.preventDefault(); 
                          document.getElementById('delete-form-{{ $category->id }}').submit();"><i class="fas fa-trash"></i></a>
                          <form id="delete-form-{{ $category->id }}" action="{{ route('category.delete', $category->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                          </form>
                      
                        </div>
                      </td>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="{{ route('category.create') }}" class="btn btn-secondary">Добавить</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->








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
