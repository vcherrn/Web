<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-4 col-md-3">
        <form>
          <div class="well">
            <div class="row">
              <div class="col-sm-12">
                <div class="form__group field">
                  <input required="" placeholder="Name" class="form__field" type="input" v-model="productName"
                    @input="sortAndFilterProducts">
                  <label class="form__label" for="name">Название протеза</label>
                </div>
              </div>
            </div>
          </div>
        </form>

        <!-- PRICE -->
        <div class="card-conteiner">
          <div class="card-content">
            <div class="card-title"><span>Фильтр цен</span></div>
            <div class="values">
              <div><span id="first">0</span>
              </div> - <div><span id="second">3000000</span></div>
            </div>
            <div data-range="#third" data-value-1="#second" data-value-0="#first" class="slider">
              <label class="label-min-value">{{ minPrice }}</label>
              <label class="label-max-value">{{ maxPrice }}</label>
            </div>
            <div class="rangeslider">
              <input class="min input-ranges" name="range_1" type="range" min="{{ minPrice }}" max="3000000"
                v-model="minPrice">
              <input class="max input-ranges" name="range_1" type="range" min="{{ minPrice }}" max="3000000"
                v-model="maxPrice">
            </div>
          </div>
          <button  style="margin-left: 30px;" @click="sortAndFilterProducts()" class="btn btn-primary">
            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="Interface / Filter">
                <path id="Vector"
                  d="M20 5.6001C20 5.04005 19.9996 4.75981 19.8906 4.5459C19.7948 4.35774 19.6423 4.20487 19.4542 4.10899C19.2403 4 18.9597 4 18.3996 4H5.59961C5.03956 4 4.75981 4 4.5459 4.10899C4.35774 4.20487 4.20487 4.35774 4.10899 4.5459C4 4.75981 4 5.04005 4 5.6001V6.33736C4 6.58195 4 6.70433 4.02763 6.81942C4.05213 6.92146 4.09263 7.01893 4.14746 7.1084C4.20928 7.20928 4.29591 7.29591 4.46875 7.46875L9.53149 12.5315C9.70443 12.7044 9.79044 12.7904 9.85228 12.8914C9.90711 12.9808 9.94816 13.0786 9.97266 13.1807C10 13.2946 10 13.4155 10 13.6552V18.411C10 19.2682 10 19.6971 10.1805 19.9552C10.3382 20.1806 10.5814 20.331 10.8535 20.3712C11.1651 20.4172 11.5487 20.2257 12.3154 19.8424L13.1154 19.4424C13.4365 19.2819 13.5966 19.2013 13.7139 19.0815C13.8176 18.9756 13.897 18.8485 13.9453 18.7084C14 18.5499 14 18.37 14 18.011V13.6626C14 13.418 14 13.2958 14.0276 13.1807C14.0521 13.0786 14.0926 12.9808 14.1475 12.8914C14.2089 12.7911 14.2947 12.7053 14.4653 12.5347L14.4688 12.5315L19.5315 7.46875C19.7044 7.2958 19.7904 7.20932 19.8523 7.1084C19.9071 7.01893 19.9482 6.92146 19.9727 6.81942C20 6.70551 20 6.58444 20 6.3448V5.6001Z"
                  stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </g>
            </svg>
          </button>

          <button style="margin-left: 55px;" @click="clearSorting()" class="btn btn-primary">
            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="Interface / Filter_Off">
                <path id="Vector"
                  d="M13 4H18.4C18.9601 4 19.2409 4 19.4548 4.10899C19.6429 4.20487 19.7948 4.35774 19.8906 4.5459C19.9996 4.75981 20 5.04005 20 5.6001V6.3448C20 6.58444 20 6.70551 19.9727 6.81942C19.9482 6.92146 19.9072 7.01893 19.8524 7.1084C19.7906 7.20931 19.7043 7.2958 19.5314 7.46875L18 9.00012M7.49961 4H5.59961C5.03956 4 4.75981 4 4.5459 4.10899C4.35774 4.20487 4.20487 4.35774 4.10899 4.5459C4 4.75981 4 5.04005 4 5.6001V6.33736C4 6.58195 4 6.70433 4.02763 6.81942C4.05213 6.92146 4.09263 7.01893 4.14746 7.1084C4.20928 7.20928 4.29591 7.29591 4.46875 7.46875L9.53149 12.5315C9.70443 12.7044 9.79044 12.7904 9.85228 12.8914C9.90711 12.9808 9.94816 13.0786 9.97266 13.1807C10 13.2946 10 13.4155 10 13.6552V18.411C10 19.2682 10 19.6971 10.1805 19.9552C10.3382 20.1806 10.5814 20.331 10.8535 20.3712C11.1651 20.4172 11.5487 20.2257 12.3154 19.8424L13.1154 19.4424C13.4365 19.2819 13.5966 19.2013 13.7139 19.0815C13.8176 18.9756 13.897 18.8485 13.9453 18.7083C14 18.5499 14 18.37 14 18.011V13.6626C14 13.418 14 13.2958 14.0276 13.1807C14.0521 13.0786 14.0926 12.9809 14.1475 12.8915C14.2091 12.7909 14.2952 12.7048 14.4669 12.5331L14.4688 12.5314L15.5001 11.5001M15.5001 11.5001L5 1M15.5001 11.5001L19 15"
                  stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </g>
            </svg>
          </button>

        </div>
        <!-- PRICE -->

        <form class="shop__filter ">
          <h3 class="headline">
            <span>Категории</span>
          </h3>
          <div v-for="category in categories" class="checkbox">
            <input type="checkbox" :value="category.id" :id="'shop-filter-checkbox_' + category.id"
              v-model="selectedCategories" @change="sortAndFilterProducts">
            <label :for="'shop-filter-checkbox_' + category.id">{{ category.name }}</label>
          </div>

          <!-- Типы -->
          <h3 class="headline">
            <span>Тип</span>
          </h3>

          <div class="checkbox">
            <input type="checkbox" name="shop-filter__ch" id="shop-filter-check_1" value="Бионический"
              v-model="selectedTypes" @change="sortAndFilterProducts">
            <label for="shop-filter-check_1">Бионический</label>
          </div>
          <div class="checkbox">
            <input type="checkbox" name="shop-filter__ch" id="shop-filter-check_2" value="Механический"
              v-model="selectedTypes" @change="sortAndFilterProducts">
            <label for="shop-filter-check_2">Механический</label>
          </div>
          <div class="checkbox">
            <input type="checkbox" name="shop-filter__ch" id="shop-filter-check_3" value="Косметический"
              v-model="selectedTypes" @change="sortAndFilterProducts">
            <label for="shop-filter-check_3">Косметический</label>
          </div>



          <!-- Материалы -->
          <h3 class="headline">
            <span>Материал</span>
          </h3>
          <div class="radio">
            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_1" value="" checked=""
              v-model="selectedMaterial" @change="sortAndFilterProducts">
            <label for="shop-filter-radio_1">Все</label>
          </div>
          <div class="radio">
            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_2" value="Пластик"
              v-model="selectedMaterial" @change="sortAndFilterProducts">
            <label for="shop-filter-radio_2">Пластик</label>
          </div>
          <div class="radio">
            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_3" value="Титан"
              v-model="selectedMaterial" @change="sortAndFilterProducts">
            <label for="shop-filter-radio_3">Титан</label>
          </div>
          <div class="radio">
            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_4" value="Алюминий"
              v-model="selectedMaterial" @change="sortAndFilterProducts">
            <label for="shop-filter-radio_4">Алюминий</label>
          </div>
          <div class="radio">
            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_5" value="Карбон"
              v-model="selectedMaterial" @change="sortAndFilterProducts">
            <label for="shop-filter-radio_5">Карбон</label>
          </div>
        </form>
      </div>

      <div class="col-sm-8 col-md-9">
        <ul class="shop__sorting">
          <li :class="{ 'active': activeSorting == '-' }">
            <a @click="sortAndFilterProducts('-')" href="#">Без сортировки</a>
          </li>
          <li :class="{ 'active': activeSorting == 'ascending' }">
            <a @click="sortAndFilterProducts('ascending')" href="#">Цена (Сначала дешевые)</a>
          </li>
          <li :class="{ 'active': activeSorting == 'descending' }">
            <a @click="sortAndFilterProducts('descending')" href="#">Цена (Сначала дорогие)</a>
          </li>
        </ul>
        <div class="row">
          <div class="col-md-4 col-sm-6" v-for="product in displayedProducts" :key="product.id">

            <div class="product-grid8">
              <div class="product-image8">
                <a class="d-flex align-items-center" href="#">

                  <img class="pic-1" v-bind:src="'storage/' + JSON.parse(product.photos)[0]">

                </a>
                <ul class="social">
                  <li><a style="cursor: pointer" @click="View(product.id)" class="fa fa-search"></a></li>
                  <li><a style="cursor: pointer" @click="AddToWishList(product.id)" class="fa fa-heart"></a></li>
                </ul>
              </div>
              <div class="product-content">
                <div class="price">{{ product.name }}
                </div>
                <span class="product-shipping"> {{ getCategoryName(product.category_id) }} </span>
                <h3 class="title"><a href="#">{{ product.price }}p</a></h3>
                <a class="all-deals" type="submit" @click="View(product.id)">ПЕРЕЙТИ <i
                    class="fa fa-angle-right icon"></i></a>
              </div>

            </div>
          </div>
        </div>

        <div class="container">
          <div class="horizontal">
            <div class="verticals twelve">
              <div class="pagination pagination-style-three m-t-20 m-b-40">
                <ul class="pagination pull-right">
                  <li :class="{ disabled: currentPage == 1 }">
                    <a @click="goToPage(currentPage - 1)" href="#">«</a>
                  </li>
                  <li v-for="page in totalPages" :key="page" :class="{ active: currentPage == page }">
                    <a @click="goToPage(page)" href="#">{{ page }}</a>
                  </li>
                  <li :class="{ disabled: currentPage == totalPages }">
                    <a @click="goToPage(currentPage + 1)" href="#">»</a>
                  </li>
                </ul>
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
      minPrice: 0,
      maxPrice: 3000000,
      products: [],
      displayProducts: [],
      currentPage: 1,
      itemsPerPage: 6,
      categories: [],
      specifications: [],
      selectedCategories: [],
      selectedMaterial: [],
      selectedTypes: [],
      activeSorting: '-',
    }
  },
  mounted() {
    this.LoadProducts();
  },
  computed: {
    totalPages() {
      return Math.ceil(this.displayProducts.length / this.itemsPerPage);
    },
    displayedProducts() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.displayProducts.slice(startIndex, endIndex);
    },
  },
  watch: {
    minPrice() {
      this.updateLabelValues();
    },
    maxPrice() {
      this.updateLabelValues();
    }
  },
  methods: {
    sortAndFilterProducts(activeSorting) {
      let filteredProducts = this.products;

      // Применяем фильтр по категории
      if (this.selectedCategories.length > 0) {
        filteredProducts = filteredProducts.filter(product => this.selectedCategories.includes(product.category_id));
      }

      // Применяем фильтр по типу
      if (this.selectedTypes.length > 0) {
        console.log(this.specifications);
        let type = this.specifications.filter(detail => this.selectedTypes.includes(detail.product_type));
        filteredProducts = filteredProducts.filter(product => {
          let matchingMaterials = type.some(m => product.specifiable_type.includes(m.table_name) && m.id === product.specifiable_id);
          return matchingMaterials;
        });
      }

      // Применяем фильтр по материалу
      if (this.selectedMaterial && this.selectedMaterial.length > 0) {
        let material = this.specifications.filter(detail => this.selectedMaterial.includes(detail.material));
        filteredProducts = filteredProducts.filter(product => {
          let matchingMaterials = material.some(m => product.specifiable_type.includes(m.table_name) && m.id === product.specifiable_id);
          return matchingMaterials;
        });
      }

      // Применяем фильтр по названию
      if (this.productName) {
        filteredProducts = filteredProducts.filter(product => product.name.toLowerCase().includes(this.productName.toLowerCase()));
      }

      // Применяем фильтр по цене
      filteredProducts = filteredProducts.filter(product => product.price > this.minPrice && product.price < this.maxPrice);

      // Сортируем по возрастанию/убыванию
      if (activeSorting == 'ascending') {
        filteredProducts.sort((a, b) => a.price - b.price);
      } else if (activeSorting == 'descending') {
        filteredProducts.sort((a, b) => b.price - a.price);
      }
      else if (activeSorting == '-') {
        filteredProducts.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
      }
      this.activeSorting = activeSorting;

      this.displayProducts = filteredProducts;
      this.currentPage = 1;
    },

    getCategoryName(categoryId) {
      const category = this.categories.find(category => category.id === categoryId);
      return category.name;
    },

    updateLabelValues() {

      const firstSpan = this.$el.querySelector('#first');
      const secondSpan = this.$el.querySelector('#second');
      const labelMinValue = this.$el.querySelector('.label-min-value');
      const labelMaxValue = this.$el.querySelector('.label-max-value');

      firstSpan.textContent = this.minPrice;
      secondSpan.textContent = this.maxPrice;
      labelMinValue.textContent = this.minPrice;
      labelMaxValue.textContent = this.maxPrice;
     
    },
    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },
    LoadProducts() {
      this.loadCategories();
      this.loadSpecifications();
      const selectedCategoryId = localStorage.getItem('selectedCategoryId');
      const selectedTypeId = localStorage.getItem('selectedTypeId');

      if (selectedCategoryId) {
        axios.get('products/prosthes-cat/' + selectedCategoryId).then(response => {
          this.products = response.data;
          this.displayProducts = this.products;
        });
        localStorage.removeItem('selectedCategoryId');
      } else if (selectedTypeId) {
        axios.get('products/prosthes-typ/' + selectedTypeId).then(response => {
          this.products = response.data;
          this.displayProducts = this.products;
        });
        localStorage.removeItem('selectedTypeId');
      } else {
        axios.get('products').then(response => {
          this.products = response.data;
          console.log(this.products);
          this.displayProducts = this.products;
        });
      }
      this.activeSorting = '-';

    },
    View(id) {
      this.$inertia.visit('products/' + id);
    },

    loadCategories() {
      axios.get('/get-categories').then(response => {
        this.categories = response.data;

      });
    },
    loadSpecifications() {
      axios.get('/get-characteristics').then(response => {
        this.specifications = response.data;
      });
    },
    AddToWishList(id) {
      axios.post('products/add-to-wishlist', { id: id });
    },
    clearSorting(){
      this.selectedCategories = [];
      this.selectedMaterial = [];
      this.productName = '';
      this.selectedTypes = [];
      this.displayProducts = this.products;
      this.minPrice = 0;
      this.maxPrice = 3000000;
      this.currentPage = 1;
    }


  }
}
</script>

