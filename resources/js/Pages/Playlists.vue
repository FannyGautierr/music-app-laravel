<script setup>
import  AppLayout  from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TrackCard from '@/Components/Tracks/TrackCard.vue';
import { usePage, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const showPlaylistCreation = ref(false);

function newPlaylist(){
    console.log('new playlist');
}

</script>
<template>
    <AppLayout title="Playlists">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Playlists
            </h2>
        </template>



        <div class="p-10 flex flex-col gap-4">
            <Link :href="route('createPlaylist')">
                <div class="bg-indigo-700 w-fit px-4 py-2 rounded-2xl">
                    New playlist
                    <span class="text-white">+</span>
                </div>
            </Link>
            <!-- <div v-if="showPlaylistCreation">
                <form @submit.prevent="newPlaylist" class="flex flex-col gap-4 p-8 m-auto w-fit bg-white rounded-lg my-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold capitalize">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="w-full rounded-lg"
                    />

                    <select name="track" id="track" class="w-full rounded-lg">
                        <option value="1">Track 1</option>
                        <option value="2">Track 2</option>
                        <option value="3">Track 3</option>
                    </select>
                </form>
            </div> -->
        <div class="grid grid-cols-3 gap-4">
            <div v-for="playlist in $page.props.playlists" class="flex flex-col gap-4 p-8 items-start w-full bg-[#191919] rounded-lg">
                <div class="flex gap-2 items-center">
                    <img :src="playlist.user.profile_photo_url" alt="playlist cover" class="w-4 h-4 rounded-full "/>
                    <p class="text-zinc-300">Created by : {{ playlist.user.name }} </p>
                </div>
                <p class="text-2xl font-semibold">{{ playlist.name }} <span class="text-zinc-500 text-sm">- {{ playlist.tracks_count }} songs </span>  </p>


                <div v-for="track in playlist.tracks" class="flex bg-[#0003] p-2 rounded-lg items-start gap-4 w-full">
                    <img  :src="`http://127.0.0.1:8000/storage/${track.cover}`" alt="track cover" class="w-20 h-20 object-cover"/>
                    <div>
                        <p class="font-bold text-lg">{{ track.name }}</p>
                        <p class="text-sm text-zinc-300">{{ track.artist }}</p>
                        <p>{{ track.co }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </AppLayout>
</template>
