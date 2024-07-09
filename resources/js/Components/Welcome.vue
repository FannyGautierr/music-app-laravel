<script setup>
const props = defineProps({
    user: Object,
});

</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            👩‍🎤 Welcome to Music Player 3000 👩‍🎤 - the best music player in the world!
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            {{ user ? 'Welcome back, ' + user.name + '!' : 'Welcome to Music Player 3000!'}}
        </div>
    </div>
</template>