<style scoped>
/* SHOP SORTING */
.shop__sorting {
  list-style: none;
  padding-left: 0;
  margin-bottom: 40px;
  margin-top: -20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  text-align: right;
}

.shop__sorting>li {
  display: inline-block;
}

.shop__sorting>li>a {
  display: block;
  padding: 20px 10px;
  margin-bottom: -1px;
  border-bottom: 2px solid transparent;
  color: #757575;
  -webkit-transition: all .05s linear;
  -o-transition: all .05s linear;
  transition: all .05s linear;
}

.shop__sorting>li>a:hover,
.shop__sorting>li>a:focus {
  color: #333333;
  text-decoration: none;
}

.shop__sorting>li.active>a {
  color: #209ecf;
  border-bottom-color: #209ecf;
}

@media (max-width: 767px) {
  .shop__sorting {
    text-align: left;
    border-bottom: 0;
  }

  .shop__sorting>li {
    display: block;
  }

  .shop__sorting>li>a {
    padding: 10px 15px;
    margin-bottom: 10px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  }

  .shop__sorting>li.active>a {
    font-weight: 600;
  }
}

/* SHOP SORTING */

/* PAGINATION */
/* h1 {
  text-align: center;
  margin-top: 30px;
  margin-bottom: 50px;
} */

