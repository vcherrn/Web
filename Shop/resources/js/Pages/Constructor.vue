<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Конструктор" />
    <AuthenticatedLayout>
       
           
        <div class="class-bg">
            <div class=" ">
                <div class="">
                    <div class="">
                        <HumanConstructor/>
                    </div>
                </div>
            </div>
        </div>
      
    </AuthenticatedLayout>
</template>


<script>
 import HumanConstructor from '@/Components/HumanConstructor.vue'

export default {
components: {
    HumanConstructor
}
}
</script>

<style scoped>


.sidebar {
    color: #fff;
    width: 250px;
    padding-left: 20px;
    height: 100vh;
    background-image: linear-gradient(30deg, #0048bd, #44a7fd);
    border-top-right-radius: 80px;
   
}



/* Дополнительные стили для sidebar */
</style>