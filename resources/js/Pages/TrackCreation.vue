<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    name: '',
    artist: '',
    album: '',
    cover: null,
    track: null
});

const errors = ref({});

function handleFileUpload(event) {
    console.log(event);
    form.cover = event.target.files[0];
}

function handleMusicUpload(event) {
    console.log(event.target.files[0]);
    form.track = event.target.files[0];
}

function createTrack() {
    form.post('/track', {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            errors.value = {};
        },
        onError: (e) => {
            errors.value = e;
        }
    });
}
</script>

<template>
    <AppLayout title="Tracks">
        <template #header>
            <div class="flex gap-4 items-end">
                <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                    All tracks
                </h2>
            </div>
        </template>
        <div>
            <form @submit.prevent="createTrack"  class="flex flex-col gap-4 p-8 m-auto w-fit bg-[#191919]  rounded-lg my-4">
                <div v-for="field in ['name', 'artist', 'album']" :key="field" class="mb-4">
                    <label :for="field" class="block text-gray-100 text-sm font-bold capitalize">{{ field }}</label>
                    <input
                        :type="text"
                        :id="field"
                        :name="field"
                        v-model="form[field]"
                        class="w-full rounded-lg bg-gray-100 text-gray-900"
                        :class="{ 'border-red-500': errors[field] }"
                    >
                    <p v-if="errors[field]" class="text-red-500 text-xs italic">{{ errors[field] }}</p>
                </div>

                <div v-for="fileField in ['cover', 'track']" :key="fileField" class="mb-4">
                    <label :for="fileField" class="block text-gray-100 text-sm font-bold capitalize">
                        {{ fileField === 'track' ? 'Sound Tracks' : fileField }}
                    </label>
                    <input
                        type="file"
                        :id="fileField"
                        :name="fileField"
                        :accept="fileField === 'cover' ? 'image/png, image/jpeg' : '.mp3, .wav'"
                        @change="fileField === 'cover' ? handleFileUpload($event) : handleMusicUpload($event)"
                        class="w-full rounded-lg p-4 text-gray-900"
                        :class="{ 'border-red-500': errors[fileField] }"
                        :required="fileField === 'track'"
                    >
                    <p v-if="errors[fileField]" class="text-red-500 text-xs italic">{{ errors[fileField] }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <PrimaryButton type="submit" :disabled="form.processing">Create Track</PrimaryButton>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
