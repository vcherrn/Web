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
            <input type="text" name="knee_angle" class="form-control" id="exampleInputEmail1"
            placeholder="Введите угол" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">системная проксимальная высота</label>
            <input type="text" name="sys_height_prox" class="form-control" id="exampleInputEmail1"
            placeholder="Введите системную проксимальную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">минимальная системная дистальная высота</label>
            <input type="text" name="min_system_height_dist" class="form-control" id="exampleInputEmail1"
            placeholder="Введите минимальную системную дистальную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">максимальная системная дистальная высота</label>
            <input type="text" name="max_system_height_dist" class="form-control" id="exampleInputEmail1"
            placeholder="Введите максимальную системную дистальную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">минимальная монтажная высота</label>
            <input type="text" name="min_montage_height" class="form-control" id="exampleInputEmail1"
            placeholder="Введите минимальную монтажную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">максимальная монтажная высота</label>
            <input type="text" name="max_montage_height" class="form-control" id="exampleInputEmail1"
            placeholder="Введите максимальную монтажную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">проксимальная монтажная высота</label>
            <input type="text" name="proximal_montage_height" class="form-control" id="exampleInputEmail1"
            placeholder="Введите проксимальную монтажную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">минимальная дистальная монтажная высота</label>
            <input type="text" name="min_dist_montage_height" class="form-control" id="exampleInputEmail1"
            placeholder="Введите минимальную дистальную монтажную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">максимальная дистальная монтажная высота</label>
            <input type="text" name="max_dist_montage_height" class="form-control" id="exampleInputEmail1"
            placeholder="Введите максимальную дистальную монтажную высоту" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">материал</label>
            <input type="text" name="material" class="form-control" id="exampleInputEmail1"
            placeholder="Введите материал" required>
        </div>
@endsection