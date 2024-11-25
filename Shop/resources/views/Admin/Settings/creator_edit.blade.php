@extends('Admin.layout')

@section('title', 'Редактирвоать производителя')

@section('content')


<div class="wrapper">
 
  <div class="content-wrapper">
    
    <section class="content ">
      <form action="{{ route('creator.update', $creator[0]['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row ">
          <div class="col-md-10">
              <div class="card card-primary mt-5">
                <div class="card-header">
                  <h3 class="card-title">Редактирвоать производителя</h3>
  
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Название</label>
                    <input type="text" name="c_name" id="inputName" class="form-control" value="{{$creator[0]['name']}}">
                  </div>

                  <div class="form-group">
                    <label for="inputCountry">Страна</label>
                    <input type="text" name="c_country" id="inputCountry" class="form-control" value="{{$creator[0]['country']}}">
                  </div>
                
                  <div class="form-group">
                    <label for="inputDescription">Описание</label>
                    <textarea name="c_description" id="inputDescription" class="form-control" rows="4">{{$creator[0]['description']}}</textarea>
                  </div>
                
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-secondary">Сохранить</button>
          </div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->




<style>
    
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