.pagination-style-three {
  display: flex;
  justify-content: flex-end;
}

.pagination-style-three a {
  padding: 5px 15px;
  background: #ffffff;
  color: #000000;
  border-radius: 25px;
  box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, .1);

}

.pagination li {
  display: inline-block;
  margin-left: 5px;
}

.pagination li.active a {
  background-color: #007bff;
  color: #fff;
}

.pagination li.disabled a {
  pointer-events: none;
  opacity: 0.6;
}

.pagination-style-three a.selected,
.pagination-style-three a:hover,
.pagination-style-three a:active,
.pagination-style-three a:focus {
  background: #9fe9ff;
}
/* PAGINATION */

.card-conteiner {
  cursor: default;
  --color-primary: #275efe;
  --color-headline: #3f4656;
  --color-text: #99a3ba;
}

.card-content .card-title {
  font-family: inherit;
  font-size: 32px;
  font-weight: 700;
  margin: 0 0 10px 0;
}

.card-content .card-title span {
  font-weight: 500;
}

.card-content .values div,
.card-content .current-range div {
  display: inline-block;
  vertical-align: top;
}

.card-content .values {
  margin: 0;
  font-weight: 500;
  color: var(--color-primary);
}

.card-content .values>div:first-child {
  margin-right: 2px;
}

