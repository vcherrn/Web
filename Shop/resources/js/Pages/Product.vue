<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Продукт" />
    <AuthenticatedLayout>
        <div class="py-12 class-bg">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <div class="p-6 text-gray-900">
                        <ProductViewer :product="product" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script>
 import ProductViewer from '@/Components/ProductViewer.vue'

export default {
    components: {
        ProductViewer
    }
}
</script>