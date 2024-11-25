<template>
    <div class="container">
        <div class="content">
            <div class="left-side">
                <div class="left-content">
                    <div class="human-body">
                        <svg id='head' width='56.594' height='95.031' viewBox='0 0 56.594 95.031'>
                            <path
                                d='M15.92 68.5l8.8 12.546 3.97 13.984-9.254-7.38-4.622-15.848zm27.1 0l-8.8 12.546-3.976 13.988 9.254-7.38 4.622-15.848zm6.11-27.775l.108-11.775-21.16-14.742L8.123 26.133 8.09 40.19l-3.24.215 1.462 9.732 5.208 1.81 2.36 11.63 9.72 11.018 10.856-.324 9.56-10.37 1.918-11.952 5.207-1.81 1.342-9.517zm-43.085-1.84l-.257-13.82L28.226 11.9l23.618 15.755-.216 10.37 4.976-17.085L42.556 2.376 25.49 0 10.803 3.673.002 24.415z' />
                        </svg>
                        <svg :class="{ 'highlighted': cart.right_shoulder != null }" id='left-shoulder' width='109.532'
                            height='46.594' viewBox='0 0 109.532 46.594'>
                            <path class="hoverpath" @click="selectProduct('right_shoulder')"
                                d='m 38.244,-0.004 1.98,9.232 -11.653,2.857 -7.474,-2.637 z M 17.005,10.536 12.962,8.35 0.306,22.35 0.244,27.675 c 0,0 16.52,-17.015 16.764,-17.14 z m 1.285,0.58 C 18.3,11.396 0.528,30.038 0.528,30.038 L -0.01,46.595 6.147,36.045 18.017,30.989 26.374,15.6 Z' />
                        </svg>
                        <svg :class="{ 'highlighted': cart.left_shoulder != null }" id='right-shoulder' width='109.532'
                            height='46.594' viewBox='0 0 109.532 46.594'>
                            <path class="hoverpath" @click="selectProduct('left_shoulder')"
                                d='m 3.2759972,-0.004 -1.98,9.232 11.6529998,2.857 7.473999,-2.637 z m 21.2379988,10.54 4.044,-2.187 12.656,14 0.07,5.33 c 0,0 -16.524,-17.019 -16.769,-17.144 z m -1.285,0.58 c -0.008,0.28 17.762,18.922 17.762,18.922 l 0.537,16.557 -6.157,-10.55 -11.871,-5.057 L 15.147997,15.6 Z' />
                        </svg>
                        <svg :class="{ 'highlighted': cart.right_forearm != null }" id='left-arm' width='156.344'
                            height='119.25' viewBox='0 0 156.344 119.25'>
                            <path class="hoverpath" @click="selectProduct('right_forearm')"
                                d='m21.12,56.5a1.678,1.678 0 0 1 -0.427,0.33l0.935,8.224l12.977,-13.89l1.2,-8.958a168.2,168.2 0 0 0 -14.685,14.294zm1.387,12.522l-18.07,48.91l5.757,1.333l19.125,-39.44l3.518,-22.047l-10.33,11.244zm-5.278,-18.96l2.638,18.74l-17.2,46.023l-2.657,-1.775l6.644,-35.518l10.575,-27.47zm18.805,-12.323a1.78,1.78 0 0 1 0.407,-0.24l3.666,-27.345l-7.037,-10.139l-7.258,10.58l-6.16,37.04l0.566,4.973a151.447,151.447 0 0 1 15.808,-14.87l0.008,0.001zm-13.742,-28.906l-3.3,35.276l-2.2,-26.238l5.5,-9.038z' />
                        </svg>
                        <svg :class="{ 'highlighted': cart.left_forearm != null }" id='right-arm' width='156.344'
                            height='119.25' viewBox='0 0 156.344 119.25'>
                            <path class="hoverpath" @click="selectProduct('left_forearm')"
                                d='m 18.997,56.5 a 1.678,1.678 0 0 0 0.427,0.33 L 18.489,65.054 5.512,51.164 4.312,42.206 A 168.2,168.2 0 0 1 18.997,56.5 Z m -1.387,12.522 18.07,48.91 -5.757,1.333 L 10.798,79.825 7.28,57.778 17.61,69.022 Z m 5.278,-18.96 -2.638,18.74 17.2,46.023 2.657,-1.775 L 33.463,77.532 22.888,50.062 Z M 4.083,37.739 A 1.78,1.78 0 0 0 3.676,37.499 L 0.01,10.154 7.047,0.015 l 7.258,10.58 6.16,37.04 -0.566,4.973 A 151.447,151.447 0 0 0 4.091,37.738 l -0.008,10e-4 z m 13.742,-28.906 3.3,35.276 2.2,-26.238 -5.5,-9.038 z' />
                        </svg>
                        <svg id='chest' width='86.594' height='45.063' viewBox='0 0 86.594 45.063'>
                            <path
                                d='M19.32 0l-9.225 16.488-10.1 5.056 6.15 4.836 4.832 14.07 11.2 4.616 17.85-8.828-4.452-34.7zm47.934 0l9.225 16.488 10.1 5.056-6.15 4.836-4.833 14.07-11.2 4.616-17.844-8.828 4.45-34.7z' />
                        </svg>
                        <svg id='stomach' width='75.25' height='107.594' viewBox='0 0 75.25 107.594'>
                            <path
                                d='M19.25 7.49l16.6-7.5-.5 12.16-14.943 7.662zm-10.322 8.9l6.9 3.848-.8-9.116zm5.617-8.732L1.32 2.15 6.3 15.6zm-8.17 9.267l9.015 5.514 1.54 11.028-8.795-5.735zm15.53 5.89l.332 8.662 12.286-2.665.664-11.826zm14.61 84.783L33.28 76.062l-.08-20.53-11.654-5.736-1.32 37.5zM22.735 35.64L22.57 46.3l11.787 3.166.166-16.657zm-14.16-5.255L16.49 35.9l1.1 11.25-8.8-7.06zm8.79 22.74l-9.673-7.28-.84 9.78L-.006 68.29l10.564 14.594 5.5.883 1.98-20.735zM56 7.488l-16.6-7.5.5 12.16 14.942 7.66zm10.32 8.9l-6.9 3.847.8-9.116zm-5.617-8.733L73.93 2.148l-4.98 13.447zm8.17 9.267l-9.015 5.514-1.54 11.03 8.8-5.736zm-15.53 5.89l-.332 8.662-12.285-2.665-.664-11.827zm-14.61 84.783l3.234-31.536.082-20.532 11.65-5.735 1.32 37.5zm13.78-71.957l.166 10.66-11.786 3.168-.166-16.657zm14.16-5.256l-7.915 5.514-1.1 11.25 8.794-7.06zm-8.79 22.743l9.673-7.28.84 9.78 6.862 12.66-10.564 14.597-5.5.883-1.975-20.74z' />
                        </svg>
                        <svg id='stomach' width='75.25' height='107.594' viewBox='0 0 75.25 107.594'>
                            <path
                                d='M 19.25 7.49 z m -10.322 3.848 z m 5.617 -8.732 z m -8.17 11.028 z m 15.53 8.662 z m 15.095 86.704 L 33 77 l -0.08 -20.53 l -11.654 -5.736 l -1.546 39.204 z M 20 36 z m -12 -5 z m 8.79 22.74 l -9.673 -7.28 l -0.84 9.78 L -0.006 68.29 l 10.564 14.594 l 5.5 0.883 l 1.98 -20.735 z M 53 23 z z z z z m -15 85 l 3.61 -31.783 l 0.082 -20.532 l 11.65 -5.735 l 1.32 37.5 z z m 29 -78 z m -8.79 22.743 l 9.79 -6.743 l 0.84 9.78 l 6.862 12.66 l -10.564 14.597 l -5.5 0.883 l -2.638 -21.92 z' />
                        </svg>
                        <svg :class="{ 'highlighted': cart.right_hip != null }" id='left-leg' width='43.626'
                            height='140.625'>
                            <path class="hoverpath" @click="selectProduct('right_hip')"
                                d='m 18.00179,139.99461    m 20.582,0.444  m -26.557,-12.645   -2.656,8.875 z m 22.795,42.374  z m -10.623,12.424  l 5.5329998,-36.384 z m -9.71,-178.164003 0,22.476 15.71,31.073 9.923,30.850003 -1.033,-21.375 z m 25.49,30.248 0.118,-0.148 -0.793,-2.024 -16.545,-18.16 -1.242,-0.44 10.984,28.378 z m -6.255,10.766 6.812,17.6 2.274,-21.596 -1.344,-3.43 z m -26.4699998,17.82 0.827,25.340003 12.8159998,35.257 -3.928,10.136 -12.6099998,-44.51 z M 31.81879,76.04161 l 0.345,0.826 6.47,15.48 -4.177,38.342 -6.594,-3.526 5.715,-35.7 z m -21.465,-74.697003 0.827,21.373 L 4.1527902,65.02561 0.84679017,30.870607 Z m 2.068,27.323 14.677,32.391 3.307,26.000003 -6.2,36.58 -13.437,-37.241 -0.8269998,-38.342003 z' />
                        </svg>


                        <svg :class="{ 'highlighted': cart.right_knee != null }" id='left-knee'
                            style="margin-top: 116px;" width='93.626' height='110.625' viewBox='0 110 93.626 120.625'>
                            <path class="hoverpath" @click="selectProduct('right_knee')"
                                d='m 18.00179,139.99461 -0.664,5.99 4.647,5.77 1.55,9.1 3.1,1.33 2.655,-13.755 1.77,-4.88 -1.55,-3.107 z m 20.582,0.444 -3.32,9.318 -7.082,13.755 1.77,12.647 5.09,-14.2 4.205,-7.982 z m -26.557,-12.645 5.09,27.29 -3.32,-1.777 -2.656,8.875 z' />
                        </svg>

                        <svg id='left-golen' style="margin-top: 156px;" width='93.626' height='150.625'
                            viewBox='0 150 93.626 160.625'>
                            <path
                                d='m 18.00179,139.99461    m 20.582,0.444  m -26.557,-12.645    m 22.795,42.374 -1.55,4.88 -3.32,20.634 -0.442,27.51 4.65,26.847 -0.223,-34.39 4.87,-13.754 0.663,-15.087 z m -10.623,12.424 1.106,41.267 c 14.157565,64.57987 -5.846437,10.46082 -16.8199998,-29.07 l 5.5329998,-36.384 z m  z' />
                        </svg>


                        <svg :class="{ 'highlighted': cart.left_hip != null }" id='right-leg' width='80'
                            height='140.625' viewBox='0 0 80 140.625'>
                            <path class="hoverpath" @click="selectProduct('left_hip')"
                                d='m 26.664979,139.7913 m -20.5820002,0.444  M 30.177979,4.225305 l 0,22.476 -15.713,31.072 -9.9230002,30.850005 1.033,-21.375005 z m -25.4930002,30.249  16.5450002,-18.16 1.24,-0.44 -10.98,28.377 z m 6.2550002,10.764 -6.8120002,17.6 -2.274,-21.595 1.344,-3.43 z m 26.47,17.82 -0.827,25.342005 -12.816,35.25599 3.927,10.136 12.61,-44.50999 z m -24.565,12.783005  -6.4700002,15.48 4.1780002,38.34199 6.594,-3.527 -5.715,-35.69999 z m 19.792,51.74999  2.655,8.875 z m 1.671,-126.452995 -0.826,21.375 7.03,42.308 3.306,-34.155 z m -2.066,27.325 -14.677,32.392 -3.308,26.000005 6.2,36.57999 13.436,-37.23999 0.827,-38.340005 z' />
                        </svg>


                        <svg :class="{ 'highlighted': cart.left_knee != null }" id='right-knee' width='80'
                            height='250.625' viewBox='0 0 80 250.625'>
                            <path class="hoverpath" @click="selectProduct('left_knee')"
                                d='m 26.664979,139.7913 0.663,5.99 -4.647,5.77 -1.55,9.1 -3.1,1.33 -2.655,-13.755 -1.77,-4.88 1.55,-3.107 z m -20.5820002,0.444 3.3200005,9.318 7.0799997,13.755 -1.77,12.647 -5.0899997,-14.2 -4.2000005,-7.987 z m 3.7620005,29.73  z m 10.6229997,12.424  m -13.9460002,74.991  M 30.177979,4.225305  m -25.4930002,30.249  m 6.2550002,10.764  z m 26.47,17.82  z m -24.565,12.783005  m 19.792,51.74999 -5.09,27.29 3.32,-1.776 2.655,8.875 z m 1.671,-126.452995 z' />
                        </svg>



                        <svg id='right-golen' width='80' height='250.625' viewBox='0 0 80 250.625'>
                            <path
                                d='m 26.664979,139.7913 m -20.5820002,0.444 z m 3.7620005,29.73 1.5499997,4.88 3.32,20.633 0.442,27.51 -4.648,26.847 0.22,-34.39 -4.8670002,-13.754 -0.67,-15.087 z m 10.6229997,12.424 -1.107,41.267 -8.852,33.28 9.627,-4.55 16.046,-57.8 -5.533,-36.384  z' />
                        </svg>

                        <svg :class="{ 'highlighted': cart.right_wrist != null }" id='left-hand' width='90'
                            height='38.938' viewBox='0 0 90 38.938'>
                            <path class="hoverpath" @click="selectProduct('right_wrist')"
                                d='m 21.255,-0.00198191 2.88,6.90000201 8.412,1.335 0.664,12.4579799 -4.427,17.8 -2.878,-0.22 2.8,-11.847 -2.99,-0.084 -4.676,12.6 -3.544,-0.446 4.4,-12.736 -3.072,-0.584 -5.978,13.543 -4.428,-0.445 6.088,-14.1 -2.1,-1.25 L 4.878,34.934 1.114,34.489 12.4,12.9 11.293,11.12 0.665,15.57 0,13.124 8.635,5.3380201 Z' />
                        </svg>
                        <svg :class="{ 'highlighted': cart.left_wrist != null }" id='right-hand' width='90'
                            height='38.938' viewBox='0 0 90 38.938'>
                            <path class="hoverpath" @click="selectProduct('left_wrist')"
                                d='m 13.793386,-0.00198533 -2.88,6.90000163 -8.4120002,1.335 -0.664,12.4579837 4.427,17.8 2.878,-0.22 -2.8,-11.847 2.99,-0.084 4.6760002,12.6 3.544,-0.446 -4.4,-12.736 3.072,-0.584 5.978,13.543 4.428,-0.445 -6.088,-14.1 2.1,-1.25 7.528,12.012 3.764,-0.445 -11.286,-21.589 1.107,-1.78 10.628,4.45 0.665,-2.447 -8.635,-7.7859837 z' />
                        </svg>
                        <svg :class="{ 'highlighted': cart.right_foot != null }" id='left-foot' width='30' height='30'
                            viewBox='0 0 30 30'>
                            <path class="hoverpath" @click="selectProduct('right_foot')"
                                d='m 19.558357,1.92821 c -22.1993328,20.55867 -11.0996668,10.27933 0,0 z m 5.975,5.989 -0.664,18.415 -1.55,6.435 -4.647,0 -1.327,-4.437 -1.55,-0.222 0.332,4.437 -5.864,-1.778 -1.5499998,-0.887 -6.64,-1.442 -0.22,-5.214 6.418,-10.87 4.4259998,-5.548 c 9.991542,-3.26362 9.41586,-8.41457 12.836,1.111 z' />
                        </svg>
                        <svg :class="{ 'highlighted': cart.left_foot != null }" id='right-foot' class='right-foot'
                            width='90' height='38.938' viewBox='0 0 90 38.938'>
                            <path class="hoverpath" @click="selectProduct('left_foot')"
                                d='m 11.723492,2.35897 c -40.202667,20.558 -20.1013335,10.279 0,0 z m -5.9740005,5.989 0.663,18.415 1.546,6.435 4.6480005,0 1.328,-4.437 1.55,-0.222 -0.333,4.437 5.863,-1.778 1.55,-0.887 6.638,-1.442 0.222,-5.214 -6.418,-10.868 -4.426,-5.547 -10.8440005,-4.437 z' />
                        </svg>

                    </div>
                    <div class="container-bottom">
                        <div class="row" style="max-height: 250px; overflow-y: scroll;">
                            <div class="col-md-3 col-sm-6" v-for="(key, value) in sortedCart">

                                <div class="tray text-center" v-if="key">
                                    <div class="product-grid8">
                                        <img  class="pic-1 " :src="'storage/' + JSON.parse(key.photos)[0]">
                                        <ul class="social">
                                            <h3 style="color: aliceblue;">Название: {{ key.name }}</h3>
                                            <h3 style="color: aliceblue;">Цена: {{ key.price }}</h3>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <a href="#" @click="showEditProduct(key, value)" style="font-size: small;"
                                            class="btn btn-primary  btn-custom ">редактировать</a>
                                        <a href="#" @click="deleteProduct(key, value)" class="btn btn-danger btn-custom">x</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
         
            <div class="right-side">
                <div class="container-sidebar">

                    <div class="sidebar">

                        <div class="row" style="">
                            <div v-if="viewMode == 'products'">
                                <div class="col-md-12 col-sm-12">
                                    <div class="flexbox">

                                        <div class="search">
                                            <div>
                                                <input type="text" placeholder="Поиск . . ." v-model="productName"
                                                    @input="nameFilter">
                                            </div>
                                        </div>
                                        <div>
                                            <button @click="resetSearch()">x</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div v-if="viewMode == 'products'">
                                <div class="col-md-10 col-sm-6" v-for="product in displayProducts" :key="product.id">
                                    <div class="">
                                        <article class="card">
                                            <a href="#" class="card__link">
                                                <div class="card__media">
                                                    <img class="pic-1" style="height: 300px;"
                                                        v-bind:src="'storage/' + JSON.parse(product.photos)[0]">
                                                </div>
                                                <div class="card__header">
                                                    <h3 class="card__header-title">{{ product.name }}</h3>
                                                    <p class="card__header-meta">{{ product.price }}р</p>

                                                    <div class="card__header-icon">
                                                        <svg @click="addProduct(product)" viewbox="0 0 28 25">
                                                            <path fill="#fff"
                                                                d="M13.145 2.13l1.94-1.867 12.178 12-12.178 12-1.94-1.867 8.931-8.8H.737V10.93h21.339z" />
                                                        </svg>
                                                    </div>
                                                </div>

                                            </a>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <table class="table" style="margin-bottom: 0;">
                                    <tbody>
                                        <tr v-for="(item, index) in foundSpecification" :key="index">
                                            <div v-if="foundSpecification[index] && index != 'side'">

                                                <td style="width: 200px;">{{ index }}</td>
                                                <td>
                                                    <input type="text" v-model="foundSpecification[index]"
                                                        class="form-control" />
                                                </td>
                                            </div>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <a href="#" style="text-align: center; width: 100%; height: 100%;"
                                        @click="editProduct()" class="btn btn-primary">Изменить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add-to-cart ">
                    <div class="constructor-info">
                        <div class="">
                            <p class="info-text">Сумма: {{ calculateTotal }}</p>
                        </div>
                    </div>
                    <button @click="addToCart()" class="noselect constructor-add-to-cart">
                        <span class="text">В КОРЗИНУ</span>
                    </button>
                </div>

            </div>

        </div>
    </div>