.card-content .values>div:last-child {
  margin-left: 2px;
}

.card-content .current-range {
  display: block;
  color: var(--color-text);
  margin-top: 8px;
  font-size: 14px;
}

.card-content .slider {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
  font-size: .6em;
  color: var(--color-text);
}

.input-ranges[type='range'] {
  width: 210px;
  height: 30px;
  overflow: hidden;
  outline: none;
}

.input-ranges[type='range'],
.input-ranges[type='range']::-webkit-slider-runnable-track,
.input-ranges[type='range']::-webkit-slider-thumb {
  -webkit-appearance: none;
  background: none;
}

.input-ranges[type='range']::-webkit-slider-runnable-track {
  width: 200px;
  height: 1px;
  background: var(--color-headline);
}


.input-ranges[type='range']::-webkit-slider-thumb {
  position: relative;
  height: 15px;
  width: 15px;
  margin-top: -7px;
  background: #fff;
  border: 1px solid var(--color-headline);
  border-radius: 25px;
  cursor: pointer;
  z-index: 1;
  transition: .5s;
  -webkit-transition: .5s;
  -moz-transition: .5s;
  -ms-transition: .5s;
  -o-transition: .5s;
}

.input-ranges[type='range']::-webkit-slider-thumb:hover {
  background: #eaefff;
  border: 1px solid var(--color-primary);
  outline: .5px solid var(--color-primary);
}

