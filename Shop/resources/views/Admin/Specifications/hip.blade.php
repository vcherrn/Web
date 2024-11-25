@extends('Admin.create')

@section('specification')
        <div class="form-group">
            <label for="exampleInputEmail1">Тип протеза</label>
            <input type="text" name="type" class="form-control" id="exampleInputEmail1"
            placeholder="Введите тип протеза" required>
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
            <label for="exampleInputEmail1">вес протеза</label>
            <input type="text" name="weight" class="form-control" id="exampleInputEmail1"
            placeholder="Введите вес" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">соединение в дистальной части</label>
            <input type="text" name="distal_part_connection" class="form-control" id="exampleInputEmail1"
            placeholder="Введите соединение в дистальной части" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">соединение в проксимальной части</label>
            <input type="text" name="proximal_part_connection" class="form-control" id="exampleInputEmail1"
            placeholder="Введите соединение в проксимальной части" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">угол</label>
            <input type="text" name="t_angle" class="form-control" id="exampleInputEmail1"
            placeholder="Введите угол" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">системная высота</label>
            <input type="text" name="system_height" class="form-control" id="exampleInputEmail1"
            placeholder="Введите системную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">монтажная высота</label>
            <input type="text" name="montage_height" class="form-control" id="exampleInputEmail1"
            placeholder="Введите монтажную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Стороны</label>
            <input type="text" name="sides" class="form-control" id="exampleInputEmail1"
            placeholder="Введите стороны" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">материал</label>
            <input type="text" name="material" class="form-control" id="exampleInputEmail1"
            placeholder="Введите материал" required>
        </div>
@endsection