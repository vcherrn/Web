@extends('Admin.create')

@section('specification')
    <div class="form-group">
        <label for="exampleInputEmail1">Тип протеза</label>
        <input type="text" name="type" class="form-control" id="exampleInputEmail1"
        placeholder="Введите тип протеза" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">сила захвата</label>
        <input type="text" name="gripping_power" class="form-control" id="exampleInputEmail1"
        placeholder="Введите силу захвата" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">ширина раскрытия</label>
        <input type="text" name="opening_width" class="form-control" id="exampleInputEmail1"
        placeholder="Введите ширину раскрытия" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">напряжение</label>
        <input type="text" name="voltage" class="form-control" id="exampleInputEmail1"
        placeholder="Введите напряжение" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">скорость захвата</label>
        <input type="text" name="gripping_speed" class="form-control" id="exampleInputEmail1"
        placeholder="Введите скорость захвата" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1"> вес</label>
        <input type="text" name="weight" class="form-control" id="exampleInputEmail1"
        placeholder="Введите вес" required>
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