.input-ranges[type='range']::-webkit-slider-thumb:active {
  cursor: grabbing;
}

.input-ranges[type='range']:nth-child(1)::-webkit-slider-thumb {
  z-index: 2;
}

.rangeslider {
  font-family: sans-serif;
  font-size: 14px;
  position: relative;
  height: 20px;
  width: 210px;
  display: inline-block;
  margin-top: -5px;
}

.rangeslider input {
  position: absolute;
}

.rangeslider span {
  position: absolute;
  margin-top: 20px;
  left: 0;
}

.rangeslider .right {
  position: relative;
  float: right;
  margin-right: -5px;
}

/* Price  */
.form__group {
  position: relative;
  padding: 20px 0 0;
  width: 100%;
  max-width: 180px;
}

.form__field {
  font-family: inherit;
  width: 100%;
  border: none;
  border-bottom: 2px solid #6b6b6b;
  outline: 0;
  font-size: 17px;
  color: #0c0c0c;
  padding: 7px 0;
  background: transparent;
  transition: border-color 0.2s;
}

.form__field::placeholder {
  color: transparent;
}

.form__field:placeholder-shown~.form__label {
  font-size: 17px;
  cursor: text;
  top: 20px;
}

.form__label {
  position: absolute;
  top: 0;
  display: block;
  transition: 0.2s;
  font-size: 17px;
  color: #3ca0f1;
  pointer-events: none;
}

