
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="history-page-left shadow-sm bg-white h-100">
                    <div class="border-bottom p-4">
                        <div class="text-center">
                            <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3"
                                 href="#">ИСТОРИЯ ПОКУПОК</a></p>
                        </div>
                    </div>
                    <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" >
                        <li class="nav-item">
                            <a class="nav-link" :href="route('profile.edit')" > Редактировать профиль </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 right-container">
                <div class=" shadow-sm bg-white p-4 h-100 overflow-auto">
                   
                    <div v-for="item in sortedUniqueIdsArray" class="tab-content">
                       
                        <div class="">
                            <h4 class="font-weight-bold mt-0 mb-4">ID заказа: {{ item.id }}</h4>
                            <div class="bg-white card mb-4 order-list shadow-sm">
                                <div class="p-4">
                                    
                                    <div v-for="product in products">
                                        
                                        <div v-if="product.order_id == item.id">
                                           
                                            <div class="d-none">
                                                {{ order_sum = product.order_sum }}
                                                {{ isactive = product.isactive }}
                                                {{ ispayed = product.ispayed }}
                                                {{ completeOrderDate = product.order_update }}
                                                {{ createOrderDate = product.order_create }}
                                            </div>
                                        
                                            <div class="media mt-2">
                                                <a href="#">
                                                    <img class="mr-4"
                                                        v-bind:src="'storage/' + JSON.parse(product.photos)[0]" alt="...">
                                                </a>
                                                <div class="media-body">
                                            
                                                    <h6 class="mb-2">
                                                       
                                                        <a href="#" class="text-black">{{ product.name }}</a>
                                                    </h6>
                                                    <p class="text-gray mb-1">
                                                        Кол-во: {{ product.count }}
                                                    </p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-right " v-if="isactive == 0 && ispayed == 1">
                                        <p class="mb-0 text-black text-primary pt-2">
                                            <span class="text-success font-weight-bold"> Статус: выполнен 
                                                {{ completeOrderDate }} </span>
                                        </p>
                                    </div>
                                    <div class="float-right" v-else-if="isactive == 0 && ispayed == 0">
                                        <p class="mb-0 text-black text-primary pt-2"><span
                                                class="text-danger font-weight-bold">
                                                Статус: Заказ отменен </span></p>
                                    </div>
                                    <div class="float-right" v-else-if="(isactive == 1 && ispayed == 1) ||
                                        (isactive == 1 && ispayed == 0)">
                                        <p class="mb-0 text-black text-primary pt-2"><span
                                                class="text-info font-weight-bold">
                                                Статус: находится в обработке с {{ createOrderDate }} </span></p>
                                    </div>

                                    <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold">
                                            Сумма:</span> {{ order_sum }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
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
            uniqueIdsArray: [],
            order_sum: 0,
            ispayed: 0,
            isactive: 0,
            completeOrderDate: null,
            createOrderDate: null,
        }
    },
    mounted() {
        this.LoadPage();

    },
    computed: {
        sortedUniqueIdsArray() {
            return Object.entries(this.uniqueIdsArray)
            .sort((a, b) => b[0] - a[0])
            .map(([key, value]) => ({ id: parseInt(key), count: value }));
        }
    },
    methods: {
        LoadPage() {
            axios.get('/load-orders').then((response) => {
                this.products = response.data;
                this.uniqueIdsArray = this.products.reduce((counts, product) => {
                    const id = product.order_id;
                    counts[id] = (counts[id] || 0) + 1;
                    return counts;
                }, {});
            });
            
        },
       
    }
}
</script>
  
<style>
.right-container {
    max-height: 100vh;
}


.history-page-left .nav-link {
    padding: 18px 20px;
    border: none;
    font-weight: 600;
    color: #535665;
}

.order-list img.mr-4 {
    width: 70px;
    height: 70px;
    object-fit: cover;
    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
    border-radius: 2px;
}

.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
}

</style>
  