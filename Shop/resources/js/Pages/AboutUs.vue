<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="О нас" />
    <AuthenticatedLayout>
        <div class="py-12 class-bg">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <div class="p-6 text-gray-900">
                        <AboutUsViewer />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script>
 import AboutUsViewer from '@/Components/AboutUsViewer.vue'

export default {
    components: {
        AboutUsViewer
    }
}
</script>