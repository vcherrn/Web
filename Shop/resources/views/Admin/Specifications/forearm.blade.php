@extends('Admin.create')

@section('specification')
    <div class="form-group">
        <label for="exampleInputEmail1">Тип протеза</label>
        <input type="text" name="type" class="form-control" id="exampleInputEmail1"
        placeholder="Введите тип протеза" required>
    </div>
   
    <div class="form-group">
        <label for="exampleInputEmail1">Стороны</label>
        <input type="text" name="sides" class="form-control" id="exampleInputEmail1"
        placeholder="Введите стороны" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Максимальная загрузка для пальцев</label>
        <input type="text" name="max_fingers_load" class="form-control" id="exampleInputEmail1"
        placeholder="Введите максимальную загрузку для пальцев" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">максимальный вес</label>
        <input type="text" name="max_w" class="form-control" id="exampleInputEmail1"
        placeholder="Введите максимальный вес" required>
    </div>

    
    <div class="form-group">
        <label for="exampleInputEmail1">время работы</label>
        <input type="text" name="working_time" class="form-control" id="exampleInputEmail1"
        placeholder="Введите время рабооты" required>
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">функции</label>
        <input type="text" name="functions" class="form-control" id="exampleInputEmail1"
        placeholder="Введите функции протеза" required>
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">цвет</label>
        <input type="text" name="color" class="form-control" id="exampleInputEmail1"
        placeholder="Введите цвет" required>
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">материал</label>
        <input type="text" name="material" class="form-control" id="exampleInputEmail1"
        placeholder="Введите материал" required>
    </div>
@endsection