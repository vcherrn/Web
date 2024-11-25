<template>
  <div>
    <div v-if="isOpen" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeModal">&times;</span>

        <div v-for="rev in reviews" class="reviews-members pt-4 pb-4">
          <div class="media">

            <div class="media-body">
              <div class="reviews-members-header">
                <span class="star-rating float-right">
                  <span class="star-rating" id="stars">
                    <span class="star" v-for="star in 5" :key="star" :class="{ 'highlighted': star <= rev.rate }"
                      @click="setRate(star)">
                      ★
                    </span>
                  </span>
                </span>
                <h6 class="mb-1"><a class="text-black" href="#"><b> {{ getUserName(rev.user_id)
                      }} </b></a></h6>
                <p class="text-date">
                  {{ new Date(rev.created_at * 1000).getDate() }}-
                  {{ new Date(rev.created_at * 1000).getMonth() + 1 }}-
                  {{ new Date(rev.created_at * 1000).getFullYear() }}
                </p>
              </div>
              <div class="reviews-members-body">
                <p> {{ rev.m_text }} </p>
              </div>
              <div class="reviews-members-footer">

              </div>
            </div>
          </div>
          <hr>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      reviews: {},
      rate: null,
    }
  },
  props: {
    isOpen: {
      type: Boolean,
      required: true,
    },
    productId: {
      type: Number,
      required: true,
    },
    users: {
      type: Array,
      required: true,
    }

  },
  mounted() {
    console.log(this.productId);

  },
  methods: {
    loadReviews() {
      axios.get('/reviews/' + this.productId)
        .then(response => {
          this.reviews = response.data['reviews'];
        })
    },
    closeModal() {
      this.$emit('close');
    },
    getUserName(userId) {
      const user = this.users.find(user => user.id === userId);
      return user.name;
    },
    setRate(star) {
      this.rate = star;
    },
  },
  watch: {
    isOpen() {
      this.loadReviews();
    },
  },
};
</script>

<style scoped>
.text-date {
    color: #000000;
    font-size: 14px;
    opacity: 0.7;
}
.modal {
  display: block;


  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;


  margin: 6% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

.close {
  color: #aaa;
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>