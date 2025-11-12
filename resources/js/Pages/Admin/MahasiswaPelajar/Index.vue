<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
  mahasiswa: Array,
});

// DATA UNTUK MODAL EDIT
const showModal = ref(false);
const editData = ref({
  id: '',
  name: '',
  email: '',
  gender: '',
  sekolah_univ: '',
  jurusan: '',
  tgl_lahir: '',
  no_tlp: ''
});

// FUNGSI UNTUK HAPUS DATA
const hapus = (id) => {
  if (confirm('Yakin ingin menghapus data ini?')) {
    router.delete(`/admin/mahasiswa/${id}`);
  }
};

// FUNGSI UNTUK EDIT DATA
const openModal = (m) => {
  editData.value = { ...m };
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};

const updateMahasiswa = () => {
  router.put(`/admin/mahasiswa/${editData.value.id}`, editData.value, {
    onSuccess: () => {
      closeModal();
    },
  });
};
</script>

<template>
  <Head title="Mahasiswa / Pelajar" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Mahasiswa / Pelajar
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">
              Daftar Mahasiswa / Pelajar
            </h3>

            <table class="w-full border text-sm">
              <thead>
                <tr class="bg-gray-100 text-left">
                  <th class="p-2 border">No</th>
                  <th class="p-2 border">Nama</th>
                  <th class="p-2 border">Email</th>
                  <th class="p-2 border">Gender</th>
                  <th class="p-2 border">Sekolah / Universitas</th>
                  <th class="p-2 border">Jurusan</th>
                  <th class="p-2 border">Tanggal Lahir</th>
                  <th class="p-2 border">No. Telp</th>
                  <th class="p-2 border text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(m, index) in mahasiswa"
                  :key="m.id"
                  class="hover:bg-gray-50"
                >
                  <td class="p-2 border text-center">{{ index + 1 }}</td>
                  <td class="p-2 border">{{ m.name }}</td>
                  <td class="p-2 border">{{ m.email }}</td>
                  <td class="p-2 border">{{ m.gender || '-' }}</td>
                  <td class="p-2 border">{{ m.sekolah_univ || '-' }}</td>
                  <td class="p-2 border">{{ m.jurusan || '-' }}</td>
                  <td class="p-2 border">{{ m.tgl_lahir || '-' }}</td>
                  <td class="p-2 border">{{ m.no_tlp || '-' }}</td>
                  <td class="p-2 border text-center space-x-2">
                    <button
                      @click="openModal(m)"
                      class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition"
                    >
                      Edit
                    </button>
                    <button
                      @click="hapus(m.id)"
                      class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                    >
                      Hapus
                    </button>
                  </td>
                </tr>
                <tr v-if="!mahasiswa.length">
                  <td colspan="9" class="text-center text-gray-500 py-4">
                    Belum ada data mahasiswa/pelajar.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL EDIT DATA  -->
    <div
      v-if="showModal"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
      <div class="bg-white rounded-lg shadow-lg w-1/2 p-6">
        <h2 class="text-xl font-bold mb-4">Edit Data Mahasiswa / Pelajar</h2>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium">Nama</label>
            <input v-model="editData.name" class="w-full border p-2 rounded" />
          </div>
          <div>
            <label class="block text-sm font-medium">Email</label>
            <input v-model="editData.email" class="w-full border p-2 rounded" />
          </div>
          <div>
            <label class="block text-sm font-medium">Gender</label>
            <select
              v-model="editData.gender"
              class="w-full border p-2 rounded bg-white"
            >
              <option disabled value="">-- Pilih Jenis Kelamin --</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium">Sekolah / Universitas</label>
            <input
              v-model="editData.sekolah_univ"
              class="w-full border p-2 rounded"
            />
          </div>
          <div>
            <label class="block text-sm font-medium">Jurusan</label>
            <input v-model="editData.jurusan" class="w-full border p-2 rounded" />
          </div>
          <div>
            <label class="block text-sm font-medium">Tanggal Lahir</label>
            <input
              type="date"
              v-model="editData.tgl_lahir"
              class="w-full border p-2 rounded"
            />
          </div>
          <div class="col-span-2">
            <label class="block text-sm font-medium">No. Telepon</label>
            <input v-model="editData.no_tlp" class="w-full border p-2 rounded" />
          </div>
        </div>

        <div class="flex justify-end mt-6 space-x-2">
          <button
            @click="closeModal"
            class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500"
          >
            Batal
          </button>
          <button
            @click="updateMahasiswa"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            Simpan Perubahan
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
