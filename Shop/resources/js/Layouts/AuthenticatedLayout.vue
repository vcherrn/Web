<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);




</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
            
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                         
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('welcome')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('shop')" >  
                                    <ul class="topmenu">
                                        <li>
                                            <a :href="route('shop')" class="active">Каталог<span class="fa fa-angle-down"></span></a>
                                            <ul class="submenu">
                                                
                                                <li v-for="ptype in types" >
                                                    <a href="" @click="navigateToType(ptype.id)" >{{ptype.name}}<span class="fa fa-angle-down"></span></a>
                                                    <ul class="submenu">
                                                        <li v-for="category in categories" >
                                                            <div v-if="category.type_id == ptype.id">
                                                                <a :href="route('shop')"  @click="navigateToCategory(category.id)" >{{category.name}}</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </NavLink>
                             
                            </div>
                            
                            
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('constructor')" :active="route().current('Constructor')">
                                    
                                    <ul class="topmenu">
                                    <li>
                                        <a :href="route('constructor')" class="active">Конструктор<span ></span></a>
                                        
                                    </li>
                                </ul>
                                </NavLink>
                            </div>

                        </div>
                        <div class="hidden sm:flex sm:items-center " v-if="$page.props.auth.user">

                            

                            <div class="hidden space-x-8 sm:-my-px sm:flex">
                                
                                <NavLink :href="route('cart')" :active="route().current('cart')" >
                                 <svg class="navlink-svg" id="Capa_1" enable-background="new 0 0 512.003 512.003" viewBox="0 0 512.003 512.003" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="lg1"><stop offset="0" stop-color="#a93aff"></stop><stop offset="1" stop-color="#ff81ff"></stop></linearGradient><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256.001" x2="256.001" xlink:href="#lg1" y1="504.194" y2="3.721"></linearGradient><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="196" x2="196" xlink:href="#lg1" y1="504.194" y2="3.721"></linearGradient><linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="407" x2="407" xlink:href="#lg1" y1="504.194" y2="3.721"></linearGradient><g><path d="m15 30.001h48.121c7.143 46.669 50.919 332.672 58.052 379.27 1.12 7.323 7.419 12.73 14.827 12.73h331c8.284 0 15-6.716 15-15s-6.716-15-15-15h-318.121l-9.184-60h327.305c7.469 0 13.799-5.494 14.851-12.889l30-211c1.283-9.019-5.722-17.111-14.851-17.111h-394.193l-11.98-78.27c-1.12-7.322-7.419-12.73-14.827-12.73h-61c-8.284 0-15 6.716-15 15s6.716 15 15 15zm464.717 91-25.735 181h-318.879l-27.704-181z" fill="url(#SVGID_1_)" style="fill: rgb(0, 0, 0);"></path><path d="m151 467.001c0 24.813 20.187 45 45 45s45-20.187 45-45-20.187-45-45-45-45 20.187-45 45zm45-15c8.271 0 15 6.729 15 15s-6.729 15-15 15-15-6.729-15-15 6.729-15 15-15z" fill="url(#SVGID_2_)" style="fill: rgb(0, 0, 0);"></path><path d="m362 467.001c0 24.813 20.187 45 45 45s45-20.187 45-45-20.187-45-45-45-45 20.187-45 45zm45-15c8.271 0 15 6.729 15 15s-6.729 15-15 15-15-6.729-15-15 6.729-15 15-15z" fill="url(#SVGID_3_)" style="fill: rgb(0, 0, 0);"></path></g></svg>
                                </NavLink>
                            </div>

                           

                            <div class="hidden space-x-8 sm:-my-px sm:flex">
                                <NavLink :href="route('wishlist')" :active="route().current('wishlist')">
                                    <svg class="navlink-svg" id="Layer_2" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" data-name="Layer 2">
                                        <path d="m23.5 7.07 8.48 4.5 9.59-5.21 11.36 2.6 6.5 8.61-.43 11.43-26.5 29-26.98-27.57-1.73-11 4.92-8.36 9.65-4.71z" fill="#78b9eb" style="fill: rgb(255, 255, 255);"></path><path d="m32.05 58.9a1.54 1.54 0 0 1 -1.05-.44s-22.77-22.63-23.31-23.3c-8.28-9-5.61-19.28.37-25 5.74-5.52 15.51-7.8 23.94-.37a17.15 17.15 0 0 1 18.27-3.34 17.51 17.51 0 0 1 6.07 28.76l-23.23 23.25a1.53 1.53 0 0 1 -1.06.44zm-11.8-50.78a14.76 14.76 0 0 0 -10.11 4.19c-5 4.75-7.16 13.3-.25 20.82.11.1 17.62 17.62 22.11 22.15l22.22-22.19a14.51 14.51 0 0 0 4.28-10.32 14.22 14.22 0 0 0 -9.32-13.52 14.21 14.21 0 0 0 -16 3.65 1.51 1.51 0 0 1 -2.18.1 15 15 0 0 0 -10.75-4.88z" fill="#006df0" style="fill: rgb(0, 0, 0);"></path>
                                    </svg>
                                </NavLink>
                            </div>


                            <div class="hidden space-x-8 sm:-my-px  sm:flex">
                                <NavLink :href="route('OrdersHistory')" :active="route().current('OrdersHistory')">
                                    <svg class="navlink-svg" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M256,0c-8.284,0-15,6.716-15,15s6.716,15,15,15c124.617,0,226,101.383,226,226S380.617,482,256,482S30,380.617,30,256 c0-60.357,25.37-118.632,69.017-161.036V121c0,8.284,6.716,15,15,15S129,129.284,129,121V61c0-8.284-6.699-15-14.983-15H53.5 c-8.284,0-15,6.716-15,15s6.716,14.9,15,14.9h22.012C27.008,124.322,0,189.079,0,256c0,140.74,115.209,256,256,256 c140.74,0,256-115.209,256-256C512,115.26,396.791,0,256,0z"/></g></g><g><g><path d="M256,91c-90.975,0-165,74.049-165,165c0,90.981,74.055,165,165,165c90.975,0,165-74.049,165-165 C421,165.019,346.945,91,256,91z M361.429,340.216l-9.969-9.97c-5.857-5.858-15.355-5.858-21.213,0 c-5.858,5.858-5.858,15.355,0,21.213l9.97,9.97C320.792,376.976,297,387.274,271,390.162V376c0-8.284-6.716-15-15-15 s-15,6.716-15,15v14.162c-26-2.888-49.792-13.186-69.216-28.733l9.97-9.97c5.858-5.858,5.858-15.355,0-21.213 c-5.857-5.858-15.355-5.858-21.213,0l-9.97,9.97C135.024,320.792,124.725,297,121.838,271H136c8.284,0,15-6.716,15-15 s-6.716-15-15-15h-14.162c2.888-26,13.186-49.792,28.733-69.216l9.97,9.97c5.857,5.858,15.356,5.858,21.213,0 c5.858-5.858,5.858-15.355,0-21.213l-9.97-9.97C191.208,135.024,215,124.726,241,121.838V136c0,8.284,6.716,15,15,15 s15-6.716,15-15v-14.162c26,2.888,49.792,13.186,69.216,28.733l-9.97,9.97c-5.858,5.858-5.858,15.355,0,21.213 c5.857,5.858,15.356,5.858,21.213,0l9.969-9.97C376.976,191.208,387.275,215,390.162,241H376c-8.284,0-15,6.716-15,15 s6.716,14.9,15,14.9h14.162C387.274,296.9,376.976,320.792,361.429,340.216z"/></g></g><g><g><path d="M296.607,275.393L271,249.787V196c0-8.284-6.716-15-15-15s-15,6.716-15,15v60c0,3.978,1.581,7.793,4.394,10.606l30,30 c5.857,5.858,15.356,5.858,21.213,0C302.465,290.748,302.465,281.251,296.607,275.393z"/></g></g></svg>
                                </NavLink>
                            </div>
                            
                           
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative" >
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div v-if="$page.props.auth.user.user_role == 1" >
                                            <a class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" 
                                              :href="route('admin.home')" :active="route().current('admin.home')">
                                                Админ-панель
                                            </a>
                                        </div>
                                        <DropdownLink :href="route('profile.edit')"> Профиль </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Выйти
                                        </DropdownLink>

                                        
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                      
                        <ResponsiveNavLink :href="route('shop')"> Каталог </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('constructor')"> Конструктор </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('cart')" :active="route().current('cart')"> Корзина </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('wishlist')"> Список желаемого </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('OrdersHistory')"> История </ResponsiveNavLink>
                    </div>
                   


                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200"  v-if="$page.props.auth.user">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>
                        <div class="mt-3 space-y-1" v-if="$page.props.auth.user.user_role == 1" >
                            <a class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base 
                            font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none 
                            focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                                :href="route('admin.home')" >
                                    Админ-панель
                            </a>
                        </div>
            
                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Профиль </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Выйти
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>

    <chat-form></chat-form>

    <!-- Footer Start -->
  <div class="container-fluid bg-dark text-light footer  pt-5 wow fadeIn">
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-3 col-md-6">
          <h5 class="text-light mb-4">Адрес</h5>
          <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>улица Д., Москва, Россия</p>
          <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+7 999 999 99 99</p>
          <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
          <div class="d-flex pt-2">
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
</template>
<script>
import { useRemember } from '@inertiajs/vue3'
import ChatForm from '@/Components/ModalWindows/ChatForm.vue';
export default {
    components:{
        ChatForm
    },
    data() {
        return {
            categories: {},
            types: {},
        }
    },
    mounted(){
        this.getCategories();
        this.getTypes();
    },
    methods: {
        getCategories(){
            axios.get('/get-categories').then(response => {
                this.categories = response.data;
            });
        },
        getTypes(){
            axios.get('/get-types').then(response => {
                this.types = response.data;
            });
        },
        navigateToCategory(categoryId) {
            localStorage.setItem('selectedCategoryId', categoryId);
        },
        navigateToType(typeId) {
            localStorage.setItem('selectedTypeId', typeId);
        },
        
    },
}


