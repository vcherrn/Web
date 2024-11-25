<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },

});
</script>

<template>
  <Head title="Добро пожаловать" />
  <div class=" sticky-top container-fluid bg-light p-0 wow fadeIn" data-aos="fade-up">
    <div class="row gx-0 d-none d-lg-flex">
      <div class="col-lg-7 px-5 text-start">
        <div class="h-100 d-inline-flex align-items-center py-3 me-4">
          <small class="fa fa-map-marker-alt text-primary me-2"></small>
          <small>Улица Д, Донецк, Россия</small>
        </div>
        <div class="h-100 d-inline-flex align-items-center py-3">
          <small class="far fa-clock text-primary me-2"></small>
          <small>Пн-Вс : 09.00  - 21.00</small>
        </div>
      </div>
      <div class="col-lg-5 px-5 text-end">

        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
          <Link v-if="$page.props.auth.user" :href="route('shop')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Каталог </Link>

          <template v-else>
            <Link :href="route('login')"
              class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Вход</Link>

            <Link v-if="canRegister" :href="route('register')"
              class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Регистрация</Link>
          </template>
        </div>
      </div>
    </div>
  </div>

  <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
      <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          <div class="row p-5">
            <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
              <img class="img-fluid" src="storage/photos/welcome/hand.png" alt="">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
              <div class="text-align-left align-self-center">
                <h1 class="h1">Proto<span>Type</span></h1>
                <h3 class="h2">Новый продукт </h3>
                <p>
                  Не упускайте возможность обрести независимость, уверенность и полноценную жизнь с помощью нашего нового протеза!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="container">
          <div class="row p-5">
            <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
              <img class="img-fluid" src="storage/photos/welcome/hand.png" alt="">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
              <div class="text-align-left">
                <h1 class="h1">Предстваляем</h1>
                <h3 class="h2">Новый продукт </h3>
                <p>
                  Не упускайте возможность обрести независимость, уверенность и полноценную жизнь с помощью нашего нового протеза!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="container">
          <div class="row p-5">
            <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
              <img class="img-fluid" src="storage/photos/welcome/hand.png" alt="">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
              <div class="text-align-left">
                <h1 class="h1">Предстваляем</h1>
                <h3 class="h2">Новый продукт </h3>
                <p>
                  Не упускайте возможность обрести независимость, уверенность и полноценную жизнь с помощью нашего нового протеза!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button"
      data-bs-slide="prev">
      <i class="fas "> < </i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button"
      data-bs-slide="next">
      <i class="fas">></i>
    </a>
  </div>
  


  <!-- About Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-6 wow fadeIn" data-aos="fade-up">
          <div class="d-flex flex-column">
            <img class="img-fluid rounded w-75 align-self-end" src="storage/photos/welcome/about-1.jpg" alt="">
            <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="storage/photos/welcome/1.webp" alt=""
              style="margin-top: -25%;">
          </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-aos="fade-up">
          <p class="d-inline-block border rounded-pill py-1 px-4">О нас</p>
          <h1 class="mb-4">Мы помогаем людям обрести новые возможности!</h1>
          <p>Наша команда стремится, чтобы 100% людей, лишенных конечностей, ежедневно пользовались доступными функциональными протезами 
             с высоким уровнем сервиса, делая свою жизнь удобнее, ярче и счастливее.</p>
          <p class="mb-4">Компания <strong>ProtoType</strong> исследует и разрабатывает технологии на стыке медицины и робототехники с 2020 года.
             На данный момент мы выпускаем 6 типов протезов: протезы кистей, предплечья, рук, ступней, колен, таза.
             Протезы подходят для детей и взрослых с ампутацией конечностей любого уровня.</p>
             <p>Преимущества пользования нашим магазином:</p>
          <p><i class="text-primary me-3"></i>Высокий уровень заботы о здоровье пациентов</p>
          <p><i class="text-primary me-3"></i>Только выскоквалифицированные специалисты</p>
          <p><i class="text-primary me-3"></i>Бесплатные консультации с нашими врачами</p>
          <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" :href="route('about_us')">Подробнее</a>
        </div>
      </div>
    </div>
  </div>
  <!-- About End -->


  <!-- Service Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="text-center mx-auto mb-5 wow fadeInUp" data-aos="fade-up" style="max-width: 600px;">
        <p class="d-inline-block border rounded-pill py-1 px-4">Услуги</p>
        <h1>Наш магазин оказывает усуги людям с различным уровнем ампутаций конечностей</h1>
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6" data-aos="fade-up">
          <div class="service-item bg-light rounded h-100 p-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
              style="width: 65px; height: 65px;">
              <i class="fa fa-wheelchair text-primary fs-4"></i>
            </div>
            <h4 class="mb-3">Кисти</h4>
            <p class="mb-4">Подходит для всех пользователей, у которых сохранилась мышечная активность в одной или нескольких мышцах культи руки.
            </p>
            <a class="btn" :href="route('shop')" @click="navigateToCategory(3)"><i
                class="fa fa-plus text-primary me-3"></i>Перейти</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-aos="fade-up">
          <div class="service-item bg-light rounded h-100 p-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
              style="width: 65px; height: 65px;">
              <i class="fa fa-wheelchair text-primary fs-4"></i>
            </div>
            <h4 class="mb-3">Предплечья</h4>
            <p class="mb-4">Настраивайте жесты руки под себя и используйте стандартные схваты под различные предметы и действия.
            </p>
            <a class="btn" :href="route('shop')" @click="navigateToCategory(2)"><i
                class="fa fa-plus text-primary me-3"></i>Перейти</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-aos="fade-up">
          <div class="service-item bg-light rounded h-100 p-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
              style="width: 65px; height: 65px;">
              <i class="fa fa-wheelchair text-primary fs-4"></i>
            </div>
            <h4 class="mb-3">Плечи</h4>
            <p class="mb-4">Протезы управляются с помощью датчиков, а закрытие и раскрытие кисти выполняется небольшим, но мощным электродвигателем.
            </p>
            <a class="btn" :href="route('shop')" @click="navigateToCategory(1)"><i
                class="fa fa-plus text-primary me-3"></i>Перейти</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-aos="fade-up">
          <div class="service-item bg-light rounded h-100 p-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
              style="width: 65px; height: 65px;">
              <i class="fa fa-wheelchair text-primary fs-4"></i>
            </div>
            <h4 class="mb-3">Стопы</h4>
            <p class="mb-4">Обеспечивают Вам плавную походку и возможность сохранять больше энергии в пути.
            </p>
            <a class="btn" :href="route('shop')" @click="navigateToCategory(6)"><i
                class="fa fa-plus text-primary me-3"></i>Перейти</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-aos="fade-up">
          <div class="service-item bg-light rounded h-100 p-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
              style="width: 65px; height: 65px;">
              <i class="fa fa-wheelchair text-primary fs-4"></i>
            </div>
            <h4 class="mb-3">Колени</h4>
            <p class="mb-4"> Практически полностью восстанавливают утраченную функцию, отлично имитируют физиологическую 
              походку.
            </p>
            <a class="btn" :href="route('shop')" @click="navigateToCategory(5)"><i
                class="fa fa-plus text-primary me-3"></i>Перейти</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-aos="fade-up">
          <div class="service-item bg-light rounded h-100 p-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
              style="width: 65px; height: 65px;">
              <i class="fa fa-wheelchair text-primary fs-4"></i>
            </div>
            <h4 class="mb-3">Таз</h4>
            <p class="mb-4">Протезные импланты для таза изготовлены из прочных и легких материалов, обеспечивая долговечность.
            </p>
            <a class="btn" :href="route('shop')" @click="navigateToCategory(4)"><i
                class="fa fa-plus text-primary me-3"></i>Перейти</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Service End -->


  <!-- Feature Start -->
  <div class="container-fluid bg-primary overflow-hidden my-5 px-lg-0">
    <div class="container feature px-lg-0">
      <div class="row g-0 mx-lg-0">
        <div class="col-lg-6 feature-text py-5 wow fadeIn" data-aos="fade-up">
          <div class="p-lg-5 ps-lg-0">
            <p class="d-inline-block border rounded-pill text-light py-1 px-4">Особенности</p>
            <h1 class="text-white mb-4">Почему выбирают именно нас</h1>
            <p class="text-white mb-4 pb-2">Мы верим, что при помощи современных средств реабилитации можно не только вернуть основные возможности руки: держать предметы,
               взаимодействовать с окружающим миром — но и в чем-то превзойти возможности обычного человека.</p>
            <div class="row g-4">
              <div class="col-6">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                    style="width: 55px; height: 55px;">
                    <i class="fa fa-user-md text-primary"></i>
                  </div>
                  <div class="ms-4">
                    <p class="text-white mb-2">Опытные</p>
                    <h5 class="text-white mb-0">Врачи</h5>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                    style="width: 55px; height: 55px;">
                    <i class="fa fa-user-md text-primary"></i>
                  </div>
                  <div class="ms-4">
                    <p class="text-white mb-2">Высококачественные</p>
                    <h5 class="text-white mb-0">Услуги</h5>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                    style="width: 55px; height: 55px;">
                    <i class="fa fa-user-md text-primary"></i>
                  </div>
                  <div class="ms-4">
                    <p class="text-white mb-2">Комфортные</p>
                    <h5 class="text-white mb-0">Консультации</h5>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                    style="width: 55px; height: 55px;">
                    <i class="fa fa-user-md text-primary"></i>
                  </div>
                  <div class="ms-4">
                    <p class="text-white mb-2">24 часа в сутки</p>
                    <h5 class="text-white mb-0">Работаем</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 pe-lg-0 wow fadeIn" data-aos="fade-up" style="min-height: 400px;">
          <div class="position-relative h-100">
            <img class="position-absolute img-fluid w-100 h-100" src="storage/photos/welcome/2.webp"
              style="object-fit: cover;" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Feature End -->


  <!-- Clients Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="text-center mx-auto mb-5 wow fadeInUp" data-aos="fade-up" style="max-width: 600px;">
        <p class="d-inline-block border rounded-pill py-1 px-4">Наши Клиенты</p>
      </div>
      <div class="row g-4">
        <div class="col-lg-3 col-md-6 " data-aos="fade-up" data-aos-duration="1000">
          <div class="team-item position-relative rounded overflow-hidden">
            <div class="overflow-hidden">
              <img class="img-fluid" src="storage/photos/welcome/reabilitation.jpg" alt="">
            </div>
            <div class="team-text bg-light text-center p-4">
              <h5>Имя</h5>
              <div lass=" text-center">
                <a class="btn  rounded-pill py-2 px-5 mt-3 client-card" :href="route('shop')">Подробнее</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="1200">
          <div class="team-item position-relative rounded overflow-hidden">
            <div class="overflow-hidden">
              <img class="img-fluid" src="storage/photos/welcome/f2.jpg" alt="">
            </div>
            <div class="team-text bg-light text-center p-4">
              <h5>Имя</h5>
              <div lass=" text-center">
                <a class="btn  rounded-pill py-2 px-5 mt-3 client-card" :href="route('shop')">Подробнее</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="1400">
          <div class="team-item position-relative rounded overflow-hidden">
            <div class="overflow-hidden">
              <img class="img-fluid" src="storage/photos/welcome/f3.jpg" alt="">
            </div>
            <div class="team-text bg-light text-center p-4">
              <h5>Имя</h5>
              <div lass=" text-center">
                <a class="btn  rounded-pill py-2 px-5 mt-3 client-card" :href="route('shop')">Подробнее</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-aos="fade-up" data-aos-duration="1600">
          <div class="team-item position-relative rounded overflow-hidden">
            <div class="overflow-hidden">
              <img class="img-fluid" src="storage/photos/welcome/f4.jpg" alt="">
            </div>
            <div class="team-text bg-light text-center p-4">
              <h5>Имя</h5>
              <div lass=" text-center">
                <a class="btn  rounded-pill py-2 px-5 mt-3 client-card" :href="route('shop')">Подробнее</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Clients End -->


  <!-- Appointment Start -->
  <div class="container-xxl py-5" data-aos="fade-up" data-aos-duration="800">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-6 ">
          <p class="d-inline-block border rounded-pill py-1 px-4">Консультации</p>
          <h1 class="mb-4">Вы можете бесплатно записаться на онлайн консультацию с нашими врачами</h1>
          <p class="mb-4">С каждым человеком работает настоящий специалист, который помогает на всех этапах протезирования. 
            Мы подготавливаем документы для протезирования, работаем с государственными структурами, подбираем варианты финансирования и оплаты.</p>
          <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
            <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
              style="width: 55px; height: 55px;">
              <i class="fa fa-phone-alt text-primary"></i>
            </div>
            <div class="ms-4">
              <p class="mb-2">Позвоните нам сейчас</p>
              <h5 class="mb-0">+7 999 999 99 99</h5>
            </div>
          </div>
          <div class="bg-light rounded d-flex align-items-center p-5">
            <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
              style="width: 55px; height: 55px;">
              <i class="fa fa-envelope-open text-primary"></i>
            </div>
            <div class="ms-4">
              <p class="mb-2">Напишите нам на почту</p>
              <h5 class="mb-0">info@example.com</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" id="request-form" data-aos="fade-up">
          <div class="bg-light rounded h-100 d-flex align-items-center p-5">
            <form>
              <div class="row g-3">
                <div class="col-12 col-sm-6">
                  <input type="text" v-model="userRequest.fullname" class="form-control border-0" placeholder="ФИО" style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">
                  <input type="email" v-model="userRequest.email" class="form-control border-0" placeholder="Email" style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">
                  <input type="text" v-model="userRequest.phone" class="form-control border-0" placeholder="Номер мобильного телефона" style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">

                  <select v-model="userRequest.request_id" class="form-select border-0"
                    style="height: 55px; margin-bottom: 10px;">
                    <option v-for="consultationType in consultationTypes" :value="consultationType.id">
                      {{ consultationType.title }}
                    </option>
                  </select>

                </div>
                <div class="col-12 col-sm-6">
                  <div class="date" id="date" data-target-input="nearest">
                    <input v-model="userRequest.country" type="text" class="form-control border-0 datetimepicker-input" placeholder="Страна"
                      style="height: 55px;">
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="time" id="time" data-target-input="nearest">
                    <input v-model="userRequest.town" type="text" class="form-control border-0 datetimepicker-input" placeholder="Город"
                      style="height: 55px;">
                  </div>
                </div>
                <div class="col-12">
                  <textarea v-model="userRequest.details" class="form-control border-0" rows="5" placeholder="Опишите подробнее, что Вас беспокоит"></textarea>
                </div>
                <div class="col-12">
                  <button @click="sendGuestRequest()" class="btn btn-primary w-100 py-3 submit-btn" type="submit">Отправить заявку</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Appointment End -->




  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn">
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-3 col-md-6">
          <h5 class="text-light mb-4">Адрес</h5>
          <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>улица Д., Москва, Россия</p>
          <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+7 999 999 99 99</p>
          <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
          <div class="d-flex pt-2">
            <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fa fa-twitter"></i></a>
            <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fa fa-facebook-f"></i></a>
            <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fa fa-vk"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <h5 class="text-light mb-4">Услуги протезирования</h5>
          <a class="btn btn-link" href="">Кисти</a>
          <a class="btn btn-link" href="">Предплечья</a>
          <a class="btn btn-link" href="">Плечи</a>
          <a class="btn btn-link" href="">Ступни</a>
          <a class="btn btn-link" href="">Колени</a>
          <a class="btn btn-link" href="">Таз</a>
        </div>
        <div class="col-lg-3 col-md-6">
          <h5 class="text-light mb-4">Быстрый переход</h5>
          <a class="btn btn-link" :href="route('about_us')">О нас</a>
          <a class="btn btn-link" href="">Каталог протезов</a>
        </div>
        <div class="col-lg-3 col-md-6">
          <h5 class="text-light mb-4">Услуги</h5>
          <a class="btn btn-link" :href="route('constructor')">Конструктор</a>
        </div>
        
      </div>
    </div>
    <div class="container">
      <div class="copyright">
        <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            &copy; <a class="border-bottom" href="#">ProtoType</a>, All Right Reserved.
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End -->

  <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>

