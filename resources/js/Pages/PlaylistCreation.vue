<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';
import { usePage , router } from '@inertiajs/vue3';


const page = usePage();

const playlistForm = ref({
    name: '',
    tracks : []
});

const tracks = computed(() => {
    if(!autocomplete.value) return page.props.tracks;
    return page.props.tracks.filter(track =>
        track.name.toLowerCase().includes(autocomplete.value.toLowerCase() || track.artist.toLowerCase().includes(autocomplete.value.toLowerCase()))
    );
});

function addTrack(track) {
    const index = playlistForm.value.tracks.findIndex(t => t.id === track.id);
    if (index === -1) {
        playlistForm.value.tracks.push(track);
    } else {
        playlistForm.value.tracks.splice(index, 1);
    }
}

function storePlaylist(){
    // playlistForm.post('/playlist', {
    //     preserveState: true,
    //     preserveScroll: true,
    //     onSuccess: () => {
    //         playlistForm.reset();
    //         errors.value = {};
    //     },
    //     onError: (e) => {
    //         errors.value = e;
    //     }
    // });
    console.log(playlistForm);
    router.post('/playlist', {
        name: playlistForm.value.name,
        tracks: playlistForm.value.tracks.map(track => track.uuid)
    });

}

const autocomplete = ref('');
const selectedTrack = ref([]);
const autocompleteClicked = ref(false);
</script>
<template>
    <AppLayout title="Playlist Creation">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                Playlist Creation
            </h2>
        </template>
        {{ playlistForm }}
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <form @submit.prevent="storePlaylist()" class="flex flex-col gap-4 p-8 overflow-auto bg-[#191919] rounded-lg my-4">
                        <div v-for="field in ['name']" :key="field" class="mb-4">
                            <label :for="field" class="block text-gray-100 text-sm font-bold capitalize">{{ field }}</label>
                            {{ playlistForm[field] }}
                            <input
                                :type="text"
                                :id="field"
                                :name="field"
                                v-model="playlistForm[field]"
                                class="w-full rounded-lg bg-gray-100 text-gray-900"
                            >
                        </div>
                        <div v-if="$page.props.errors.name" class="text-red-500">
                            {{ $page.props.errors.name }}
                        </div>
                        <input
                            type="text"
                            name="autocomplete"
                            class="text-black w-full rounded-lg bg-gray-100 text-gray-900"
                            v-model="autocomplete"
                            @click="autocompleteClicked = !autocompleteClicked"
                        />
                        <Transition
                            name="fade"
                            enter-active-class="transition ease-out duration-100"
                            leave-active-class="transition ease-in duration-75"
                        >
                            <div class="text-white bg-black p-2 rounded-lg w-full h-2/3 mt-4 overflow-auto"
                            :class="autocompleteClicked ? 'block' : 'hidden'"
                            >
                                <p
                                    v-for="track in tracks"
                                    @click="addTrack(track)"
                                >
                                    {{ track.name }} - {{ track.artist }}
                                </p>
                            </div>

                        </Transition>

                        <button type="submit" class="w-full">Create Playlist</button>
                    </form>
                </div>
            </div>

    </AppLayout>
</template>
