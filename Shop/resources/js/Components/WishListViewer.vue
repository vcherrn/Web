<template>
    <div class="container mt-5 p-3 rounded cart">
        <div class="row no-gutters">
            <div class="">
                <div class="product-details mr-2">
                    <div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i>
                      <span @click="redirectToContinueShopping()" style="cursor: pointer;" class="ml-2">Продолжить покупки</span>
                    </div>
                    <hr>
            
                     <div v-if="!products.length">
                        <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                             Список пуст 
                          </div>
                     </div>  

                    <div v-for="product in products">
                        <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                            <div class="d-flex flex-row">
                                <img  style="max-width: 100px; cursor: pointer;" class="rounded" v-bind:src="'storage/' + JSON.parse(product.photos)[0]">
                              
                                <div class="ml-2"><span class="font-weight-bold d-block">{{ product.name }}</span>
                                    <span @click="AddToCart(product.prosthes_id)" style="cursor: pointer; color:blue;" class="spec">Добавить в корзину</span>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center"><span class="d-block ml-5 font-weight-bold">{{ product.price }}р   </span>
                                  <i @click="deleteFromWishList(product.prosthes_id)" style="cursor: pointer;" class="fa fa-trash-o ml-3 text-black-50"></i> 
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
import axios from 'axios';

export default {
    mounted() {
        this.fetchWishListData();
    },
    data() {
        return {
            products:{}
        }
    },
    methods: {
        AddToCart(id) {
            axios.post('wishlist/add-to-cart', { id: id });
            window.location.href = '/cart';
        },

        async deleteFromWishList(id){
          try{
            await axios.delete('wishlist/delete/' + id);
            this.fetchWishListData();
          }
          catch(error){
            console.error(error);
          }
           
        },
        async fetchWishListData() {
          try {
            const response = await axios.get('wishlist/products/');
            this.products = response.data;
          } catch (error) {
            console.error(error);
          }
        },
        loadData() {
            axios.get('wishlist/products/')
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        redirectToContinueShopping() {
            window.location.href = '/shop';
        },

    }

};
</script>

<style scoped>

.product-details {
  padding: 10px;
}


.cart {
  background: #fff;
}


.table-shadow {
  -webkit-box-shadow: 5px 5px 15px -2px rgba(0,0,0,0.42);
  box-shadow: 5px 5px 15px -2px rgba(0,0,0,0.42);
}

.items {
  -webkit-box-shadow: 5px 5px 4px -1px rgba(0,0,0,0.25);
  box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.08);
}

</style>