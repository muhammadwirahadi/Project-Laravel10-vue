<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

// handle logout
const form = useForm({});
const logout = () => {
    form.post(route('logout'));
};
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 dark:bg-gray-900 [background-image:linear-gradient(-112deg,#006633_-40%,#f4f4f4_150%)] selection:bg-green-500 selection:text-white"
    >
        <!-- Navigasi Atas -->
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">

            <!-- Jika user sudah login -->
            <template v-if="$page.props.auth.user">
                <span class="text-gray-100 dark:text-gray-100 mr-4">
                    Halo, <strong>{{ $page.props.auth.user.name }}</strong>
                </span>

                <!-- Tombol ke halaman sesuai role -->
                <Link
                    v-if="$page.props.auth.user.role_id === 1"
                    :href="route('dashboard')"
                    class="font-semibold text-green-100 hover:bg-green-900 bg-green-950 p-2 rounded-md"
                >
                    Dashboard Admin
                </Link>

                <Link
                    v-else
                    :href="route('lowongan.index')"
                    class="font-semibold text-green-100 hover:bg-green-900 bg-green-950 p-2 rounded-md"
                >
                    Lihat Lowongan
                </Link>

                <!-- Tombol Logout -->
                <button
                    @click="logout"
                    class="ml-4 font-semibold text-gray-100 hover:bg-red-900 bg-red-950 p-2 rounded-md"
                >
                    Logout
                </button>
            </template>

            <!-- Jika user belum login -->
            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-green-100 hover:bg-green-900 bg-green-950 p-2 rounded-md"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-2 font-semibold text-green-950 hover:text-green-100 dark:text-green-950 focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-800 p-2 rounded-md"
                >
                    Register
                </Link>
            </template>
        </div>

        <!-- Konten Tengah -->
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <img
                    src="/storage/img/logo-badilag.png"
                    alt="Logo Saya"
                    class="h-16 w-auto"
                />
            </div>

            <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                <div class="text-center text-sm sm:text-start">&nbsp;</div>
                <div class="text-center text-sm text-gray-100 dark:text-gray-100 sm:text-end sm:ms-0">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
