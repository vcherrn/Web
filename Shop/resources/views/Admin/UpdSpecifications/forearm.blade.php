@extends('Admin.edit')

@section('specification')
    <div class="form-group">
        <label for="exampleInputEmail1">Тип протеза</label>
        
        <input type="text" value="{{ $specification[0]['product_type'] ?? '' }}"
         name="type" class="form-control" id="exampleInputEmail1"
        placeholder="Введите тип протеза" required>
    </div>
   
    <div class="form-group">
        <label for="exampleInputEmail1">Стороны</label>
       
        <input type="text" value="{{ $specification[0]['type_of_side'] ?? '' }}"
        name="sides" class="form-control" id="exampleInputEmail1"
        placeholder="Введите стороны" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Максимальная загрузка для пальцев</label>
        
        <input type="text" value="{{ $specification[0]['max_fingers_load'] ?? '' }}"
        name="max_fingers_load" class="form-control" id="exampleInputEmail1"
        placeholder="Введите максимальную загрузку для пальцев" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">максимальный вес</label>
        
        <input type="text" value="{{ $specification[0]['max_weight'] ?? '' }}"
        name="max_w" class="form-control" id="exampleInputEmail1"
        placeholder="Введите максимальный вес" required>
    </div>

    
    <div class="form-group">
        <label for="exampleInputEmail1">время работы</label>
       
        <input type="text" value="{{ $specification[0]['working_time'] ?? '' }}"
        name="working_time" class="form-control" id="exampleInputEmail1"
        placeholder="Введите время рабооты" required>
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">функции</label>
       
        <input type="text" value="{{ $specification[0]['functions'] ?? '' }}"
        name="functions" class="form-control" id="exampleInputEmail1"
        placeholder="Введите функции протеза" required>
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">цвет</label>
       
        <input type="text" value="{{ $specification[0]['color'] ?? '' }}"
        name="color" class="form-control" id="exampleInputEmail1"
        placeholder="Введите цвет" required>
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">материал</label>
        
        <input type="text" value="{{ $specification[0]['material'] ?? '' }}"
        name="material" class="form-control" id="exampleInputEmail1"
        placeholder="Введите материал" required>
    </div>
@endsection