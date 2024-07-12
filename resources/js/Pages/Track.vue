<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TrackCard from '@/Components/Tracks/TrackCard.vue';

</script>

<template>
    <AppLayout title="Tracks">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ $page.props.track.name }}
            </h2>
        </template>
<!--
        <TrackCard
            :tracks="$page.props.track"
        /> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <TrackCard
                    :tracks="$page.props.track"
                />
                <!-- <div class="grid grid-cols-2 gap-4 items-center justify-start bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                    <p class="text-2xl font-bold"><span>{{ $page.props.track.name }}</span>  <span class="text-zinc-400 font-thin text-lg"> {{ $page.props.track.album }}</span></p>
                        <p class="font-semibold text-blue-400">{{ $page.props.track.artist }}</p>
                        <p>Has been played : {{ $page.props.track.playCount }} times </p>
                </div> -->
            </div>
        </div>
    </AppLayout>
</template>
