<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
// import TrackCreation from '@/Components/Tracks/TrackCreation.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, computed } from 'vue';
import TrackCard from '@/Components/Tracks/TrackCard.vue';
// import TrackEditing from '@/Components/Tracks/TrackEditing.vue';
import { usePage, Link } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const page = usePage();
const showTrackCreation = ref(false);
const showTrackEdit = ref(false);
const trackToEdit = ref(null);

const search = ref('');

function createTrack(){
    showTrackEdit.value = false;
    showTrackCreation.value = true;
}

const filteredTracks = computed(() => {
    if (!search.value) {
      return page.props.tracks
   }

  const lowercaseQuery = search.value.toLowerCase()
  return Object.fromEntries(
    Object.entries(page.props.tracks).filter(([id, track]) =>
      track.name.toLowerCase().includes(lowercaseQuery)
    )
  )
});
console.log(page.props.tracks);

function editTrack(track){
    showTrackCreation.value = false;
    showTrackEdit.value = true;
    trackToEdit.value = track;
}

function deleteTrack(uuid){
//    /track/{uuid}

}

</script>

<template>
    <AppLayout title="Tracks">
        <template #header>
            <div class="flex gap-4 items-end">
                <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                    All tracks
                </h2>
                <Link :href="route('createTrack')">Add new track</Link>
            </div>
        </template>

        <!-- <TrackCreation v-if="showTrackCreation" /> -->
        <!-- <TrackEditing
        v-if="showTrackEdit"
        :track="trackToEdit"
        /> -->
        <div class="flex flex-col py-12">

            <!-- <TextInput v-model="search" class="m-auto w-full">
                coucou
            </TextInput> -->
            <div class="relative px-20">
                <input
                    type="text"
                    v-model="search"
                    class="w-full rounded-lg pl-10 text-black "
                    placeholder="Search for a track"
                />
                <i class="pi pi-search absolute left-24 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Transition
                        name="fade"
                        enter-active-class="transition ease-out duration-300"
                        leave-active-class="transition ease-in duration-300"
                    >
                <div class="grid md:grid-cols-2 grid-cols-1 gap-4 items-center justify-start  overflow-hidden shadow-xl sm:rounded-lg p-4">

                    <TrackCard
                        v-for="track in filteredTracks"
                        :tracks="track"
                        @editTrack="editTrack"
                    />

                </div>
            </Transition>
            </div>
            <div v-if="$page.props.error"
            :class="{ 'text-red-500': $page.props.error }"
            >{{ $page.props.error }}</div>
        </div>

    </AppLayout>
</template>
