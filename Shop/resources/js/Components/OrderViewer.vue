<template>
    <div class="container ">
        <div class="row">
            <div class="col-md-4 mb-4 position-static">
                <div class=" sticky-top card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0 text-font">{{ products.length }} Товар(а)</h5>
                    </div>
                    <div class="card-body">
                        <div class="row" v-for=" product in products">
                            <div class="col-md-4" style="margin-top: 10px;">
                                <img v-bind:src="'storage/' + JSON.parse(product.photos)[0]" class="rounded-3"
                                    style="width: 100px; height: 100px;" />
                            </div>
                            <div class="col-md-6 ms-3">
                                <span class="mb-0 text-price">Цена: {{ parseInt(product.price) }}р</span>
                                <p class="mb-0 text-descriptions"> Наименование: <b> {{ product.name }} </b> </p>

                                <p class="text-descriptions mt-0">
                                    Количество:
                                    <span class="text-descriptions fw-bold"
                                        v-bind="product_count[product.prosthes_id] = product.count">
                                        {{ product.count }}
                                    </span>
                                </p>
                                <p class="text-descriptions mt-0">
                                    Сторона:
                                    <span class="text-descriptions fw-bold"
                                        v-bind="product_count[product.side] = product.count">
                                        {{ product.side }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="card-footer mt-4">
                            <ul class="list-group list-group-flush">

                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center px-0 fw-bold text-uppercase">
                                    ИТОГО
                                    <span>{{ this.getSummaryPrice() }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0 text-font text-uppercase">Адрес Доставки</h5>
                    </div>
                    <div class="col">
                        <div class="form-group text-right">
                            <select v-model="selectedAddress" id="deliveryAddress" @change="AddressChange" class="form-control">
                                <option value="own">Свой адрес</option>
                                <option value="center">Адрес нашего центра</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="putOrder()">

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input v-model="order.name" type="text" id="form11Example1" class="form-control"
                                            required />
                                        <label class="form-label" for="form11Example1">Имя</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input v-model="order.surname" type="text" id="form11Example2"
                                            class="form-control" required />
                                        <label class="form-label" for="form11Example2">Фамилия</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input v-model="order.patronymic" type="text" id="form11Example2"
                                            class="form-control" required />
                                        <label class="form-label" for="form11Example2">Отчество</label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-outline mb-4">
                                <input v-model="order.country" type="text" id="form11Example4" class="form-control"
                                    required />
                                <label class="form-label" for="form11Example4">Страна</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input v-model="order.town" type="text" id="form11Example4" class="form-control"
                                    required />
                                <label class="form-label" for="form11Example4">Город</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input v-model="order.area" type="text" id="form11Example4" class="form-control"
                                    required />
                                <label class="form-label" for="form11Example4">Район</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input v-model="order.street" type="text" id="form11Example4" class="form-control"
                                    required />
                                <label class="form-label" for="form11Example4">Улица</label>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input v-model="order.house" type="text" id="form11Example1"
                                            class="form-control" required />
                                        <label class="form-label" for="form11Example1">Дом</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input v-model="order.apartment" type="text" id="form11Example2"
                                            class="form-control" required />
                                        <label class="form-label" for="form11Example2">Квартира</label>
                                    </div>
                                </div>

                            </div>

                            <div class="form-outline mb-4">
                                <input v-model="order.email" type="email" id="form11Example5" class="form-control"
                                    required />
                                <label class="form-label" for="form11Example5">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input v-model="order.phone" type="text" id="form11Example6" class="form-control"
                                    required />
                                <label class="form-label" for="form11Example6">Номер телефона</label>
                            </div>

                            <div class="form-outline mb-4">
                                <textarea v-model="order.message_text" class="form-control" id="form11Example7"
                                    rows="4"></textarea>
                                <label class="form-label" for="form11Example7">Дополнительная информация</label>
                            </div>


                            <div>
                                <div v-for="method in paymentMethods" :key="method.id" class="flex align-items-center">
                                    <input type="radio" :id="method.name" name="paymentMethod" :value="method.id"
                                        v-model="selectedMethod">
                                    <label :for="method.name" class="ml-2">{{ method.name }}</label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="button-order" type="submit">Сделать заказ</button>
                            </div>
                        </form>
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
            product_count: {},
            order: {},

            paymentMethods: [
                { id: 1, name: 'Наличными' },
                { id: 2, name: 'Карта' }
            ],
            selectedMethod: null,
        }
    },
    mounted() {
        this.LoadProducts();

    },
    methods: {
        LoadProducts() {
            axios.get('cart/products').then((response) => {
                this.products = response.data;
                this.order.sum = this.getSummaryPrice();
            });
        },
        getSummaryPrice() {
            let totalPrice = 0;
            for (const product of this.products) {
                totalPrice += parseInt(product.price) * product.count;
            }
            return totalPrice;
        },
        putOrder() {

            const selectedPaymentMethod = this.paymentMethods.find(method => method.id == this.selectedMethod);

            this.order.payment_method = selectedPaymentMethod.name;
            this.order.is_payed = 0;
            axios.post('order-confirm', this.order);
            window.location.href = '/shop';
        },
        AddressChange(){
            if(this.selectedAddress =='center'){
                this.order.country = 'Россия';
                this.order.town = 'Донецк';
                this.order.area = '1';
                this.order.street = '1';
                this.order.house = '1';
                this.order.apartment = '-';
            } else{
                this.order = {};
            }
            
        }

    }
}
</script>

<style>
.form-control {
    border-radius: 4px;
}

.text-font {
    font-family: futura-pt, Tahoma, Geneva, Verdana, Arial, sans-serif;
    font-weight: 700;
    letter-spacing: .156rem;
    font-size: 1.125rem;
}

.text-price {
    padding: 0 .625rem;
    font-family: futura-pt, Tahoma, Geneva, Verdana, Arial, sans-serif;
    font-style: normal;
    font-size: .75rem;
    font-weight: 700;
    line-height: .813rem;
    letter-spacing: 1.6px;
}

.text-descriptions {
    font-family: futura-pt, Tahoma, Geneva, Verdana, Arial, sans-serif;
    font-style: normal;
    font-size: .75rem;
    font-weight: 400;
    line-height: 1.125rem;
    margin: .313rem 0 .938rem;
    padding: 0 .625rem;
}

.button-order {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    text-transform: uppercase;
    color: #fff;
    background-color: #177ad6;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button-order:hover {
    background-color: rgb(36, 66, 236);
}

</style>