</template>

<script scoped>
import AOS from 'aos';
export default {

  data() {
    return {
      consultationTypes: {},
      userRequest: {},
    }
  },
  mounted() {
    this.loadData();
  },

  methods: {
    loadData() {
      axios.get('/get-all-requests-types').then((response) => {
        this.consultationTypes = response.data;
      });
    },

    navigateToCategory(categoryId) {
      localStorage.setItem('selectedCategoryId', categoryId);
    },

    sendGuestRequest(){
      axios.post('/request/for-guests/store', this.userRequest );
    },

  }
}

</script>


<style scoped>
.carousel-inner{
  background-color: #eeeeee
}
/* Hero Carousel */
#template-mo-zay-hero-carousel {
  background: #efefef !important;
}

/* Carousel Hero */
#template-mo-zay-hero-carousel .carousel-indicators li {
 
  background-color: #598dab;
}

#template-mo-zay-hero-carousel .carousel-control-next i,
#template-mo-zay-hero-carousel .carousel-control-prev i {
  color: #598dab !important;
  font-size: 2.8em !important;
}

/* Carousel Brand */
.tempaltemo-carousel .h1 {
  font-size: .5em !important;
  color: #000 !important;
}


/********** Template CSS **********/
:root {
  --primary: #0463FA;
  --light: #EFF5FF;
  --dark: #1B2C51;
}