.form__field:focus {
  padding-bottom: 6px;
  font-weight: 700;
  border-width: 3px;
  border-image: linear-gradient(to right, #49acee, #eee6fa);
  border-image-slice: 1;
}

.form__field:focus~.form__label {
  position: absolute;
  top: 0;
  display: block;
  transition: 0.2s;
  font-size: 17px;
  color: #100a5f;
  font-weight: 700;
}

.form__field:required,
.form__field:invalid {
  box-shadow: none;
}

/** Shop: Filter **/
.shop__filter {
  margin-bottom: 40px;
}



/* Checkboxes */

.checkbox input[type="checkbox"] {
  display: none;
}

.checkbox label {
  padding-left: 0;
}

.checkbox label:before {
  content: "";
  display: inline-block;
  vertical-align: middle;
  margin-right: 15px;
  width: 20px;
  height: 20px;
  line-height: 20px;
  background-color: #eee;
  cursor: pointer;
  text-align: center;
  font-family: "FontAwesome";
}

.checkbox input[type="checkbox"]:checked+label::before {
  content: "\f00c";
}

/* Radios */
.radio input[type="radio"] {
  display: none;
}

.radio label {
  padding-left: 0;
}

.radio label:before {
  content: "";
  display: inline-block;
  vertical-align: middle;
  margin-right: 15px;
  width: 20px;
  height: 20px;
  cursor: pointer;
  border-radius: 50%;
  border: 10px solid #eee;
  background-color: #333333;
}

.radio input[type="radio"]:checked+label:before {
  border-width: 7px;
}

/* Shop */
.product-grid8 {
  font-family: Poppins, sans-serif;
  position: relative;
  z-index: 1
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
  height: auto;

}

.product-grid8 .pic-1 {
  opacity: 1;
  transition: all .5s ease-out 0s;
  object-fit: cover;
  min-height: 250px;

}


.product-grid8:hover .pic-1 {
  filter: brightness(40%)
}

.product-grid8 .pic-2 {
  opacity: 0;
  position: absolute;
  top: 0;
  left: 0;
  transition: all .5s ease-out 0s
}

.product-grid8:hover .pic-2 {
  opacity: 1
}

.product-grid8 .social {
  padding: 0;
  margin: 0;
  list-style: none;
  position: absolute;
  bottom: 13px;
  right: 13px;
  z-index: 1;

}

.product-grid8 .social li {
  opacity: 0;
  transform: translateY(3px);
  transition: all .5s ease 0s
}

.product-grid8:hover .social li {
  margin: 0 0 10px;
  opacity: 1;
  color: #ffffff;
  transform: translateY(0)
}


.product-grid8 .social li a {
  color: rgb(255, 255, 255);
  font-size: 17px;
  line-height: 40px;
  text-align: center;
  height: 40px;
  width: 40px;
  border: 1px solid grey;
  display: block;
  transition: all .5s ease-in-out
}

.product-grid8 .social li a:hover {
  color: #4d7cd3;
  border-color: #fafafa
}


.product-grid8 .product-content {
  padding: 20px 0 0
}

.product-grid8 .price {
  color: #000;
  font-size: 19px;
  font-weight: 400;
  margin-bottom: 8px;
  text-align: left;
  transition: all .3s
}


.product-grid8 .product-shipping {
  color: rgba(0, 0, 0, .5);
  font-size: 15px;
  padding-left: 35px;
  margin: 0 0 15px;
  display: block;
  position: relative
}

.product-grid8 .product-shipping:before {
  content: '';
  height: 1px;
  width: 25px;
  background-color: rgba(0, 0, 0, .5);
  transform: translateY(-50%);
  position: absolute;
  top: 50%;
  left: 0
}

.product-grid8 .title {
  font-size: 16px;
  font-weight: 400;
  text-transform: capitalize;
  margin: 0 0 30px;
  transition: all .3s ease 0s
}

.product-grid8 .title a {
  color: #000
}

.product-grid8 .all-deals {
  display: block;
  color: #fff;
  background-color: #2e353b;
  font-size: 15px;
  letter-spacing: 1px;
  text-align: center;
  text-transform: uppercase;
  padding: 22px 5px;
  transition: all .5s ease 0s
}

.product-grid8 .all-deals .icon {
  margin-left: 7px
}

.product-grid8 .all-deals:hover {
  background-color: #0081c2
}

@media only screen and (max-width:990px) {
  .product-grid8 {
    margin-bottom: 30px
  }
}

.product-grid8 {
  height: 100%;
  margin-bottom: 50px;
}

.product-grid8 .product-image8 {
  height: 250px;
  overflow: hidden;
}

.product-grid8 .product-image8 img {
  width: 100%;
  height: auto;
}
</style>