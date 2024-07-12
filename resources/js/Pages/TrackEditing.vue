<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    track: Object
});

const errors = ref({});

function editTrack() {
    form.put(`track/${props.track.uuid}`, {
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
    <AppLayout title="Edit track">
        <template #header>
            <div class="flex gap-4 items-end">
                <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                    Edit track
                </h2>
            </div>
        </template>
    <div>
        <form @submit.prevent="editTrack" class="flex flex-col gap-4 p-8 m-auto w-fit bg-[#191919] rounded-lg my-4">
            <div v-for="field in ['name', 'artist', 'album']" :key="field" class="mb-4">
                <label :for="field" class="block text-gray-100 text-sm font-bold capitalize">{{ field }}</label>
                <input
                    :type="text"
                    :id="field"
                    :name="field"
                    v-model="$page.props.track[field]"
                    class="w-full rounded-lg text-black"
                    :class="{ 'border-red-500': errors[field] }"
                >
                <p v-if="errors[field]" class="text-red-500 text-xs italic">{{ errors[field] }}</p>
            </div>

            <!-- <div v-for="fileField in ['cover', 'track']" :key="fileField" class="mb-4">
                <label :for="fileField" class="block text-gray-700 text-sm font-bold capitalize">
                    {{ fileField === 'track' ? 'Sound Tracks' : fileField }}
                </label>
                <input
                    type="file"
                    :id="fileField"
                    :name="fileField"
                    :accept="fileField === 'cover' ? 'image/png, image/jpeg' : '.mp3, .wav'"
                    @change="fileField === 'cover' ? handleFileUpload($event) : handleMusicUpload($event)"
                    class="w-full rounded-lg p-4"
                    :class="{ 'border-red-500': errors[fileField] }"
                    :required="fileField === 'track'"
                >
                <p v-if="errors[fileField]" class="text-red-500 text-xs italic">{{ errors[fileField] }}</p>
            </div> -->

            {{ $page.props.track}}
            <div class="flex items-center justify-between">
                <Link :href="route('updateTrack',$page.props.track,$uuid = $page.props.track.uuid )" method="put" >
                Coucou
                </Link>
            </div>
        </form>
    </div>
</AppLayout>
</template>
