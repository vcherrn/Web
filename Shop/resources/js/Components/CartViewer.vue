
<template>
    <div class="container">
       
            <div class="row">
                <div class="col-md-9">
                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="pull-right">(<strong>{{ products.length }}</strong>) Товары</span>
                            <h5>Товары в корзине</h5>
                        </div>
                        <div  class="ibox-content">
                            <div class="table-responsive">
                                <div v-if="summaryPrice == 0">
                                    Корзина пуста
                                </div>
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <tr v-for=" product in this.products" >
                                            <td width="190">
                                                <img class="cart-product" v-bind:src="'storage/' + JSON.parse(product.photos)[0]" alt="...">
                                            </td>
                                           
                                            <td class="desc">
                                                <h3>
                                                    <a href="#" @click="redirectToProductPage(product.prosthes_id)" class="text-navy">
                                                        {{product.name}}
                                                    </a>
                                                </h3>
                                               
                                                <dl class="small m-b-none">
                                                    <dt>Категория</dt>
                                                    
                                                    <dd style="font-size: 1.2rem;"> {{ getCategoryName(product.category_id) }} </dd>
                                                    <div v-if="product.specification">
                                                        (изм)
                                                    </div>
                                                </dl>

                                                <div class="m-t-sm">
                                                   
                                                  <a href="#" class="text-muted"><i class="fa fa-trash"></i> 
                                                        <button class="btn " @click="$event => remove(product.id)">   
                                                            Убрать с корзины
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>

                                            <td width="125">
                                                <div class="form-check form-check-inline">
                                                    <input :checked="product.side === 'L'"
                                                        v-model="product.side"
                                                        class="form-check-input"
                                                        type="radio"
                                                        :name="'inlineRadioOptions_' + product.id + '_l'"
                                                        :id="'inlineRadioOptions_' + product.id + '_l'"
                                                        value="L">
                                                    <label :for="'inlineRadioOptions_' + product.id + '_l'"
                                                        class="form-check-label">L</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input :checked="product.side === 'R'"
                                                        v-model="product.side"
                                                        class="form-check-input"
                                                        type="radio"
                                                        :name="'inlineRadioOptions_' + product.id + '_r'"
                                                        :id="'inlineRadioOptions_' + product.id + '_r'"
                                                        value="R">
                                                    <label :for="'inlineRadioOptions_' + product.id + '_r'"
                                                        class="form-check-label">R</label>
                                                </div>
                                            </td>

                                            <td width="65">
                                                <input type="number"
                                                v-bind="prosthes_count[product.id] = product.count"
                                                v-model="product.count" min="1" 
                                                class="form-control" @input="updateSummaryPrice()">
                                            </td>

                                            <td>
                                                <h4>
                                                {{product.price}}
                                                </h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        
                        <div class="ibox-content">
                            <button  @click="redirectToContinueShopping" class="btn btn-white"><i class="fa fa-arrow-left"></i> Продолжить покупки</button>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Цена</h5>
                        </div>
                        <div class="ibox-content">
                            <span>
                                Всего:
                            </span>
                            <h2 class="font-bold">
                               <p> {{ summaryPrice }} </p>
                            </h2>
                            <hr>
                            <br>

                            <div class="m-t-sm">
                                <div class="btn-group">
                                    <a  class="btn btn-primary btn-sm" :class="{ disabled: summaryPrice == 0 }"
                                        @click="showOrder()" href="#">
                                        <i class="fa fa-shopping-cart"></i>
                                        Продолжить
                                    </a>
                                </div>
                            </div>
                            <span class="text-muted small">
                                *Сумма заказа может измениться. Это произойдет, если Вы указали собственные спецификации в конструкторе протезов. 
                                Сообщение об изменении суммы придет на указанную почту, или мы Вам позвоним.
                            </span>
                            
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Поддержка</h5>
                        </div>
                        <div class="ibox-content text-center">
                            <h3><i class="fa fa-phone"></i> +7 777 777 77 77</h3>
                            <span class="small">
                                Пожалуйста, свяжитесь с нами, если у вас возникнут какие-либо вопросы. Мы доступны 24 часа в сутки.
                            </span>
                        </div>
                    </div>

                    
                </div>
            </div>
       
    </div>
</template>
  
  
  
  
<script>
export default {
    data() {
        return {
            products: [],
            summaryPrice: 0,
            prosthes_count:{},
            categories: [],
           
        }
    },
    
    mounted() {
        this.LoadCart();
    },
    methods: {
       
        LoadCart() 
        {
            this.loadCategories();
            axios.get('cart/products').then( (response)=>{
                  this.products = response.data;
                  this.updateSummaryPrice();
                });
        },
        loadCategories() {
            axios.get('/get-categories').then(response => {
                this.categories = response.data;
            });
        },
        getCategoryName(categoryId) {
            const category = this.categories.find(category => category.id == categoryId);
            return category.name;
        },

        updateSummaryPrice() 
        {
            if(this.summaryPrice == 0){
                for (const product of this.products) {
                    this.summaryPrice += product.price * product.count;
                }
            } else{
                this.summaryPrice = this.calculateSummaryPrice();
            }
          
        },
        
        calculateSummaryPrice() 
        {
            let totalPrice = 0;
            for (const product of this.products) {
                totalPrice += parseInt(product.price) * this.prosthes_count[product.id];
            }
            return totalPrice;
        },
        async remove(event)
        {
            try{
                await axios.delete('cart/delete/' + event);
                await this.LoadCart();
            } catch(error){
                
            }
           
        },
        showOrder()
        {
            axios.put('cart/update', { count: this.prosthes_count, products: this.products});
            window.location.replace("order");
        },
        redirectToContinueShopping() {
            window.location.href = '/shop';
        },
        redirectToProductPage(id){
           this.$inertia.visit('products/' + id);
        },

    }
}
</script>
  
<style scoped>

.cart-product {
    text-align: center;
    padding-top: 0px;
    height: 140px;
    width: 160px;
    background-color: #f8f8f9;
}

table.shoping-cart-table {
    margin-bottom: 0;
}

table.shoping-cart-table tr td {
    border: none;
    text-align: right;
}

table.shoping-cart-table tr td.desc,
table.shoping-cart-table tr td:first-child {
    text-align: left;
}

table.shoping-cart-table tr td:last-child {
    width: 80px;
}

.ibox {
    clear: both;
    margin-bottom: 25px;
    margin-top: 0;
    padding: 0;
}

.ibox-title {
    background-color: #ffffff;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 3px 0 0;
    color: inherit;
    margin-bottom: 0;
    padding: 14px 15px 7px;
    min-height: 48px;
}

.ibox-content {
    background-color: #ffffff;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
}

</style>
  