</script>

<style >

* {
    box-sizing: border-box;
}
.navlink-svg {
    width: 65px;
    max-height: 25px;
}


nav a {
    text-decoration: none;
    display: block;
    transition: .3s linear;
}
.topmenu{
    margin-left: -10px;    
}
.topmenu>li {
    float: left;
    position: relative;
    border-left: 1px solid black;
}

.topmenu>li:first-child {
    border-left: 0;
}

.topmenu>li>a {
    padding: 20px 30px;
    font-size: 12px;
    text-transform: uppercase;
    color: #FEFDFD;
    letter-spacing: 2px;
}

.topmenu>li>a.active,
.submenu a:hover {
    color: #0d54a5;
}
.submenu a:hover {
    background-color: #b6e7f0;
}


.topmenu .fa,
.submenu .fa {
    margin-left: 5px;
    color: inherit;
}

.submenu {
    position: absolute;
    z-index: 5;
    min-width: 200px;
    background: white;
    border-top: 1px solid #CBCBCC;
    border-left: 1px solid #CBCBCC;
    border-right: 1px solid #CBCBCC;
    visibility: hidden;
    opacity: 0;
    transform-origin: 0% 0%;
    transform: rotateX(-90deg);
    transition: .3s linear;
}

.submenu li {
    position: relative;
}

.submenu li a {
    color: #282828;
    padding: 10px 20px;
    font-size: 13px;
    border-bottom: 1px solid #CBCBCC;
}

.submenu .submenu {
    position: absolute;
    left: 100%;
    top: -1px;
    transition: .3s linear;
}

nav li:hover>.submenu {
    transform: rotateX(0deg);
    visibility: visible;
    opacity: 1;
}

/*** Footer ***/
.footer .btn.btn-social {
  margin-right: 5px;
  width: 35px;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: center;
  
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

.footer .btn.btn-link::before {
  position: relative;
  /* content: "\f105"; */
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  margin-right: 10px;
}

.footer .btn.btn-link:hover {
  /* color: var(--primary); */
  letter-spacing: 1px;
  box-shadow: none;
}

.footer .copyright {
  padding: 25px 0;
  font-size: 15px;
  border-top: 1px solid rgba(256, 256, 256, .1);
}
/* 
.footer .copyright a {
  color: var(--light);
}

.footer .copyright a:hover {
  color: var(--primary);
} */

</style>