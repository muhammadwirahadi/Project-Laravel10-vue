<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const page = usePage(); // <= FIX: agar bisa akses $page.props

const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
  lowongans: Array,
});

// Modal
const showModal = ref(false);
const selectedLowongan = ref(null);

// Form daftar
const formDaftar = useForm({
  id_lowongan: "",
  nama: "",
  email: "",
  gender: "",
  agama: "",
  alamat: "",
  sekolah_univ: "",
  jurusan: "",
  tgl_lahir: "",
  no_tlp: "",
  durasi: "",
  cv: null,
  surat_permohonan_magang: null,
  surat_pembimbing: null,
});

const openModal = (lowongan) => {
  selectedLowongan.value = lowongan;
  formDaftar.id_lowongan = lowongan.id;

  // Auto isi nama & email jika user login
  const user = page.props.auth?.user;
  if (user) {
    formDaftar.nama = user.name;
    formDaftar.email = user.email;
    formDaftar.gender = user.gender;
    formDaftar.agama = user.agama;
    formDaftar.alamat = user.alamat;
    formDaftar.sekolah_univ = user.sekolah_univ;
    formDaftar.jurusan = user.jurusan;
    formDaftar.tgl_lahir = user.tgl_lahir;
    formDaftar.no_tlp = user.no_tlp;
  }

  showModal.value = true;
};

const submitDaftar = () => {
  formDaftar.post(route("daftar.magang.store"), {
    forceFormData: true,
    onSuccess: () => {
      showModal.value = false;
      formDaftar.reset();
    },
  });
};

// Logout
const form = useForm({});
const logout = () => form.post(route("logout"));
</script>

<template>
  <Head title="Welcome" />

  <div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 dark:bg-gray-900 [background-image:linear-gradient(-112deg,#006633_-40%,#f4f4f4_150%)] selection:bg-green-500 selection:text-white"
  >
    <!-- NAVBAR -->
    <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
      <!-- Jika user login -->
      <template v-if="$page.props.auth.user">
        <span class="text-gray-100 dark:text-gray-100 mr-4">
          Halo, <strong>{{ $page.props.auth.user.name }}</strong>
        </span>

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

        <button
          @click="logout"
          class="ml-4 font-semibold text-gray-100 hover:bg-red-900 bg-red-950 p-2 rounded-md"
        >
          Logout
        </button>
      </template>

      <!-- Jika belum login -->
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
          class="ml-2 font-semibold text-green-950 hover:text-green-100 dark:text-green-950 p-2 rounded-md"
        >
          Register
        </Link>
      </template>
    </div>

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
      <div class="flex justify-center">
        <img src="/storage/img/logo-badilag.png" alt="Logo" class="h-16 w-auto" />
      </div>

      <!-- LIST LOWONGAN -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mt-10">
        <div
          v-for="l in lowongans"
          :key="l.id"
          class="bg-white shadow-lg rounded-lg p-6 border hover:shadow-xl transition"
        >
          <h3 class="text-xl font-bold text-green-900">{{ l.nama_lowongan }}</h3>
          <p class="text-gray-700 mt-2">{{ l.deskripsi || "Tidak ada deskripsi" }}</p>

          <button
            @click="openModal(l)"
            class="mt-4 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-md"
          >
            Daftar Magang
          </button>
        </div>
      </div>

      <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
        <div class="text-center text-sm sm:text-start">&nbsp;</div>
        <div class="text-center text-sm text-gray-100 dark:text-gray-100 sm:text-end sm:ms-0">
          Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL -->
  <div
    v-if="showModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
  >
    <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh]">
      <h2 class="text-xl font-bold mb-4">
        Daftar Magang - {{ selectedLowongan.nama_lowongan }}
      </h2>

      <form @submit.prevent="submitDaftar">
        <div class="grid grid-cols-2 gap-4">
          <input v-model="formDaftar.nama" placeholder="Nama" class="border p-2 rounded" required />
          <input v-model="formDaftar.email" placeholder="Email" class="border p-2 rounded" required />

          <select v-model="formDaftar.gender" class="border p-2 rounded" required>
            <option value="">Pilih Gender</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>

          <input v-model="formDaftar.agama" placeholder="Agama" class="border p-2 rounded" required />
          <input v-model="formDaftar.jurusan" placeholder="Jurusan" class="border p-2 rounded" required/>
          <input v-model="formDaftar.sekolah_univ" placeholder="Sekolah/Universitas" class="border p-2 rounded" required />
          <input v-model="formDaftar.alamat" placeholder="Alamat" class="border p-2 rounded" required/>

          <div>
            <label class="text-sm">Tanggal Lahir</label>
            <input type="date" v-model="formDaftar.tgl_lahir" class="border p-2 rounded mt-1 w-full" />
          </div>

          <input v-model="formDaftar.no_tlp" placeholder="No Telpon" class="border p-2 rounded" required/>
          <input v-model="formDaftar.durasi" placeholder="Durasi (contoh: 3 bulan)" class="border p-2 rounded" required/>
        </div>

        <!-- FILE UPLOAD -->
        <div class="mt-4">
          <label>Upload CV (PDF) </label>
          <input type="file" @change="e => formDaftar.cv = e.target.files[0]" class="mt-2" required/>

          <label class="mt-3 block">Surat Permohonan Magang</label>
          <input type="file" @change="e => formDaftar.surat_permohonan_magang = e.target.files[0]" required />

          <label class="mt-3 block">Surat Pembimbing</label>
          <input type="file" @change="e => formDaftar.surat_pembimbing = e.target.files[0]" required/>
        </div>

        <div class="flex justify-end space-x-2 mt-6">
          <button
            type="button"
            @click="showModal = false"
            class="px-4 py-2 bg-gray-400 text-white rounded"
          >
            Batal
          </button>

          <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">
            Kirim
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
</style>
