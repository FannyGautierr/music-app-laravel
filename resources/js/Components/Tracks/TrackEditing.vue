<script setup>
const props = defineProps({
    Track: Object,
});

const name = ref('');
const artist = ref('');
const album = ref('');


function createTrack() {
//    Use my router Laravel
    axios.post('/track', {
        name: name.value,
        artist: artist.value,
        album: album.value,
    }).then(response => {
        console.log(response.data);
    }).catch(error => {
        console.error(error);
    });
}
</script>

<template>
    <div>
        <!-- A form to create a new Track -->
        <form>
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" v-model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="artist" class="block text-gray-700 text-sm font-bold mb-2">Artist</label>
                <input type="text" id="artist" name="artist" v-model="artist" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="album" class="block text-gray-700 text-sm font-bold mb-2">Album</label>
                <input type="text" id="album" name="album" v-model="album" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" @click="createTrack">Create Track</button>
            </div>
        </form>
    </div>
</template>
