<template>
    <div>
      
      <ul>
        <li v-for="item in specification" >
          {{ item }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: ['specification'],

  };
  </script>