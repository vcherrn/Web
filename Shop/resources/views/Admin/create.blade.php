@extends('Admin.layout')

@section('title', 'Добавить новый протез')

@section('content')


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Добавить протез</h1>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Название</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Введите название протеза" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Артикль</label>
                                <input type="text" name="article" class="form-control" id="exampleInputEmail1"
                                    placeholder="Введите артикль" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Производитель</label>
                                <input type="text" name="creator" class="form-control" id="exampleInputEmail1"
                                    placeholder="Введите производителя" required>
                            </div>

                            <div class="form-group">
                                <label for="datePicker">Дата создания</label>
                                <input type="date" name="date_cr" class="form-control" id="datePicker"
                                    placeholder="Выберите дату" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Цена</label>
                                <input type="text" name="price" class="form-control" id="exampleInputEmail1"
                                    placeholder="Введите производителя" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Описание</label>
                                <div class="col-12">
                                    <textarea name="description" class="form-control editor" id="description" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Выберите категорию</label>
                                    <select name="cat_id" class="form-control" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group specification-template" style="width: 90%; border: 1px solid #ccc; border-radius: 10px; padding: 10px; margin-left: 5%;">
                            @yield('specification')
                        </div>

                   
                        <div class="photo-row">
                            
                        
                            @for ($i = 0; $i < 5; $i++)
                                <div class="photo-item empty">
                                    <div class="add-icon">+</div>
                                </div>
                            @endfor
                        </div>
                        <div class="form-group text-center mt-4 mb-4" >
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
       
        $('select[name="cat_id"]').change(function() {
            var categoryId = $(this).val(); 
            $.ajax({
                url: '/get-category-content/' + categoryId, 
                type: 'GET',
                success: function(response) {
                    var specificationContent = $(response).find('.specification-template').html();
                    $('.specification-template').html(specificationContent);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        // Обработчик нажатия на крестик для удаления фотографии
        $(document).on('click', '.delete-icon', function() {
            var photo = $(this).attr('data-photo');
           
            $(this).closest('.photo-item').remove();
            
            addEmptyPhotoItem();
        });

        // Обработчик нажатия на плюс для выбора фотографии
        $(document).on('click', '.add-icon', function() {
            var fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.style.display = 'none';
            $(fileInput).on('change', function(event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var photoUrl = e.target.result;
                        addPhoto(photoUrl);
                        removeEmptyPhotoItem();
                    };
                    reader.readAsDataURL(file);
                }
            });
            $(fileInput).click();
        });

        // Функция для добавления фотографии на страницу
        function addPhoto(photoUrl) {
            var photoItem = createPhotoItem(photoUrl);
            $('.photo-row').append(photoItem);
            var hiddenInput = $('<input>').attr('type', 'hidden').attr('name', 'photos[]').val(photoUrl);
            $('.photo-row').append(hiddenInput);
        }

        // Функция для создания DOM-элемента фотографии
        function createPhotoItem(photoUrl) {
            var photoItem = $('<div>').addClass('photo-item');
            var img = $('<img>').attr('src', photoUrl).attr('alt', 'Photo');
            photoItem.append(img);
            var photoOverlay = $('<div>').addClass('photo-overlay');
            var deleteIcon = $('<div>').addClass('delete-icon').text('✕').attr('data-photo', photoUrl);
            photoOverlay.append(deleteIcon);
            photoItem.append(photoOverlay);
            return photoItem;
        }

        // Функция для добавления пустого элемента с плюсом
        function addEmptyPhotoItem() {
            var emptyPhotoItem = $('<div>').addClass('photo-item empty');
            var addIcon = $('<div>').addClass('add-icon').text('+');
            emptyPhotoItem.append(addIcon);
            $('.photo-row').append(emptyPhotoItem);
        }

        // Функция для удаления пустого элемента с плюсом
        function removeEmptyPhotoItem() {
            var emptyPhotoItem = $('.photo-row .photo-item.empty').first();
            if (emptyPhotoItem.length) {
                emptyPhotoItem.remove();
            }
        }
    });
</script>
<style>

.photo-row {
    display: flex;
}

.photo-item {
    position: relative;
    width: 25%;
    padding: 10px;
    box-sizing: border-box;
}

.photo-item.empty {
    background-color: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
}

.photo-item.empty .add-icon {
    font-size: 50px;
    color: #999;
    cursor: pointer;
}

.photo-item img {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

.photo-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.photo-item:hover .photo-overlay {
    opacity: 1;
}

.delete-icon {
    color: #fff;
    font-size: 24px;
    cursor: pointer;
}

.add-icon {
    font-size: 50px;
    color: #999;
    cursor: pointer;
}
</style>













































    
{{--  --}}
    {{-- <div class="form-group">
        <label for="photos">Фотографии</label>
        <div id="dropzone" class="dropzone"></div>
        <input type="hidden" name="photos" id="photos" value="">
    </div>   --}}

<!-- Подключение библиотеки Dropzone.js -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script> --}}
{{-- <script>
// Инициализация Dropzone.js
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#dropzone", {
    url: "/upload-photos", // URL для загрузки фотографий на сервер
    paramName: "photo", // Имя параметра, используемого для отправки фотографий
    maxFiles: 5, // Максимальное количество фотографий
    acceptedFiles: "image/*", // Типы файлов, которые можно загружать (в данном случае - только изображения)
    init: function() {
        this.on("success", function(file, response) {
            // Обработчик успешной загрузки фотографии
            var photosInput = document.getElementById("photos");
            var photos = JSON.parse(photosInput.value || "[]");
            photos.push(response.filename);
            photosInput.value = JSON.stringify(photos);
        });
        this.on("removedfile", function(file) {
            // Обработчик удаления фотографии
            var photosInput = document.getElementById("photos");
            var photos = JSON.parse(photosInput.value || "[]");
            var index = photos.indexOf(file.filename);
            if (index !== -1) {
                photos.splice(index, 1);
                photosInput.value = JSON.stringify(photos);
            }
        });
    }
});
</script> --}}
@endsection