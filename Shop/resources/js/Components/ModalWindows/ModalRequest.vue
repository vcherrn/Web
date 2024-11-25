<template>
    <div v-if="isOpen" class="modal">
        <div class="container">


            <div class="content">

                <div class="close-container">
                    <span class="close" @click="closeModal">&times;</span>
                </div>

                <div class="left-side">
                    <div class="address details">
                        <i class="fas fa-map-marker-alt"></i>

                        <div class="topic">Адрес</div>
                        <div class="text-one">г. Донецк</div>
                        <div class="text-two">ул наб., 1</div>
                    </div>
                    <div class="phone details">
                        <i class="fas fa-phone-alt"></i>
                        <div class="topic">Телефон</div>
                        <div class="text-one">8-800-000-00-00</div>
                        <div class="text-two">8-900-000-00-00</div>
                    </div>
                    <div class="email details">
                        
                        <div class="topic">Email</div>
                        <div class="text-one">support@site.com</div>
                        <div class="text-two">admin@site.com</div>
                    </div>
                </div>

                <div class="right-side">
                    <div class="tabs">
                        <div class="tab" :class="{ active: activeTab === 'tab1' }" @click="changeTab('tab1')">
                            Оставить заявку
                        </div>
                        <div class="tab" :class="{ active: activeTab === 'tab2' }" @click="changeTab('tab2')">
                            Заполнить анкету
                        </div>
                    </div>
                    <div v-if="activeTab === 'tab1'">
                        <div class="topic-text">Отправьте нам сообщение</div>

                        <p>
                            Если у вас есть какие-то вопросы или предложения по сотрудничеству -
                            заполните форму ниже
                        </p>

                        <form action="#">

                            <div class="input-row">
                                <div class="input-box">
                                    <input v-model="userRequest.surname" type="text" placeholder="Фамилия" />
                                </div>
                                <div class="input-box">
                                    <input v-model="userRequest.name" type="text" placeholder="Имя" />
                                </div>
                                <div class="input-box">
                                    <input v-model="userRequest.patronymic" type="text" placeholder="Отчество" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                               
                                <select v-model="userRequest.request_id" class="form-select border-0" style="height: 55px; margin-bottom: 10px;">
                                    <option  v-for="consultationType in consultationTypes" :value="consultationType.id">
                                        {{ consultationType.title }}
                                    </option>
                                </select>
                            </div>
                            <div class="input-box">
                                <input v-model="userRequest.country" type="text" placeholder="Страна" />
                            </div>
                            <div class="input-box">
                                <input v-model="userRequest.town" type="text" placeholder="Город" />
                            </div>
                            <div class="input-box">
                                <input v-model="userRequest.email" type="text" placeholder="Введите email" />
                            </div>
                            <div class="input-box">
                                <input v-model="userRequest.telephone_number" type="text" placeholder="Введите телефон" />
                            </div>
                            <div  class="input-box message-box">
                                <textarea  v-model="userRequest.message_text" placeholder="Сообщение"></textarea>
                            </div>

                            <div class="button">

                                <input @click="createRequest()" type="button" value="Отправить" />
                            </div>
                        </form>
                    </div>
                    <div v-if="activeTab === 'tab2'">
                        <p>
                            Информация о Вас, указанная в анкете, позволит нам давать
                            наиболее эффективные рекомендации по Вашему здоровью.
                        </p>
                        <form action="#">
                            <div class="input-box">
                                <input v-model="userCharacteristic.height"  type="text" placeholder="Рост" />
                            </div>
                            <div class="input-box">
                                <input v-model="userCharacteristic.weight" type="text" placeholder="Вес" />
                            </div>
                            <div class="input-box">
                                <input v-model="userCharacteristic.age" type="text" placeholder="Возраст" />
                            </div>
                            
                            <div class="input-box message-box">
                                <textarea v-model="userCharacteristic.details"  placeholder="Подробности травмы"></textarea>
                            </div>
                            <div class="button">

                                <input type="button" @click="saveCharacteristics()" value="Сохранить" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
           
            activeTab: 'tab1',
            consultationTypes: {},
            userCharacteristic: {},
            userRequest: {},
            charr:{},
        }
    },
    props: {
        isOpen: {
            type: Boolean,
            required: true,
        },

        users: {
            type: Array,
            required: true,
        }

    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData(){
            axios.get('/get-all-requests-types').then((response) => {
                this.consultationTypes = response.data;
                axios.get('/characteristic/').then((res) => {
                    this.userCharacteristic = res.data;
                });
            });
        },

        saveCharacteristics(){
            axios.post('/characteristic/store', this.userCharacteristic );
        },

        createRequest(){
            console.log(this.userRequest);
            axios.post('/request/store', this.userRequest );
        },
      
        changeTab(tab) {
            this.activeTab = tab;
        },
        closeModal() {
            this.$emit('close');
        },
       

    },
   
};
</script>

<style scoped>
.tabs {
    display: flex;
    margin-bottom: 20px;
}

.tab {
    padding: 10px;
    background-color: #f1f1f1;
    cursor: pointer;
}

.tab.active {
    background-color: #2387f8;
    color: #ffffff;

}

.input-row {
    display: flex;
    justify-content: space-between;
}

.input-row .input-box {
    width: calc(33.33% - 10px);
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

.close-container {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

.close {
    color: #3043ee;
    position: relative;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

input,
textarea {
    box-sizing: border-box;
}

.container {
    width: 100%;
    max-width: 1000px;
    padding: 0 20px;
}

.content {
    position: relative;
    margin-top: 50px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    padding: 40px;
    border-radius: 5px;
    box-shadow: 4px 4px 8px 0 rgba(34, 60, 80, 0.2);
}

.left-side {
    width: 25%;
    height: 100%;
    position: relative;
    display: flex;
    flex-direction: column;
}

.left-side::before {
    content: "";
    position: absolute;
    height: 70%;
    width: 2px;
    background: #afafb6;
    right: -15px;
    top: 50%;
    transform: translateY(-50%);
}

.right-side {
    width: 75%;
    margin-left: 75px;
}

.details {
    margin-bottom: 15px;
    text-align: center;
}

.topic {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 7px;
}

.text-one,
.text-two {
    font-size: 14px;
    color: #afafb6;
}

.topic-text {
    font-size: 23px;
    font-weight: 600;
    color: rgb(31, 163, 240);
    margin-bottom: 10px;
}

.right-side p {
    margin-bottom: 20px;
}

.input-box {
    height: 50px;
    width: 100%;
    margin-bottom: 20px;
}


.input-box input,
.input-box textarea {
    height: 100%;
    width: 100%;
    border: none;
    border-radius: 5px;
    background: #f1f1f1;
    padding: 0 20px;
}


.input-box textarea {
    resize: none;
    padding: 20px;
    font-family: "Roboto", sans-serif;
}

.message-box {
    min-height: 110px;
}

.button {
    display: inline-block;
}

.button input[type="button"] {
    color: #fff;
    font-size: 18px;
    background: #1e63e4;
    outline: none;
    border: none;
    padding: 10px 20px;
    border-radius: 7px;
    transition: 0.2s;
}

.button input[type="button"]:hover {
    background: rgb(0, 0, 207);
}

@media (max-width: 800px) {
    .content {
        height: 100%;
        flex-direction: column-reverse;
    }

    .left-side {
        margin-top: 50px;
        flex-direction: row;
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
    }

    .details {
        margin-right: 20px;
    }

    .details:last-child {
        margin-right: 0;
    }

    .left-side::before {
        display: none;
    }

    .right-side {
        width: 100%;
        margin-left: 0;
    }
}
</style>