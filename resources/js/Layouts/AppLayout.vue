<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <Head :title="title" />

        <Banner />

        <nav class="bg-blue-700 p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <Link :href="route('dashboard')" class="flex items-center space-x-2">
                        <ApplicationMark class="block h-9 w-auto" />
                        <span class="text-white text-lg font-semibold">ERPBusiness</span>
                    </Link>
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-white">
                        Dashboard
                    </NavLink>
                    <NavLink :href="route('clients.index')" :active="route().current('clients.index')" class="text-white">
                        Clientes
                    </NavLink>
                    <NavLink :href="route('products.index')" :active="route().current('products.index')" class="text-white">
                        Produtos
                    </NavLink>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Teams Dropdown -->
                    <div v-if="$page.props.jetstream.hasTeamFeatures" class="relative">
                        <Dropdown align="right" width="60">
                            <template #trigger>
                                <button class="text-white flex items-center">
                                    {{ $page.props.auth.user.current_team.name }}
                                    <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </template>
                            <template #content>
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Team
                                    </div>
                                    <DropdownLink :href="route('teams.show', $page.props.auth.user.current_team)">
                                        Team Settings
                                    </DropdownLink>
                                    <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                                        Create New Team
                                    </DropdownLink>
                                    <div v-if="$page.props.auth.user.all_teams.length > 1" class="border-t border-gray-200 mt-2">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>
                                        <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                            <form @submit.prevent="switchToTeam(team)">
                                                <DropdownLink as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id == $page.props.auth.user.current_team_id" class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </Dropdown>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                </button>
                            </template>
                            <template #content>
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Account
                                </div>
                                <DropdownLink :href="route('profile.show')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                    API Tokens
                                </DropdownLink>
                                <div class="border-t border-gray-200 mt-2">
                                    <form @submit.prevent="logout">
                                        <DropdownLink as="button">
                                            Log Out
                                        </DropdownLink>
                                    </form>
                                </div>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header v-if="$slots.header" class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="container mx-auto py-6 px-4">
                <slot />
            </div>
        </main>
    </div>
</template>
