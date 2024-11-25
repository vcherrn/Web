

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
        <label for="exampleInputEmail1">размер руки</label>
      
        <input type="text" value="{{ $specification[0]['arm_size'] ?? '' }}"
        name="arm_size" class="form-control" id="exampleInputEmail1"
        placeholder="Введите размер руки" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">напряжение</label>
       
        <input type="text" value="{{ $specification[0]['voltage'] ?? '' }}"
        name="voltage" class="form-control" id="exampleInputEmail1"
        placeholder="Введите напряжение" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">рабочая температура</label>
        
        <input type="text" value="{{ $specification[0]['temperature'] ?? '' }}"
        name="tempreture" class="form-control" id="exampleInputEmail1"
        placeholder="Введите рабочую температуру" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">ширина раскрытия</label>
       
        <input type="text" value="{{ $specification[0]['opening_width'] ?? '' }}"
        name="opening_width" class="form-control" id="exampleInputEmail1"
        placeholder="Введите ширину раскрытия" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">сила захвата</label>
       
        <input type="text" value="{{ $specification[0]['gripping_power'] ?? '' }}"
        name="gripping_power" class="form-control" id="exampleInputEmail1"
        placeholder="Введите силу захвата" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">скорость захвата</label>
       
        <input type="text" value="{{ $specification[0]['gripping_speed'] ?? '' }}"
        name="gripping_speed" class="form-control" id="exampleInputEmail1"
        placeholder="Введите скорость захвата" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1"> вес</label>
       
        <input type="text" value="{{ $specification[0]['weight'] ?? '' }}"
        name="weight" class="form-control" id="exampleInputEmail1"
        placeholder="Введите вес" required>
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

