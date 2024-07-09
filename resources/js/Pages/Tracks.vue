<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TrackCreation from '@/Components/Tracks/TrackCreation.vue';
import { ref } from 'vue';

const showTrackCreation = ref(false);
const showTrackEdit = ref(false);
const tracks = ref([]);

function createTrack(){
    showTrackCreation.value = true;
}

</script>

<template>
    <AppLayout title="Tracks">
        <template #header>
            <div class="flex gap-4 items-end">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    All tracks
                </h2>
                <PrimaryButton @click="createTrack">Add new track</PrimaryButton>
            </div>
        </template>

        <TrackCreation v-if="showTrackCreation" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-4 items-center justify-start bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                    <a
                        v-for="track in $page.props.tracks" class="border border-zinc-200 p-2"
                        :key="track.uuid"
                        :href="route('track', track.uuid)"
                    >
                        <p class="text-2xl font-bold"><span>{{ track.name }}</span>  <span class="text-zinc-400 font-thin text-lg"> {{ track.album }}</span></p>
                        <p class="font-semibold text-blue-400">{{ track.artist }}</p>
                        <p>{{ track.playCount }}</p>
                    </a>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
