<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Корзина" />
    <AuthenticatedLayout>
        <div class="py-12 class-bg">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <div class="p-6 text-gray-900">
                        <CartViewer />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script>
 import CartViewer from '@/Components/CartViewer.vue'

export default {
    components: {
        CartViewer
    }
}
</script>