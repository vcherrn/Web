<template>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-5">
                <div class="main-img">
                    <div class="container">
                        <article id="slider">
                            <div>
                            </div>
                            <input style="display: none;" checked type='radio' name='slider' id='slide1' />
                            <input style="display: none;" type='radio' name='slider' id='slide2' />
                            <input style="display: none;" type='radio' name='slider' id='slide3' />
                            <input style="display: none;" type='radio' name='slider' id='slide4' />
                            <input style="display: none;" type='radio' name='slider' id='slide5' />
                            <div id="slides">
                                <div id="container">
                                    <div class="inner" v-for="(photo, index) in JSON.parse($page.props.product.photos)"
                                        :key="index">
                                        <article>
                                            <img v-if="photo" v-bind:src="'/storage/' + photo">
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <div id="commands">
                                <label for='slide1'></label>
                                <label for='slide2'></label>
                                <label for='slide3'></label>
                                <label for='slide4'></label>
                                <label for='slide5'></label>
                            </div>
                            <div id="active">
                                <label for='slide1'></label>
                                <label for='slide2'></label>
                                <label for='slide3'></label>
                                <label for='slide4'></label>
                                <label for='slide5'></label>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="main-description px-2">
                    <div class="category text-bold">
                        Тип протеза - {{ specification.product_type }}
                    </div>
                    <div class="product-title text-bold my-3">
                        {{ $page.props.product.name }}
                    </div>

                    <div class="price-area my-4">
                        <p>Цена</p>
                        <p class="new-price text-bold mb-1">{{ $page.props.product.price }} руб</p>
                        <p class="text-secondary mb-1">(Цена может меняться в зависимости от Ваших потребностей)</p>

                    </div>
                    Выберите сторону:
                    <br>
                    <div class="form-check form-check-inline">
                        <input v-model="side" class="form-check-input" type="radio" name="inlineRadioOptions" value="L"
                            checked>
                        <label class="form-check-label">L</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="side" class="form-check-input" type="radio" name="inlineRadioOptions" value="R">
                        <label class="form-check-label">R</label>
                    </div>

                    <div class="buttons d-flex my-5">

                        <div class="block">
                            <button @click="AddToWishList($page.props.product.id)" class="shadow btn custom-btn">
                                В Желаемое </button>
                        </div>
                        <div class="block">
                            <button @click="AddToCart($page.props.product.id)" class="shadow btn custom-btn">
                                В Корзину </button>
                        </div>
                        <div class="block quantity">
                            <input v-model="count" type="number" class="form-control" id="cart_quantity" value="1"
                                min="1" max="99">
                        </div>
                    </div>

                </div>

                <div class="product-details my-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <button class="nav-link" :class="{ active: activeTab === 'productDescription' }"
                                v-on:click="activeTab = 'productDescription'">Описание продукта</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" :class="{ active: activeTab === 'manufacturerDescription' }"
                                v-on:click="activeTab = 'manufacturerDescription'">Описание производителя</button>
                        </li>
                    </ul>

                    <div v-if="activeTab === 'productDescription'">
                        <p class="description">{{ $page.props.product.description }}</p>
                        <p class="description"> <a href="#showSpecification"> <b>Подробднее..</b></a></p>
                    </div>
                    <div v-else-if="activeTab === 'manufacturerDescription'">
                        <p class="description"> Производитель: {{ creator[0].name }}</p>
                        <p class="description"> Страна: {{ creator[0].country }}</p>
                        <p class="description"> О производителе: {{ creator[0].description }}</p>

                    </div>
                </div>

                <div class="row questions bg-light p-3">
                    <div class="col-md-11 text">
                        Есть вопросы? Напишите нам на почту: mail@gmail.com или
                        <a @click="openRequestModal()" style="cursor: pointer;" class="text-info">оставьте заявку</a>
                        <ModalRequest :isOpen="isRequestModalOpen" :users="users" @close="closeModal"></ModalRequest>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div id="showSpecification" class="container my-4">
        <hr>
        <p class="display-5">Спецификации</p>
        <div v-if="specification">
            <div v-if="$page.props.product.specifiable_type == 'specification_foots'">
                <specification-foot :specification="specification"></specification-foot>
            </div>
            <div v-if="$page.props.product.specifiable_type == 'specification_hips'">
                <specification-hip :specification="specification"></specification-hip>
            </div>
            <div v-if="$page.props.product.specifiable_type == 'specification_forearms'">
                <specification-forearm :specification="specification"></specification-forearm>
            </div>
            <div v-if="$page.props.product.specifiable_type == 'specification_knees'">
                <specification-knee :specification="specification"></specification-knee>
            </div>
            <div v-if="$page.props.product.specifiable_type == 'specification_shoulders'">
                <specification-shoulder :specification="specification"></specification-shoulder>
            </div>
            <div v-if="$page.props.product.specifiable_type == 'specification_wrists'">
                <specification-wrist :specification="specification"></specification-wrist>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="col-md-12">

            <div class="tab-pane fade active show">
                <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                    <h5 class="mb-0 mb-4"><b>Рейтинг</b></h5>
                    <div class="graph-star-rating-header">
                        <div class="star-rating">
                            <p class="text-black ">Оценок: {{ reviews.length }} </p><br>
                        </div>
                        <b class="text-black mb-4 mt-2">{{ averageRating }} из 5</b>
                    </div>
                    <br>
                    <div class="graph-star-rating-body">
                        <div class="rating-list" v-for="rating in [5, 4, 3, 2, 1]" :key="rating">
                            <div class="rating-list-left text-black">
                                {{ rating }} ★
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div :style="'width: ' + ratingPercentages[rating] + '%'" :aria-valuemax="5"
                                        aria-valuemin="0" aria-valuenow="5" role="progressbar"
                                        class="progress-bar bg-primary">
                                    </div>
                                </div>
                            </div>
                            <div v-if="ratingPercentages[rating]" class="rating-list-right text-black">
                                {{ ratingPercentages[rating] }}%
                            </div>
                            <div v-else class="rating-list-right text-black">
                                {{ 0 }}%
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3 mb-3">
                        <a href="#reviewBlock" type="button" class="btn btn-outline-primary btn-sm">Оставить отзыв</a>
                    </div>
                </div>
                <div id="reviewBlock" v-if="hasPurchased">
                    <div v-if="!hasReview">
                        <div v-if="isBlocked">
                            Ваш аккакунт был заблокирован, Вы больше не можете осталвять отзывы к товарам
                        </div>
                        <div v-else class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                            <h5 class="mb-4"><b>ВЫ МОЖЕТЕ ОСТАВИТЬ КОММЕНТАРИЙ</b></h5>
                            <p class="mb-2">ВАША ОЦЕНКА</p>
                            <div class="mb-4">
                                <span class="star-rating" id="stars">
                                    <span class="star" v-for="star in 5" :key="star"
                                        :class="{ 'highlighted': star <= rate }" @click="rate = star">
                                        ★
                                    </span>
                                </span>
                            </div>
                            <form @submit.prevent="sendReview()">
                                <div class="form-group">
                                    <label>ОСТАВИТЬ КОММЕНТАРИЙ</label>
                                    <textarea class="form-control" v-model="review"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm text-black" type="submit">ОТПРАВИТЬ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div v-else>
                        <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                            <h5 class="mb-4"><b>ВАШ КОММЕНТАРИЙ</b></h5>
                            <div class="media">

                                <div class="media-body">
                                    <div class="reviews-members-header">
                                        <span class="star-rating float-right">
                                            <span class="star-rating" id="stars">
                                                <span class="star" v-for="star in 5" :key="star"
                                                    :class="{ 'highlighted': star <= user_review.rate }"
                                                    @click="rate = star">
                                                    ★
                                                </span>
                                            </span>
                                        </span>
                                        <h6 class="mb-1"><a class="text-black" href="#"><b>
                                                    {{ getUserName(user_review.user_id) }} </b></a></h6>
                                        <p class="text-date">
                                            {{ new Date(user_review.created_at * 1000).getDate() }}-
                                            {{ new Date(user_review.created_at * 1000).getMonth() + 1 }}-
                                            {{ new Date(user_review.created_at * 1000).getFullYear() }}
                                        </p>
                                    </div>
                                    <div class="reviews-members-body">
                                        <p> {{ user_review.m_text }} </p>
                                    </div>

                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm" @click="deleteReview()">Удалить комментарий</button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded shadow-sm p-4 mb-4 product-detailed-ratings-and-reviews">

                    <h5 class="mb-1">Отзывы:</h5>
                    <div v-for="(rev, index) in reviews" class="reviews-members pt-4 pb-4">
                        <div class="media">
                            <div class="media-body" v-if="index < 3">
                                <div class="reviews-members-header">
                                    <span class="star-rating float-right">
                                        <span class="star-rating" id="stars">
                                            <span class="star" v-for="star in 5" :key="star"
                                                :class="{ 'highlighted': star <= rev.rate }" @click="rate = star">
                                                ★
                                            </span>
                                        </span>
                                    </span>
                                    <h6 class="mb-1"><a class="text-black" href="#"><b>
                                                {{ getUserName(rev.user_id) }} </b></a>
                                    </h6>
                                    <p class="text-date">
                                        {{ new Date(rev.created_at * 1000).getDate() }}-
                                        {{ new Date(rev.created_at * 1000).getMonth() + 1 }}-
                                        {{ new Date(rev.created_at * 1000).getFullYear() }}
                                    </p>
                                </div>
                                <div class="reviews-members-body">
                                    <p> {{ rev.m_text }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <hr>
                    <a @click="openReviewsModal($page.props.product.id)"
                        class="text-center w-100 d-block mt-4 font-weight-bold" href="#">Смотреть все отзывы</a>
                    <ModalReviews :isOpen="isReviewsModalOpen" :productId="productId" :users="users"
                        @close="closeModal"></ModalReviews>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
import { useRemember } from '@inertiajs/vue3';
import ProductSpecification from '@/Components/ProductSpecification.vue';
import SpecificationFoot from '@/Components/Specifications/foot.vue';
import SpecificationHip from '@/Components/Specifications/hip.vue';
import SpecificationForearm from '@/Components/Specifications/forearm.vue';
import SpecificationKnee from '@/Components/Specifications/knee.vue';
import SpecificationShoulder from '@/Components/Specifications/shoulder.vue';
import SpecificationWrist from '@/Components/Specifications/wrist.vue';
import ModalReviews from '@/Components/ModalWindows/ModalReviews.vue';
import ModalRequest from '@/Components/ModalWindows/ModalRequest.vue';


export default {
    components: {
        ModalReviews,
        ModalRequest,
        ProductSpecification,
        SpecificationFoot,
        SpecificationHip,
        SpecificationForearm,
        SpecificationKnee,
        SpecificationShoulder,
        SpecificationWrist
    },

    props: ['product'],

    mounted() {
        this.loadData();
    },
    computed: {
        ratingPercentages() {
            const totalReviews = this.reviews.length;
            const ratingCounts = {
                5: 0,
                4: 0,
                3: 0,
                2: 0,
                1: 0
            };
            // Подсчитываем количество отзывов для каждой категории рейтинга
            this.reviews.forEach(review => {
                ratingCounts[review.rate]++;
            });
            // Вычисляем процент для каждой категории рейтинга
            const percentages = {};
            for (let rating in ratingCounts) {
                percentages[rating] = (ratingCounts[rating] / totalReviews) * 100;
            }
            return percentages;
        },
        averageRating() {
            if (this.reviews.length === 0) {
                return 0;
            }

            const totalRatings = this.reviews.reduce((sum, review) => sum + review.rate, 0);
            const average = totalRatings / this.reviews.length;

            // Округляем среднюю оценку до 1 десятичного знака
            return Math.round(average * 10) / 10;
        },

    },
    setup(props) {
        const rememberedProps = useRemember(props); // Сохранение значения пропса
        return {
            product: rememberedProps.product,
        };
    },
    data() {
        return {
            isReviewsModalOpen: false,
            isRequestModalOpen: false,
            hasPurchased: false,
            count: 1,
            specification: {},
            rate: null,
            reviews: [],
            users: [],
            productId: 0,
            hasReview: false,
            isBlocked: false,
            user_id: null,
            user_review: null,
            side: 'L',
            activeTab: 'productDescription',
            creator: {},
        }
    },

    methods: {
        openReviewsModal(productId) {
            this.productId = productId;
            this.isReviewsModalOpen = true;
        },
        openRequestModal() {
            this.isRequestModalOpen = true;
        },
        closeModal() {
            this.isReviewsModalOpen = false;
            this.isRequestModalOpen = false;
        },
        AddToCart(id) {
            axios.post('add-to-cart', { id: id, count: this.count, side: this.side });
        },
        AddToWishList(id) {
            axios.post('add-to-wishlist', { id: id });
        },

        loadData() {
            this.loadReviews();
            this.checkIsPurchased();
            this.getCreatorInfo();
            const specifiableType = this.$page.props.product.specifiable_type;

            axios.get('/products/specification/' + specifiableType + '/id/' + this.$page.props.product.specifiable_id)
                .then(response => {
                    this.specification = response.data;
                })
                .catch(error => {
                    console.error(error);
                });

        },
        getCreatorInfo() {
            axios.get('/get-creator-info/' + this.$page.props.product.creator_id)
                .then(response => {
                    this.creator = response.data;

                });
        },
        loadReviews() {
            axios.get('/reviews/' + this.$page.props.product.id)
                .then(response => {
                    this.reviews = response.data['reviews'];
                    this.users = response.data['users'];
                    this.user_id = response.data['user_id'];
                    this.user_review = this.reviews.find(review => review.user_id == this.user_id);
                    if (this.user_review) {
                        this.hasReview = true;
                    }
                    let user = this.users.find(user => user.id == this.user_id);
                    if (user.user_role == 2) {
                        this.isBlocked = true;
                    }
                })

        },

        checkIsPurchased() {
            axios.get('/has-purchased', { params: { product_id: this.$page.props.product.id } })
                .then((response) => {
                    this.hasPurchased = response.data.hasPurchased;
                });

        },
        getUserName(userId) {
            const user = this.users.find(user => user.id === userId);
            return user.name;
        },
        sendReview() {
            axios.post('/reviews/send', { product_id: this.$page.props.product.id, rate: this.rate, review: this.review });
            this.loadReviews();
        },
        deleteReview() {
            axios.delete('/reviews/delete/' + this.$page.props.product.id);
            window.location.reload();
        },

    }

};
</script>

<style>
.text-date {
    color: #000000;
    font-size: 14px;
    opacity: 0.7;
}

/* SLIDER */

#slide1:checked~#slides .inner {
    margin-left: 0
}