.fw-medium {
  font-weight: 500 !important;
}

.fw-bold {
  font-weight: 700 !important;
}

.fw-black {
  font-weight: 900 !important;
}

.back-to-top {
  position: fixed;
  display: none;
  right: 45px;
  bottom: 45px;
  z-index: 99;
}


/*** Spinner ***/
#spinner {
  opacity: 0;
  visibility: hidden;
  transition: opacity .5s ease-out, visibility 0s linear .5s;
  z-index: 99999;
}

#spinner.show {
  transition: opacity .5s ease-out, visibility 0s linear 0s;
  visibility: visible;
  opacity: 1;
}


/*** Button ***/
.btn {
  
  font-weight: 500;
  transition: .5s;
}
.submit-btn {
  background-color: #519ff3;
}

.submit-btn:hover {
  background-color: #007bff;
}
.btn.btn-primary,
.btn.btn-secondary {
  
  color: #ffffff;
}

.btn-square {
  width: 38px;
  height: 38px;
}

.btn-sm-square {
  width: 32px;
  height: 32px;
}

.btn-lg-square {
  width: 48px;
  height: 48px;
}

.btn-square,
.btn-sm-square,
.btn-lg-square {
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: normal;
}


/*** Navbar ***/
.navbar .dropdown-toggle::after {
  border: none;
  content: "\f107";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  vertical-align: middle;
  margin-left: 8px;
}