</template>




<script>
import { useRemember } from '@inertiajs/vue3';

export default {

    data() {
        return {
            products: [],
            displayProducts: [],
            categories: [],
            specifications: [],
            current_limb_for_edit: {},
            foundSpecification: [],
            cart: {
                'left_wrist': this.left_wrist,
                'right_wrist': this.right_wrist,
                'left_forearm': this.left_forearm,
                'right_forearm': this.right_forearm,
                'left_shoulder': this.left_shoulder,
                'right_shoulder': this.right_shoulder,
                'left_foot': this.left_foot,
                'right_foot': this.right_foot,
                'left_knee': this.left_knee,
                'right_knee': this.right_knee,
                'left_hip': this.left_hip,
                'right_hip': this.right_hip,
            },
            selected: '',
            viewMode: 'products',
        }
    },
    mounted() {
        this.LoadProducts();
    },
    computed: {

        sortedCart() {
            const sortedCart = Object.entries(this.cart)
                .filter(([key, value]) => value !== null && value !== undefined) // Фильтруем непустые значения
                .sort((a, b) => a[1] - b[1]) // Сортируем по значению
                .reduce((acc, [key, value]) => {
                    acc[key] = value;
                    return acc;
                }, {});

            return sortedCart;

        },
       
        calculateTotal() {
            let total = 0;
            for (const key in this.cart) {
                if (this.cart[key] && this.cart[key].price) {
                    total += parseFloat(this.cart[key].price);
                }
            }
            return total;
        },

    },

    methods: {

        LoadProducts() {
            axios.get('products').then(response => {
                this.loadSpecifications();
                this.products = response.data;
            });
        },
        async loadSpecifications() {
            try {
                await axios.get('load-specifications').then(response => {
                    this.specifications = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        nameFilter() {
            if (this.productName) {
                const filteredProducts = this.displayProducts.filter(product => product.name.toLowerCase().includes(this.productName.toLowerCase()));
                this.displayProducts = filteredProducts;
            } else {
                this.selectProduct(this.selected)
            }
        },
        resetSearch() {
            this.productName = '';
            this.nameFilter();
        },

        selectProduct(product) {
            this.viewMode = 'products';
            this.selected = product;
            if (product == 'left_wrist' || product == 'right_wrist') {
                this.displayProducts = this.products.filter(item => item.category_id == 3);
            } else if (product == 'left_forearm' || product == 'right_forearm') {
                this.displayProducts = this.products.filter(item => item.category_id == 2);
            } else if (product == 'left_shoulder' || product == 'right_shoulder') {
                this.displayProducts = this.products.filter(item => item.category_id == 1);
            } else if (product == 'left_knee' || product == 'right_knee') {
                this.displayProducts = this.products.filter(item => item.category_id == 5);
            } else if (product == 'left_foot' || product == 'right_foot') {
                this.displayProducts = this.products.filter(item => item.category_id == 6);
            } else if (product == 'left_hip' || product == 'right_hip') {
                this.displayProducts = this.products.filter(item => item.category_id == 4);
            }
        },
        addProduct(product) {

            if (this.selected == 'left_wrist') {
                this.left_wrist = product;
                this.cart.left_wrist = product;
                this.cart.left_wrist['side'] = this.selected;
            } else if (this.selected == 'right_wrist') {
                this.right_wrist = product;
                this.cart.right_wrist = product;
                this.cart.right_wrist['side'] = this.selected;
            } else if (this.selected == 'left_forearm') {
                this.left_forearm = product;
                this.cart.left_forearm = product;
                this.cart.left_forearm['side'] = this.selected;
            } else if (this.selected == 'right_forearm') {
                this.right_forearm = product;
                this.cart.right_forearm = product;
                this.cart.right_forearm['side'] = this.selected;
            } else if (this.selected == 'left_shoulder') {
                this.left_shoulder = product;
                this.cart.left_shoulder = product;
                this.cart.left_shoulder['side'] = this.selected;
            } else if (this.selected == 'right_shoulder') {
                this.right_shoulder = product;
                this.cart.right_shoulder = product;
                this.cart.right_shoulder['side'] = this.selected;
            } else if (this.selected == 'right_hip') {
                this.right_hip = product;
                this.cart.right_hip = product;
                this.cart.right_hip['side'] = this.selected;
            } else if (this.selected == 'left_hip') {
                this.left_hip = product;
                this.cart.left_hip = product;
                this.cart.left_hip['side'] = this.selected;
            } else if (this.selected == 'left_knee') {
                this.left_knee = product;
                this.cart.left_knee = product;
                this.cart.left_knee['side'] = this.selected;
            } else if (this.selected == 'right_knee') {
                this.right_knee = product;
                this.cart.right_knee = product;
                this.cart.right_knee['side'] = this.selected;
            } else if (this.selected == 'left_foot') {
                this.left_foot = product;
                this.cart.left_foot = product;
                this.cart.left_foot['side'] = this.selected;
            } else if (this.selected == 'right_foot') {
                this.right_foot = product;
                this.cart.right_foot = product;
                this.cart.right_foot['side'] = this.selected;
            }

        },

        showEditProduct(product, side) {

            this.viewMode = 'table';

            const limbKey = side; // Получаем ключ конечности (например, 'left_wrist')

            // Проверяем, существует ли уже спецификация для выбранной конечности
            if (this.current_limb_for_edit.hasOwnProperty(limbKey) && this.current_limb_for_edit[limbKey] !== null) {
                this.foundSpecification = { ...this.current_limb_for_edit[limbKey] }; // Используем существующую спецификацию
            } else {
                const specificationsArray = Object.values(this.specifications);
                const combinedArray = specificationsArray.reduce((result, proxyObj) => {
                    for (const key in proxyObj) {
                        result.push(proxyObj[key]);
                    }
                    return result;
                }, []);

                const foundItem = combinedArray.find(item => item.category_id === product.category_id && item.id === product.specifiable_id);

                const filteredFoundItem = {
                    ...foundItem,
                    id: undefined,
                    category_id: undefined,
                    product_type: undefined,
                    created_at: undefined,
                    updated_at: undefined,
                    type_of_side: undefined
                };

                this.foundSpecification = filteredFoundItem;
            }

            this.foundSpecification.side = limbKey; // Назначаем значение конечности
            this.current_limb_for_edit[limbKey] = { ...this.foundSpecification };

            console.log(this.cart);
        },
        editProduct() {

            for (const key in this.current_limb_for_edit) {
                if (key == this.foundSpecification.side) {

                    this.current_limb_for_edit[key] = this.foundSpecification;
                }
            }
            this.viewMode = 'products'
            console.log(this.foundSpecification)
            console.log(this.current_limb_for_edit)

        },
        deleteProduct(product, side) {
            this.viewMode = 'products';
            for (const key in this.cart) {
                if (this.cart[side] === product) {
                    this.cart[side] = null
                    this.current_limb_for_edit[side] = null
                    break;
                }
            }
            this.sortedCart;
        },


        addToCart() {
            var cart = {};

            for (const key in this.cart) {
                if (this.cart[key] == null) {
                    continue;
                } else {
                    var product = { ...this.cart[key] };
                    if (key.toLowerCase().includes('left')) {
                        product.side = 'L';
                    } else if (key.toLowerCase().includes('right')) {
                        product.side = 'R';
                    } else {
                        product.side = 'N';
                    }
                    cart[key] = product;
                }
            }

            axios.post('constructor/add-to-cart', { products: cart, p_specifications: this.current_limb_for_edit }).then(response => console.log(response));
            this.cart = {};
        }
    }
}
</script>

<style scoped>
@media (max-width: 800px) {
    .container {
        height: 1900px !important;
    }

    .content {
        display: flex !important;
        flex-wrap: wrap !important;
    }

    .left-side {
        position: relative !important;
        width: 100% !important;
        height: 900px !important;
        margin-left: 45%;
    }

    .right-side {
        position: relative !important;
        top: 100% !important;
        width: 100% !important;
        margin-bottom: 20px;
    }

    .add-to-cart {

        position: absolute !important;
        left: 10%;

        width: 300px !important;
        height: 230px;
       
    }
    .card {
        width: 20em !important;
    }
    .left-content {
        max-width: 290px;
    }
    .human-body {
        margin: 40px auto 20px !important;
    }
}

@media (min-width: 801px) and (max-width: 1420px) {
    .container {
        height: 1000px !important;
        position: relative !important;
    }

    .content {

        position: relative !important;
        margin: 0 auto !important;
    }

    .left-side {
        width: 45% !important;
        position: absolute !important;
        display: flex !important;
        right: 45% !important;
    }

    .container-bottom {
        position: absolute !important;
        width: 150% !important;
        left: -20%;
    }

    .container-sidebar {
        height: 540px !important;
        overflow-y: scroll;

    }

    .add-to-cart {

        position: absolute !important;
        width: 100% !important;
        height: 230px;
        /* border: 3px solid #000000; */
    }

    .card {
        margin-left: 10% !important;
        margin-bottom: 10px !important;
        position: relative !important;
        width: 180% !important;
        background-color: #08094b !important;
        transition: all .3s ease-in-out !important;


    }
    .col-sm-6 {
        width: 50%;
    }

    .left-content {
        max-width: 290px;
    }
}


.container {
    height: 1000px;
}

.container-sidebar {
    margin-left: auto;
    max-width: 30px;
    overflow-y: scroll;
}

.info-text {
    font-size: 28px;
    color: #333;
    margin-left: 10px;
    font-weight: bold;
}

.content {
    position: relative;
    margin: 0 auto;
}

.left-side {
    width: 55%;
    position: absolute;
    display: flex;
    /* flex-direction: column; */
    right: 35%;
}


.right-side {
    position: absolute;
    width: 40%;
    top: 40px;
    right: 0;

}

.left-content {
    position: relative;
    height: 600px;
    width: 900px;
}

.constructor-info {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 40px;
}
/* SEARCH */
.flexbox {
    display: flex;
    justify-content: start;
    align-items: center;
}

.search {
    margin: 20px;
}

.search>div {
    display: inline-block;
    position: relative;
    filter: drop-shadow(0 1px #0d0d0e);
}

.search>div:after {
    content: "";
    background: #18191a;
    width: 4px;
    height: 10px;
    position: absolute;
    top: 20px;
    right: 0px;
    z-index: -1;
    transform: rotate(135deg);
}

.search>div>input {
    color: #0e0f0f;
    font-size: 16px;
    background: transparent;
    width: 25px;
    height: 25px;
    padding: 10px;
    outline: none;
    border-radius: 35px;
    transition: width 0.5s;
}

.search>div>input::placeholder {
    color: #000000;
    opacity: 0;
    transition: opacity 150ms ease-out;
}

.search>div>input:focus::placeholder {
    opacity: 1;
}

.search>div>input:focus,
.search>div>input:not(:placeholder-shown),
.search>div>input:active {
    width: 270px;
    outline: none;
    box-shadow: none;
    border-color: #000000;
}


/* SEATCH */

/* button */
.noselect {
    position: relative;
    top: 40%;
    left: 50%;
    transform: translate(-50%, 50%);
}

.constructor-add-to-cart {
    width: 150px;
    height: 50px;
    cursor: pointer;
    display: flex;
    top: 0;
    align-items: center;
    background: red;
    border: none;
    border-radius: 5px;
    /* box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15); */
    background: #2553b6;
}

.constructor-add-to-cart,
.constructor-add-to-cart span {
    transition: 200ms;
}

.constructor-add-to-cart .text {
    transform: translateX(35px);
    color: white;
    font-weight: bold;
}

.constructor-add-to-cart:hover {
    background: #000000;
}

.constructor-add-to-cart:hover .text {
    color: transrgb(3, 102, 168)
}

.constructor-add-to-cart:focus {
    outline: none;
}


.add-to-cart {
    position: absolute;
    right: 0;
   
    width: 400px;
    height: 230px;
    
}

.tray {
    border: 1px solid #1371AF;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
}

.text-center {
    text-align: center;
}

.container-sidebar {
    height: 60vh;
    margin-left: auto;
    max-width: 400px;
    overflow-y: scroll;
    overflow-x: hidden;
    border-radius: 13px;
    background-color: #ffffff;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.212);
}

.container-bottom {
    position: absolute;
    max-width: 1170px;
    /* padding-left: 330px; */
    flex: 1;
    top: 100%;
    width: 100%;

}

.container-bottom .row {
    border: 3px solid #ffffff;
    border-radius: 15px;
    min-height: 250px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.514);
}

.product-grid8 {
    font-family: Poppins, sans-serif;
    position: relative;
    z-index: 1;

}

.product-grid8 .product-image8 {
    border: 1px solid #e4e9ef;
    position: relative;
    transition: all .3s ease 0s
}

.product-grid8:hover .product-image8 {
    box-shadow: 0 0 10px rgba(0, 0, 0, .15)
}

.product-grid8 .product-image8 a {
    display: block
}

.product-grid8 .product-image8 img {
    width: 100%;
    height: auto
}

.product-grid8 .pic-1 {
    opacity: 1;
    transition: all .5s ease-out 0s;
    height: 150px;
}

.product-grid8:hover .pic-1 {
    filter: brightness(40%)
}

.product-grid8 .social {
    padding: 0;
    margin: 0;
    list-style: none;
    position: absolute;
    bottom: 13px;

    z-index: 1
}

.product-grid8 .social h3 {
    opacity: 0;
    transform: translateY(3px);
    transition: all .5s ease 0s
}

.product-grid8:hover .social h3 {
    margin: 0 0 10px;
    opacity: 1;
    transform: translateY(0)
}

.pic-1 {
    overflow: hidden;
    position: relative;
    width: 350px;
    margin-bottom: 25px;
}

.highlighted path {
    fill: rgb(18, 61, 156);
}

.card {
    margin-left: 5%;
    margin-bottom: 10px;
    position: relative;
    width: 22em;
    /* background-color: #292929; */
    background-color: #08094b;
    transition: all .3s ease-in-out;

}


.card__link {
    display: block;
    padding: 1em;
    text-decoration: none;
}

.card__media {
  
    svg path {
        opacity: 0;
        transition: all .3s ease-in-out;
        transform-origin: center center;
    }


}

.card__media img {
    border-radius: 12px;
}

.card__header {
    position: relative;
}

.card__header-title {
    margin: 0 0 .25em;
    color: white;
}

.card__header-meta {
    margin: 0;
    color: #ffffff;
}

.card__header-icon {
    opacity: 0;
    position: absolute;
    right: 0;
    top: 50%;
    margin-top: -1em;
    transform: translateX(-20%);
    width: 2em;
    height: 2em;
    transition: all .3s ease-in-out;

    .card:hover & {
        opacity: 1;
        transform: translateX(0);
    }
}

.human-body {
    width: 207px;
    position: relative;
    margin: 40px auto 20px;
}

.human-body svg:hover {
    cursor: pointer;
}

.human-body svg:hover .hoverpath {
    fill: #ff7d16;
}


.human-body svg {
    position: absolute;
    left: 50%;
    fill: #57c9d5;
}

.human-body svg#head {
    margin-left: -28.5px;
    top: -6px;
}

.human-body svg#left-shoulder {
    margin-left: -53.5px;
    top: 69px;
}

.human-body svg#right-shoulder {
    margin-left: 13.5px;
    top: 69px;
}

.human-body svg#left-arm {
    margin-left: -78px;
    top: 112px;
}

