<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';

defineProps({
    teams: {
        type: Array,
    }
});
</script>

<template>
    <Head title="Команды"/>

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Команды</h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                   <div class="grid grid-cols-2 gap-2">
                       <div v-for="(team, key) in teams" :key="team.id + key" class="border-2 rounded-md bg-white py-3 px-5">
                           {{ team.name }}
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