.navbar .navbar-nav .nav-link {
  margin-right: 30px;
  padding: 25px 0;
  color: #FFFFFF;
  font-size: 15px;
  font-weight: 500;
  text-transform: uppercase;
  outline: none;
}

.navbar .navbar-nav .nav-link:hover,
.navbar .navbar-nav .nav-link.active {
  color: var(--primary);
}

@media (max-width: 991.98px) {
  .navbar .navbar-nav .nav-link {
    margin-right: 0;
    padding: 10px 0;
  }

  .navbar .navbar-nav {
    border-top: 1px solid #EEEEEE;
  }
}

.navbar .navbar-brand,
.navbar a.btn {
  height: 75px;
}

.navbar .navbar-nav .nav-link {
  color: var(--dark);
  font-weight: 500;
}

.navbar.sticky-top {
  top: -100px;
  transition: .5s;
}

@media (min-width: 992px) {
  .navbar .nav-item .dropdown-menu {
    display: block;
    border: none;
    margin-top: 0;
    top: 150%;
    opacity: 0;
    visibility: hidden;
    transition: .5s;
  }

  .navbar .nav-item:hover .dropdown-menu {
    top: 100%;
    visibility: visible;
    transition: .5s;
    opacity: 1;
  }
}


/*** Header ***/
.header-carousel .owl-carousel-text {
  position: absolute;
  width: 100%;
  height: 100%;
  padding: 3rem;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  text-shadow: 0 0 30px rgba(0, 0, 0, .1);
}

