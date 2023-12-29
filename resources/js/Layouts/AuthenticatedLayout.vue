<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import Footer from '@/Layouts/Footer.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    isLoggedIn: {
        type: Boolean
    },
});
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <div class="flex justify-between h-16 items-center">
                <div class="mx-auto">
                    <Link :href="route('home')">
                        <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800"/>
                    </Link>
                    
                </div>
                <div class="flex items-center mr-4 space-x-4">
                    <template v-if="isLoggedIn" >
                        <NavLink :href="route('basket')" :active="route().current('basket')">
                            Basket
                        </NavLink>

                        <NavLink :href="route('logout')" method="post" @click="route().current('logout')">
                            Logout
                        </NavLink>
                    </template>
                    <template v-else>
                        <NavLink v-if="canLogin" :href="route('login')" :active="route().current('login')">
                            Log in
                        </NavLink>

                        <NavLink v-if="canRegister" :href="route('register')" :active="route().current('register')">
                            Register
                        </NavLink>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>

        <!-- Page Footer -->
        <Footer />
    </div>
</template>
