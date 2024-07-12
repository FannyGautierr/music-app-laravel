<script setup>
import { defineProps, computed, ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    tracks: Array,
});


const initForm = () => useForm();
const isPlaying = ref(false);
const audio = new Audio('http://127.0.0.1:8000/storage/'+ props.tracks.file);
const emit = defineEmits(['play', 'pause','editTrack','deleteTrack']);

function manageAudio() {
    if(isPlaying.value) {
        console.log('Pausing audio');
        audio.pause();
        emit('pause');
        isPlaying.value = false;
        return;
    }else{
        console.log('Playing audio');
        audio.play();
        isPlaying.value = true;
        emit('play', audio);
    }
}
function editTrack(){
    // emit('editTrack', props.tracks);
}

function deleteTrack(){

    if (confirm('Are you sure you want to delete this track?')) {
        const form = initForm();
        form.delete(route('deleteTrack', props.tracks.uuid), {
            preserveScroll: true,
            preserveState: false,
        });
    }
}

</script>
<template>
    <Transition
        name="fade"
        enter-active-class="transition ease-out duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-200"
        leave-class="opacity-100"
        leave-to-class="opacity-0"

    >
    <a
        class="  text-white "
        :key="props.tracks.uuid"
        :href="route('track', props.tracks?.uuid)"
    >
        <div class="flex flex-row gap-4 border border-black bg-[#191919] shadow-xl rounded-2xl">
            <div class="w-1/3 h-fit">
                <img
                    v-if="props.tracks.cover.startsWith('http')"
                    loading="lazy"
                    src="https://images.unsplash.com/photo-1619983081563-430f63602796?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Track image"
                    class="w-full h-[150px] object-cover"
                >
                <!-- TODO : make a base path -->
                <img
                    v-else
                    loading="lazy"
                    :src="`http://127.0.0.1:8000/storage/${props.tracks.cover}`"
                    alt="Track image"
                    class="w-full h-[150px] object-cover"
                >

            </div>
            <div class="flex flex-col gap-2 w-2/3 p-2">
                <div >
                    <p class="text-2xl font-bold"><span>{{ props.tracks.name }}</span>  <span class="text-zinc-400 font-thin text-lg"> {{ tracks.album }}</span></p>
                    <p class="font-semibold text-blue-400">{{ props.tracks.artist }}</p>
                    <div class="flex gap-2 items-end">
                    <i @click.stop.prevent="manageAudio" :class="!isPlaying ? 'pi pi-play-circle': 'pi pi-pause-circle' " class="h-5 w-5"/>
                    <p><span class="text-zinc-400 text-sm">Played </span>{{ props.tracks.playCount }} <span class="text-zinc-400 text-sm">times</span></p>
                    </div>
                </div>
                <div class="place-self-end flex gap-2">
                    <Link :href="route('editTrack', props.tracks.uuid)">
                            <div class="pi pi-pen-to-square" />
                    </Link>
                    <Link :href="route('deleteTrack', props.tracks.uuid)" method="delete">
                        <button class="pi pi-trash" />
                    </Link>

                    <!-- <button class="pi pi-trash" /> -->
                </div>
            </div>

        </div>
    </a>
    </Transition>
</template>