#slide2:checked~#slides .inner {
    margin-left: -100%
}

#slide3:checked~#slides .inner {
    margin-left: -200%
}

#slide4:checked~#slides .inner {
    margin-left: -300%
}

#slide5:checked~#slides .inner {
    margin-left: -400%
}

#container {
    width: 100%;
    overflow: hidden
}

article img {
    width: 100%;
    max-height: 50vh;
}

#slides .inner {
    width: 500%;
    line-height: 0
}

#slides article {
    width: 20%;
    float: left
}

#commands {
    margin: -25% 0 0 0;
    width: 100%;
    height: 50px;

}

#commands label {
    display: none;
    width: 80px;
    height: 80px;
    opacity: 0.5;

}

#commands label:hover {
    opacity: 0.8
}

#active {
    position: relative;
    z-index: 5;
    margin: 16% 0 0;
    text-align: center
}

#active label {
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    display: inline-block;
    width: 10px;
    height: 10px;
    background: #bbb
}

#active label:hover {
    background: #333;
    border-color: #777 !important
}

#slide1:checked~#commands label:nth-child(2),
#slide2:checked~#commands label:nth-child(3),
#slide3:checked~#commands label:nth-child(4),
#slide4:checked~#commands label:nth-child(5),
#slide5:checked~#commands label:nth-child(1) {
    background: url('https://0.s3.envato.com/files/84450220/img/next.png') no-repeat;
    float: right;
    margin: -100px 12px 0 0;
    cursor: pointer;
    display: block;
}

