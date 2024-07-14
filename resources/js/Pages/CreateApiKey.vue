<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue';

const form = useForm({
  name: '',
})

const createApiKey = () => {
  form.post('/store-api-key', {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    }
  })
}
</script>
<template>
    <AppLayout title="Create API Key">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                Create API Key
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-[#191919]">
                        <form @submit.prevent="createApiKey">
                            <div class="mb-4">
                                <label for="name" class="block text-gray-200 text-sm font-bold mb-2">Name</label>
                                <input type="text" name="name" id="name" v-model="form.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            <button type="submit">Create Api Key</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>

</template>
