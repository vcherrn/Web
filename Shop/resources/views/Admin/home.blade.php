@extends('Admin.layout')

@section('title', 'Главная')

@section('content')


  
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Главная</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$prosthes_count}}</h3>

                <p>Кол-во Протезов</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('products.show') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$requests_count}}</h3>

                <p>Активные заявки</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('activerequests.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$users_count}}</h3>

                <p>Кол-во зарегистрированных клиентов</p>
              </div>
              <div class="icon">
                
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('users.show') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" 
                  xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 179.171 179.171" 
                  style="enable-background:new 0 0 179.171 179.171;" xml:space="preserve" width="10%" height="10%"><g>
                    <path d="M111.591,96.316l8.465-68.104c0.156-1.26,0.235-2.543,0.235-3.814c0-8.883-3.845-17.326-10.55-23.164 c-1.423-1.239-3.42-1.571-5.168-0.861c-1.747,0.711-2.945,2.345-3.099,4.225c-0.501,6.134-5.724,10.939-11.89,10.939 C83.42,15.536,78.2,10.73,77.7,4.594c-0.153-1.88-1.352-3.514-3.099-4.225c-1.746-0.712-3.745-0.378-5.168,0.859 c-6.707,5.839-10.554,14.283-10.554,23.168c0,1.271,0.079,2.555,0.235,3.815l8.534,68.737c1.009,8.132,6.4,14.777,13.619,17.719 c-0.775,0.542-1.285,1.439-1.285,2.456c0,1.657,1.343,3,3,3h1.603v22.691c-9.879,2.196-19.543,11.218-19.543,31.355 c0,2.761,2.238,5,5,5h39.086c2.762,0,5-2.239,5-5c0-20.136-9.664-29.159-19.543-31.355v-22.691h1.603c1.657,0,3-1.343,3-3 c0-1.004-0.498-1.888-1.255-2.432C105.368,111.693,110.788,104.786,111.591,96.316z M103.864,169.171H75.307 c1.19-10.686,6.34-16.909,14.278-16.909S102.673,158.485,103.864,169.171z M101.64,95.323c-0.57,6.264-5.753,10.987-12.055,10.987 c-6.099,0-11.263-4.554-12.013-10.593l-8.534-68.735c-0.105-0.854-0.159-1.723-0.159-2.585c0-3.217,0.748-6.349,2.142-9.169 c3.913,6.195,10.836,10.308,18.564,10.308c7.729,0,14.652-4.11,18.566-10.305c1.393,2.819,2.14,5.95,2.14,9.166 c0,0.862-0.054,1.731-0.159,2.583l-8.475,68.18C101.651,95.214,101.645,95.268,101.64,95.323z"/><path d="M87.465,94.666c-0.561,0.56-0.88,1.33-0.88,2.12s0.319,1.57,0.88,2.13c0.56,0.55,1.33,0.87,2.12,0.87s1.569-0.32,2.12-0.87 c0.56-0.56,0.88-1.34,0.88-2.13s-0.32-1.56-0.88-2.12C90.595,93.555,88.586,93.546,87.465,94.666z"/></g></svg>
                </h3>

                <p>Категории протезов</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#donutChart" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        

            

          
</div>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Количество новых зарегистрированных клиентов</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">{{$users_count}}</span>
                <span>Пользователей за все время</span>
              </p>
              <p class="ml-auto d-flex flex-column text-right">
               
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="visitors-chart" height="200"></canvas>
            </div>

            
          </div>
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Популярные товары</h3>
            
            <div class="card-tools">
              <a href="{{ route('export.products') }}"  class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
              </a>
             
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Продукт</th>
                <th>Цена</th>
                <th>Кол-во продаж</th>
                <th>Подробнее</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($popularProductsData as $product)
                <tr>
                  <td>
                    <img src="{{ asset('storage/'.json_decode($product->photos)[0]) }}" alt="..." class=" img-size-32 mr-2">
                    {{$product->name}}
                  </td>
                  <td>{{$product->price}}</td>
                  <td style="text-align: center">
                    
                    {{$product->total}}
                  </td>
                  <td style="text-align: center">
                    <a href="{{ route('product.edit', $product->id) }}" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
              
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Продажи</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">{{ $salesChartData['summary'][0]->total_sum }}</span>
                <span>Продажи за год</span>
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                
               
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="sales-chart" height="200"></canvas>
            </div>

            
          </div>
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Общая статистика</h3>
            <div class="card-tools">
              
             
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
              <p class="text-success text-xl">
                <i class="ion ion-ios-refresh-empty"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                   {{$infoData['requestCountItems'][0]->total}}
                </span>
                <span class="text-muted">Кол-во заявок</span>
              </p>
            </div>
            <!-- /.d-flex -->
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
              <p class="text-warning text-xl">
                <i class="ion ion-ios-cart-outline"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                  {{$infoData['cartCountItems'][0]->total}}
                </span>
                <span class="text-muted">Кол-во товаров в корзинах</span>
              </p>
            </div>
            <!-- /.d-flex -->
            <div class="d-flex justify-content-between align-items-center mb-0">
              <p class="text-danger text-xl">
                <i class="ion ion-ios-people-outline"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                  {{$infoData['wishlistCountItems'][0]->total}}
                </span>
                <span class="text-muted">Кол-во товаров в списке желаемого</span>
              </p>
            </div>
            <!-- /.d-flex -->
          </div>
        </div>
        
      </div>
      <!-- /.col-md-6 -->
    </div>
     
     <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Протезы всех категорий</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body" >
        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
    
    </div>
   
  </div>

</div>
</section>
<script src="/admin/plugins/chart.js/Chart.min.js"></script>
<script>

    var usersChartData = {!! json_encode($usersChartData) !!};
    var salesChartData = {!! json_encode($salesChartData) !!};
    var typesCountData = {!! json_encode($typesCountData) !!};
    var visitorsChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    new Chart(document.getElementById('visitors-chart').getContext('2d'), {
      type: 'bar',
      data: usersChartData,
      options: visitorsChartOptions
    });

    new Chart(document.getElementById('sales-chart').getContext('2d'), {
      type: 'bar',
      data: salesChartData,
      options: visitorsChartOptions
    });

    new Chart(document.getElementById('donutChart').getContext('2d'), {
      type: 'doughnut',
      data: typesCountData,
      options: {
        maintainAspectRatio : false,
        responsive : true,
      }
      
    });
 

</script>
 
@endsection
