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

function copyToClipBoard(key){
    navigator.clipboard.writeText(key)
}

</script>
<template>
    <AppLayout title="Create API Key">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                Mes clés API
            </h2>
        </template>

        <div class="py-12 flex flex-col gap-4">
            <div v-for="key in $page.props.apiKeys" class="flex flex-row justify-between gap-2 items-center bg-[#191919] p-2 rounded-lg m-auto w-1/2">
                <div class="flex gap-2 items-center">
                    <p class="text-white text-lg font-bold">{{ key.name }}</p>
                    <p class="">{{ key.key }}</p>
                </div>
                <div class="hover:cursor-pointer p-2">
                    <div class="pi pi-clipboard " @click="copyToClipBoard(key.key)"/>
                </div>
            </div>
            <div class="border border-dashed border-gray-400 flex flex-row justify-between gap-2 items-center bg-[#191919] p-2 rounded-lg m-auto w-1/2">
                <div class="pi pi-plus"/>
                <p class="whitespace-nowrap">Create a new key</p>
                <form @submit.prevent="createApiKey" class="flex items-center justify-center gap-4 p-8 m-auto w-fit bg-[#191919] rounded-lg my-4">

                        <input type="text" name="name" id="name" v-model="form.name" class="w-full rounded-lg bg-gray-100 text-gray-900" placeholder="Choose a name ">
                 
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded-lg">Create</button>
                </form>
            </div>

            <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            </div> -->
        </div>
    </AppLayout>

</template>