.header-carousel .owl-nav {
  position: absolute;
  width: 200px;
  height: 45px;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  justify-content: space-between;
}

.header-carousel .owl-nav .owl-prev,
.header-carousel .owl-nav .owl-next {
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #FFFFFF;
  background: transparent;
  border: 1px solid #FFFFFF;
  border-radius: 45px;
  font-size: 22px;
  transition: .5s;
}

.header-carousel .owl-nav .owl-prev:hover,
.header-carousel .owl-nav .owl-next:hover {
  background: var(--primary);
  border-color: var(--primary);
}

.header-carousel .owl-dots {
  position: absolute;
  height: 45px;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.header-carousel .owl-dot {
  position: relative;
  display: inline-block;
  margin: 0 5px;
  width: 15px;
  height: 15px;
  background: transparent;
  border: 1px solid #FFFFFF;
  border-radius: 15px;
  transition: .5s;
}

.header-carousel .owl-dot::after {
  position: absolute;
  content: "";
  width: 5px;
  height: 5px;
  top: 4px;
  left: 4px;
  background: #FFFFFF;
  border-radius: 5px;
}

.header-carousel .owl-dot.active {
  background: var(--primary);
  border-color: var(--primary);
}

.page-header {
  background: url(../img/header-page.jpg) top center no-repeat;
  background-size: cover;
  text-shadow: 0 0 30px rgba(0, 0, 0, .1);
}

.breadcrumb-item+.breadcrumb-item::before {
  color: var(--light);
}


/*** Service ***/
.service-item {
  transition: .5s;
}

.service-item:hover {
  margin-top: -10px;
  box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .08);
}

