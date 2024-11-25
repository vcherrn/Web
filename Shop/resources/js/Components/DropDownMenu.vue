<template>
    <div class="dropdown" @mouseover="isOpen = true" @mouseleave="isOpen = false">
      <button class="dropdown-toggle" type="button" @click="isOpen = !isOpen">
        Протезы
      </button>
      <ul class="dropdown-menu" v-show="isOpen">
        <li><a href="#">Спецификация 1</a></li>
        <li><a href="#">Спецификация 2</a></li>
        <li><a href="#">Спецификация 3</a></li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        isOpen: false
      };
    }
  };
  </script>
  
  <style>
  .dropdown .dropdown-toggle {
    /* Стилизуйте кнопку ваших потребностей */
  }
  
  .dropdown-menu {
    /* Стилизуйте выпадающее меню ваших потребностей */
  }
  </style>