#slide1:checked~#commands label:nth-child(5),
#slide2:checked~#commands label:nth-child(1),
#slide3:checked~#commands label:nth-child(2),
#slide4:checked~#commands label:nth-child(3),
#slide5:checked~#commands label:nth-child(4) {
    background: url('https://0.s3.envato.com/files/84450220/img/previous.png') no-repeat;
    float: left;
    margin: -100px 0 0 -6px;
    display: block;
    cursor: pointer;
}

#slide1:checked~#active label:nth-child(1),
#slide2:checked~#active label:nth-child(2),
#slide3:checked~#active label:nth-child(3),
#slide4:checked~#active label:nth-child(4),
#slide5:checked~#active label:nth-child(5) {
    background: #000;
    opacity: 0.6;
    border-color: #fff !important;
    border: 2px solid #fff
}

#slides .inner {
    -webkit-transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000);
    -moz-transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000);
    -ms-transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000);
    -o-transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000);
    transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000);
    -webkit-transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000);
    -moz-transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000);
    -ms-transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000);
    -o-transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000);
    transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000)
}

/* SLIDER */

/* REVIEWS */
.star {
    cursor: pointer;
    margin: 0 5px;
}

.highlighted {
    color: gold;
}

#stars {
    font-size: 30px;
    margin: 10px 0;
}