.service-item .btn {
  width: 40px;
  height: 40px;
  display: inline-flex;
  align-items: center;
  background: #FFFFFF;
  border-radius: 40px;
  white-space: nowrap;
  overflow: hidden;
  transition: .5s;
}

.service-item:hover .btn {
  width: 140px;
}


/*** Feature ***/
@media (min-width: 992px) {
  .container.feature {
    max-width: 100% !important;
  }

  .feature-text {
    padding-left: calc(((100% - 960px) / 2) + .75rem);
  }
}

@media (min-width: 1200px) {
  .feature-text {
    padding-left: calc(((100% - 1140px) / 2) + .75rem);
  }
}

@media (min-width: 1400px) {
  .feature-text {
    padding-left: calc(((100% - 1320px) / 2) + .75rem);
  }
}


/*** Team ***/
.team-item img {
  position: relative;
  top: 0;
  transition: .5s;
}

.team-item:hover img {
  top: -30px;
}

.team-item .team-text {
  position: relative;
  height: 70px;
  transition: .5s;
}

.team-item:hover .team-text {
  margin-top: -60px;
  height: 160px;
}

.team-item .team-text .team-social {
  opacity: 0;
  transition: .5s;
}

.team-item:hover .team-text .team-social {
  opacity: 1;
}