.human-body svg#right-arm {
    margin-left: 38px;
    top: 112px;
    z-index: 10001;
}

.human-body svg#chest {
    margin-left: -43.5px;
    top: 88px;
}

.human-body svg#stomach {
    margin-left: -37.5px;
    top: 130px;
}

.human-body svg#left-leg {

    margin-left: -46.5px;
    top: 205px;
    z-index: 1;
}

.human-body svg#left-knee {

    margin-left: -46.5px;
    top: 205px;
    z-index: 998;
}


.human-body svg#left-golen {
    margin-left: -46.5px;
    top: 205px;
    z-index: 0;
}


.human-body svg#right-leg {
    margin-left: 1.5px;
    top: 205px;
    z-index: 999;
}

.human-body svg#right-knee {
    margin-left: 1.5px;
    top: 205px;
    z-index: 998;
}

.human-body svg#right-golen {
    margin-left: 1.5px;
    top: 205px;
    z-index: 0;
}

.human-body svg#left-hand {
    margin-left: -102.5px;
    top: 224px;
}

.human-body svg#right-hand {
    margin-left: 66.5px;
    top: 224px;
    z-index: 10000;
}

.human-body svg#left-foot {
    margin-left: -35.5px;
    top: 455px;
}

.human-body svg#right-foot {
    margin-left: 5.5px;
    top: 455px;
}

</style>