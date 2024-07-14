<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="flex flex-col gap-10 items-start max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p class="text-2xl">Hi , {{ $page.props.auth.user.name }} ! Welcome to Spotifie</p>
                <div class=" flex gap-4">
                    <!-- <Welcome
                    :user="$page.props.auth.user"
                    /> -->
                    <div class="p-4 w-fit rounded-lg flex items-center bg-[#191919]">
                       <p><span class="text-2xl"> {{ $page.props.tracksCount }}</span> <span class="text-gray-400"> songs in total </span></p>
                    </div>
                    <div class="p-4 w-fit rounded-lg flex items-center bg-[#191919]">
                        <p><span class="text-2xl"> {{ $page.props.playlistsCount }}</span> <span class="text-gray-400"> playlists in total </span></p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
