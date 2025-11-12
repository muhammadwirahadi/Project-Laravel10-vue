<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    gender: '',
    agama: '',
    alamat: '',
    sekolah_univ: '',
    jurusan: '',
    tgl_lahir: '',
    no_tlp: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit" class="space-y-4">
            <!-- Nama -->
            <div>
                <InputLabel for="name" value="Nama Lengkap" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Email -->
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Password -->
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <InputLabel for="password_confirmation" value="Konfirmasi Password" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <!-- Gender -->
            <div>
                <InputLabel for="gender" value="Jenis Kelamin" />
                <select
                    id="gender"
                    v-model="form.gender"
                    required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                >
                    <option disabled value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <!-- Agama -->
            <div>
                <InputLabel for="agama" value="Agama" />
                <TextInput
                    id="agama"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.agama"
                    required
                />
                <InputError class="mt-2" :message="form.errors.agama" />
            </div>

            <!-- Alamat -->
            <div>
                <InputLabel for="alamat" value="Alamat Lengkap" />
                <TextInput
                    id="alamat"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.alamat"
                    required
                />
                <InputError class="mt-2" :message="form.errors.alamat" />
            </div>

            <!-- Sekolah / Universitas -->
            <div>
                <InputLabel for="sekolah_univ" value="Sekolah / Universitas" />
                <TextInput
                    id="sekolah_univ"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.sekolah_univ"
                    required
                />
                <InputError class="mt-2" :message="form.errors.sekolah_univ" />
            </div>

            <!-- Jurusan -->
            <div>
                <InputLabel for="jurusan" value="Jurusan" />
                <TextInput
                    id="jurusan"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.jurusan"
                    required
                />
                <InputError class="mt-2" :message="form.errors.jurusan" />
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <InputLabel for="tgl_lahir" value="Tanggal Lahir" />
                <TextInput
                    id="tgl_lahir"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.tgl_lahir"
                    required
                />
                <InputError class="mt-2" :message="form.errors.tgl_lahir" />
            </div>

            <!-- Nomor Telepon -->
            <div>
                <InputLabel for="no_tlp" value="Nomor Telepon" />
                <TextInput
                    id="no_tlp"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.no_tlp"
                    required
                />
                <InputError class="mt-2" :message="form.errors.no_tlp" />
            </div>

            <!-- Tombol -->
            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                >
                    Sudah punya akun?
                </Link>

                <PrimaryButton
                    class="ms-4 bg-green-700 hover:bg-green-800 focus:ring-green-500"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Daftar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
