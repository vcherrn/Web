
@extends('Admin.edit')

@section('specification')
      
        <div class="form-group">
                <label for="exampleInputEmail1">Тип протеза</label>
                
                <input type="text" value="{{ $specification[0]['product_type'] ?? '' }}"
                 name="type" class="form-control" id="exampleInputEmail1"
                
                placeholder="Введите тип протеза" required>
        </div>
        <div class="form-group">
                <label for="exampleInputEmail1">Уровень ампутации</label>
                
                <input type="text" value="{{ $specification[0]['amputation_rate'] ?? '' }}"
                name="amputation_rate" class="form-control" id="exampleInputEmail1"
                placeholder="Введите уровень ампутации" required>
        </div>
        <div class="form-group">
                <label for="exampleInputEmail1">уровень активности</label>
               
                <input type="text" value="{{ $specification[0]['activity_level'] ?? '' }}"
                name="activity_level" class="form-control" id="exampleInputEmail1"
                placeholder="Введите уровень активности" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">максимальный вес</label>
               
                <input type="text" value="{{ $specification[0]['max_weight'] ?? '' }}"
                name="max_w" class="form-control" id="exampleInputEmail1"
                placeholder="Введите максимальный вес" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">Стороны</label>
               
                <input type="text" value="{{ $specification[0]['type_of_side'] ?? '' }}"
                name="sides" class="form-control" id="exampleInputEmail1"
                placeholder="Введите стороны" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">размер протеза</label>
               
                <input type="text" value="{{ $specification[0]['size_of_prosthes'] ?? '' }}"
                name="size_p" class="form-control" id="exampleInputEmail1"
                placeholder="Введите размер протеза" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">вес протеза</label>
                
                <input type="text" value="{{ $specification[0]['weight'] ?? '' }}"
                name="weight_p" class="form-control" id="exampleInputEmail1"
                placeholder="Введите вес протеза" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">форма стопы</label>
                
                <input type="text" value="{{ $specification[0]['foot_shape'] ?? '' }}"
                name="foot_shape" class="form-control" id="exampleInputEmail1"
                placeholder="Введите форму стопы" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">цвет</label>
                
                <input type="text" value="{{ $specification[0]['color'] ?? '' }}"
                name="color" class="form-control" id="exampleInputEmail1"
                placeholder="Введите цвет" required>
        </div>
        
        <div class="form-group">
                <label for="exampleInputEmail1">высота</label>
               
                <input type="text" value="{{ $specification[0]['height'] ?? '' }}"
                name="height_w" class="form-control" id="exampleInputEmail1"
                placeholder="Введите высоту" required>
        </div>

        <div class="form-group">
                <label for="exampleInputEmail1">материал</label>
                
                <input type="text" value="{{ $specification[0]['material'] ?? '' }}"
                name="material" class="form-control" id="exampleInputEmail1"
                placeholder="Введите материал" required>
        </div>
@endsection 