.product-detailed-ratings-and-reviews hr {
    margin: 0 -24px;
}

.graph-star-rating-header .star-rating {
    font-size: 17px;
}

.rating-list {
    display: inline-flex;
    margin-bottom: 15px;
    width: 100%;
}

.rating-list-left {
    height: 16px;
    line-height: 29px;
    width: 10%;
}

.rating-list-center {
    width: 80%;
}

.rating-list-right {
    line-height: 29px;
    text-align: right;
    width: 10%;
}

.text-black {
    color: #000000;
}

.reviews-members .media .mr-3 {
    width: 56px;
    height: 56px;
    object-fit: cover;
}

.progress {
    background: #f2f4f8 none repeat scroll 0 0;
    border-radius: 30px;
    height: 30px;
}

/* REVIEWS */
.text-bold {
    font-weight: 800;
}

.main-img img {
    width: 100%;
}

.main-description .category {
    text-transform: uppercase;
    color: #0093c4;
}

.main-description .product-title {
    font-size: 2.5rem;
}

.new-price {
    font-size: 2rem;
}

.buttons .block {
    margin-right: 5px;
}

.quantity input {
    border-radius: 0;
    height: 40px;

}

.custom-btn {
    text-transform: capitalize;
    background-color: #0093c4;
    color: white;
    width: 150px;
    height: 40px;
    border-radius: 0;
}

.custom-btn:hover {
    background-color: #0093c4 !important;
    font-size: 18px;
    color: white !important;
}

.questions .icon i {
    font-size: 2rem;
}
</style>