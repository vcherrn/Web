<template>

  <button class="open-button"  @click="openForm()">Узнайте, что Вам нужно</button>
  
  <div class="chat-popup" :style="{ display: formDisplay }" id="myForm">
    <form  class="form-container">
      <h1 class="form-title">Ответьте на пару простых вопросов и экспертная система подберет тип протеза, который подходит Вам больше всего</h1>

      <div>
        <div id="app">
          <div v-if="!endSearch">
            <h2 class="question">{{ currentQuestion }}</h2>
            <ul>
              <li v-for="(answer, index) in currentAnswers" :key="index">
                <button class="btn" @click.prevent="selectAnswer(index)">{{ answer }}</button>
              </li>
            </ul>
          </div>
          <div v-else>
            <p class="result">Наиболее подходящим типом протеза для ваших потребностей является: {{ protosthesType }}</p>
            <p class="description">{{ description }}</p>
            <button class="btn" @click="goBack">Повтор</button>
          </div>
        </div>
      </div>

      <button type="button" class="btn cancel" @click="closeForm()">Закрыть</button>
    </form>
  </div>
</template>

<script>
import jsonData from '../../../../public/storage/rules.json';
export default {
  data() {
    return {
      currentState: 0,
      endSearch: false,
      countAnswers: 0,
      protosthesType: '',
      description: '',
      formDisplay: 'none',
      transitions: [
        [0, 1, 0],
        [0, 2, 0],
        [1, 11, 0],
        [11, 28, 0],
        [28, 32, 0],
        [32, 34, 1],
        [32, 35, 1],
        [32, 36, 1],
        [28, 33, 1],
        [11, 29, 0],
        [29, 30, 1],
        [29, 31, 1],
        [1, 12, 0],
        [12, 21, 0],
        [21, 26, 1],
        [21, 27, 1],
        [12, 22, 0],
        [22, 23, 1],
        [22, 24, 1],
        [22, 25, 1],
        [1, 13, 0],
        [13, 17, 0],
        [17, 18, 1],
        [17, 19, 1],
        [17, 20, 1],
        [13, 14, 0],
        [14, 15, 1],
        [14, 16, 1],
        [2, 3, 1],
        [2, 4, 0],
        [4, 5, 0],
        [5, 9, 1],
        [5, 10, 1],
        [4, 6, 0],
        [6, 7, 1],
        [6, 8, 1],
      ],
      userAnswers: {},
    };
  },
  computed: {
    currentQuestion() {
      return this.getQuestion(this.currentState);
    },
    currentAnswers() {
      return this.getAnswers(this.currentState);
    },
  
  },
  methods: {
    openForm() {
      this.formDisplay = 'block';
    },

    closeForm() {
      this.formDisplay = 'none';
    },

    getQuestion(state) {
      const questions = {
        0: "Какой образ жизни вы хотите вести с новым протезом?",
        1: "Каким родом деятельности Вы хотите заниматься?",
        2: "Что для Вас важнее: только внешний вид или функциональность?",
        4: "Для какой конечности подбирается протез? ",
        5: "Каковы Ваши предпочтения в выборе?",
        6: "Каковы Ваши предпочтения в выборе?",
        11: "Для какого типа конечности подбирается протез?",
        12: "Для какого типа конечности подбирается протез?",
        13: "Для какого типа конечности подбирается протез?",
        14: "Каковы Ваши предпочтения в выборе протеза?",
        17: "Каковы Ваши предпочтения в выборе протеза?",
        21: "Каковы Ваши предпочтения в выборе протеза?",
        22: "Для чего именно Вам нужен протез?",
        28: "Каковы Ваши предпочтения в выборе протеза?",
        29: "Каковы Ваши предпочтения в выборе протеза?",
        32: "Назовите, для какой цели Вы выбираете протез?",
      };
      return questions[state];
    },
    getAnswers(state) {
      const answers = {
        0: ["Активный образ жизни", "Малоподвижный образ жизни"],
        1: ["Работа", "Спорт", "Реабилитация"],
        2: ["Внешний вид", "Функциональность"],
        4: ["Верхняя", "Нижняя"],
        5: ["протез должен быть универсальным с возможностью смены отдельных компонентов",
          "протез позволяет выполнять действия, максимально приближенные к действиям обычной конечности"],
        6: ["обеспечить опору, подвижность и функциональность, позволяя совершать различные движения, включая ходьбу, подъем по лестнице",
          "имитировать натуральные движения и обеспечивать более точное управление протезом, используя микропроцессоры"],
        11: ["Верхняя", "Нижняя"],
        28: ["протез универсальный с возможностью смены отдельных компонентов",
          "протез позволяет выполнять действия, максимально приближенные к действиям обычной конечности"],
        32: ["простой и прочный протез для захвата и удержания предметов",
          "перенос нетяжелых грузов и ряд других важных бытовых и профессиональных действий",
          "взятие и перенос предметов с более точным и естественным контролем над протезом, но меньшей прочностью"],
        29: ["обеспечить опору, подвижность и функциональность, позволяя совершать различные движения, включая ходьбу, подъем по лестнице",
          "имитировать натуральные движения и обеспечивать более точное управление протезом, используя микропроцессоры"],
        12: ["Верхняя", "Нижняя"],
        21: ["протез способен выполнять базовые функции конечности, в нем нет электрики, а только трос и пружина",
          "имитировать натуральные движения и обеспечивать более точное управление протезом, используя микропроцессоры"],
        22: ["пробежки/быстрая ходьба", "плавание", "скалолазание"],
        13: ["Верхняя", "Нижняя"],
        17: ["протез способен выполнять базовые функции конечности, в нем нет электрики, а только трос и пружина",
          "протез позволяет выполнять действия, максимально приближенные к действиям обычной конечности, используя микропроцессоры",
          "протез нужен лишь для того, чтобы скрыть недостатки в физиологии"],
        14: ["обеспечить опору, подвижность и функциональность, позволяя совершать различные движения, включая ходьбу, подъем по лестнице",
          "имитировать натуральные движения и обеспечивать более точное управление протезом, используя микропроцессоры"],

      };
      return answers[state];
    },
    selectAnswer(answerIndex) {

      this.userAnswers[this.countAnswers] = this.getAnswers(this.currentState)[answerIndex];

      const currentTransitions = this.transitions.filter(
        (transition) => transition[0] == this.currentState
      );

      if (currentTransitions.length > 0) {
        const selectedTransition = currentTransitions[answerIndex];
        if (selectedTransition) {
          this.currentState = selectedTransition[1];
        }
      }
      this.countAnswers += 1;

      if (currentTransitions[answerIndex][2] == 1) {
        this.showResult();
      }

    },
    showResult() {
      const userAnswers = this.userAnswers;
      const matchingRules = jsonData.rules.filter((rule, index) => {
        const { life_activity, type_of_activity, type_of_limb, preferences, features, type } = rule;
        const answer = userAnswers;

        return (
          life_activity == answer[0] &&
          type_of_activity == answer[1] &&
          (answer[2] ? type_of_limb == answer[2] : type_of_limb == "") &&
          (answer[3] ? preferences == answer[3] : preferences == "") &&
          (answer[4] ? features == answer[4] : features == "")

        );
      });

      matchingRules.forEach((rule) => {
        this.protosthesType = rule.type;
        this.description = rule.description;
      });
      this.endSearch = true;

    },
    goBack(){
      this.endSearch = false;
      this.currentState = 0;
      this.userAnswers = {};
      this.countAnswers = 0;
    }

  }
};
</script>
<style scoped>
.form-title {
  text-align: center;
  border-radius: 20px 10px 5px 0;
  color: aliceblue;
  height: 100%;
  background-color: #4b8ae9;
  width: 100%;
  margin-top: 0;
}

.question {
  font-size: 18px;
  margin: 30px 10px;
}
.open-button {
  background-color: #76bdd3;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 100px;
  border-radius: 50px;
}

.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  /* border: 3px solid #f1f1f1; */
  z-index: 9;
}

.form-container {
  max-width: 300px;
  min-width: 300px;
  /* padding: 10px; */
  background-color: white;
  min-height: 400px;
  display: flex;
  flex-direction: column;
  border-radius: 20px 10px 5px 0;
  border-top: 3px solid #93c2ff;
  border-left: 3px solid #6d9edd;
 text-align: center;
}

.form-container .btn {
  background-color: rgb(7, 87, 207);
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: calc(100% - 20px);
  margin: 0 10px;
  margin-bottom: 10px;
  opacity: 0.8;
}

.form-container .cancel {
  background-color: rgb(0, 0, 0);
  margin-top: auto;
}

.form-container .btn:hover,
.open-button:hover {
  opacity: 1;
}
.result {
  font-weight: bold;
  font-size: 20px;
  margin-bottom: 20px;
}

.description {
  margin-bottom: 20px;
  text-align: left;
  padding: 0 10px;
}

</style>