.team-item .team-social .btn {
  /* display: inline-flex; */
  background: #FFFFFF;
  /* border-radius: 40px; */
}

.team-item .team-social .btn:hover {
  color: #FFFFFF;
}


/*** Appointment ***/
.bootstrap-datetimepicker-widget.bottom {
  top: auto !important;
}

.bootstrap-datetimepicker-widget .table * {
  border-bottom-width: 0px;
}

.bootstrap-datetimepicker-widget .table th {
  font-weight: 500;
}

.bootstrap-datetimepicker-widget.dropdown-menu {
  padding: 10px;
  border-radius: 2px;
}

.bootstrap-datetimepicker-widget table td.active,
.bootstrap-datetimepicker-widget table td.active:hover {
  background: var(--primary);
}

.bootstrap-datetimepicker-widget table td.today::before {
  border-bottom-color: var(--primary);
}


/*** Testimonial ***/
.testimonial-carousel::before {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  height: 100%;
  width: 0;
  background: linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
  z-index: 1;
}

.testimonial-carousel::after {
  position: absolute;
  content: "";
  top: 0;
  right: 0;
  height: 100%;
  width: 0;
  background: linear-gradient(to left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
  z-index: 1;
}

@media (min-width: 768px) {

  .testimonial-carousel::before,
  .testimonial-carousel::after {
    width: 200px;
  }
}

@media (min-width: 992px) {

  .testimonial-carousel::before,
  .testimonial-carousel::after {
    width: 300px;
  }
}

.testimonial-carousel .owl-item .testimonial-text {
  background: var(--light);
  transform: scale(.8);
  transition: .5s;
}

.testimonial-carousel .owl-item.center .testimonial-text {
  background: var(--primary);
  transform: scale(1);
}

.testimonial-carousel .owl-item .testimonial-text *,
.testimonial-carousel .owl-item .testimonial-item img {
  transition: .5s;
}

.testimonial-carousel .owl-item.center .testimonial-text * {
  color: var(--light) !important;
}

.testimonial-carousel .owl-item.center .testimonial-item img {
  background: var(--primary) !important;
}

.testimonial-carousel .owl-nav {
  position: absolute;
  width: 350px;
  top: 15px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  justify-content: space-between;
  opacity: 0;
  transition: .5s;
  z-index: 1;
}

.testimonial-carousel:hover .owl-nav {
  width: 300px;
  opacity: 1;
}

.testimonial-carousel .owl-nav .owl-prev,
.testimonial-carousel .owl-nav .owl-next {
  position: relative;
  color: var(--primary);
  font-size: 45px;
  transition: .5s;
}

.testimonial-carousel .owl-nav .owl-prev:hover,
.testimonial-carousel .owl-nav .owl-next:hover {
  color: var(--dark);
}


/*** Footer ***/
.footer .btn.btn-social {
  margin-right: 5px;
  width: 35px;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--light);
  border: 1px solid #FFFFFF;
  transition: .3s;
}

.footer .btn.btn-social:hover {
  color: #007bff;
}

.footer .btn.btn-link {
  display: block;
  margin-bottom: 5px;
  padding: 0;
  text-align: left;
  color: #FFFFFF;
  font-size: 15px;
  font-weight: normal;
  text-transform: capitalize;
  transition: .3s;
}



.footer .btn.btn-link:hover {
  color: var(--primary);
  letter-spacing: 1px;
  box-shadow: none;
}

.footer .copyright {
  padding: 25px 0;
  font-size: 15px;
  border-top: 1px solid rgba(256, 256, 256, .1);
}

.footer .copyright a {
  color: var(--light);
}

.footer .copyright a:hover {
  color: var(--primary);
}


</style>

