
@extends('Admin.create')

@section('specification')
      
        <div class="form-group">
                <label for="exampleInputEmail1">Тип протеза</label>
                <input type="text" name="type" class="form-control" id="exampleInputEmail1"
                placeholder="Введите тип протеза" required>
        </div>
        <div class="form-group">
                <label for="exampleInputEmail1">Уровень ампутации</label>
                <input type="text" name="amputation_rate" class="form-control" id="exampleInputEmail1"
                placeholder="Введите уровень ампутации" required>
        </div>
        <div class="form-group">
                <label for="exampleInputEmail1">уровень активности</label>
                <input type="text" name="activity_level" class="form-control" id="exampleInputEmail1"
                placeholder="Введите уровень активности" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">максимальный вес</label>
                <input type="text" name="max_w" class="form-control" id="exampleInputEmail1"
                placeholder="Введите максимальный вес" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">Стороны</label>
                <input type="text" name="sides" class="form-control" id="exampleInputEmail1"
                placeholder="Введите стороны" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">размер протеза</label>
                <input type="text" name="size_p" class="form-control" id="exampleInputEmail1"
                placeholder="Введите размер протеза" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">вес протеза</label>
                <input type="text" name="weight_p" class="form-control" id="exampleInputEmail1"
                placeholder="Введите вес протеза" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">форма стопы</label>
                <input type="text" name="foot_shape" class="form-control" id="exampleInputEmail1"
                placeholder="Введите форму стопы" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">цвет</label>
                <input type="text" name="color" class="form-control" id="exampleInputEmail1"
                placeholder="Введите цвет" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">высота</label>
                <input type="text" name="height_w" class="form-control" id="exampleInputEmail1"
                placeholder="Введите высоту" required>
        </div>

        <div class="form-group">
                <label for="exampleInputEmail1">материал</label>
                <input type="text" name="material" class="form-control" id="exampleInputEmail1"
                placeholder="Введите материал" required>
        </div>
@endsection 
