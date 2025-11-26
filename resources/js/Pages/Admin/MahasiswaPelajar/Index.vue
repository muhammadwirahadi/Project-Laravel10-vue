<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  mahasiswas: {
    type: Object,
    required: true,
  },
  filters: {
    type: Object,
    default: () => ({ 
      search: ''
    })
  }
});

// Data untuk Modal Edit
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

// Fungsi untuk Hapus Data
const hapus = (id) => {
  if (confirm('Yakin ingin menghapus data ini?')) {
    router.delete(`/admin/mahasiswa/${id}`);
  }
};

// Fungsi untuk Edit Data
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

// Search
const search = ref(props.filters.search ?? '');

const cari = () => {
  router.get('/admin/mahasiswa', { search: search.value }, { preserveState: true })
};

const go = (url) => {
  if (url) {
    router.get(url, {}, { preserveState: true });
  }
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
      <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <div class="flex justify-between items-center mb-6 mx-4">
              
              <h3 class="font-semibold text-lg">Daftar Mahasiswa / Pelajar</h3>

              <!-- Search -->
              <input
                v-model="search"
                @input="cari"
                placeholder="Cari Mahasiswa..."
                class="border p-2 rounded"
              />
            </div>
            <table class="w-full border text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th class="p-2 border">No</th>
                  <th class="p-2 border">Nama</th>
                  <th class="p-2 border">Email</th>
                  <th class="p-2 border">Gender</th>
                  <th class="p-2 border">Agama</th>
                  <th class="p-2 border">Alamat</th>
                  <th class="p-2 border">Sekolah / Univ</th>
                  <th class="p-2 border">Jurusan</th>
                  <th class="p-2 border">Tanggal Lahir</th>
                  <th class="p-2 border">No Telepon</th>
                  <th class="p-2 border text-center">Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(m, index) in mahasiswas.data" :key="m.id">
                  <td class="p-2 border text-center">
                    {{ mahasiswas.from + index }}
                  </td>
                  <td class="p-2 border">{{ m.name }}</td>
                  <td class="p-2 border">{{ m.email }}</td>
                  <td class="p-2 border">{{ m.gender }}</td>
                  <td class="p-2 border">{{ m.agama }}</td>
                  <td class="p-2 border">{{ m.alamat }}</td>
                  <td class="p-2 border">{{ m.sekolah_univ }}</td>
                  <td class="p-2 border">{{ m.jurusan }}</td>
                  <td class="p-2 border">{{ m.tgl_lahir }}</td>
                  <td class="p-2 border">{{ m.no_tlp }}</td>

                  <td class="p-2 border text-center text-sm">
                    <div class="flex items-center justify-center gap-2 whitespace-nowrap">
                      <button
                        @click="openModal(m)"
                        class="bg-yellow-500 text-white px-3 py-1 rounded"
                      >
                        Edit
                      </button>

                      <button
                        @click="hapus(m.id)"
                        class="bg-red-500 text-white px-3 py-1 rounded"
                      >
                        Hapus
                      </button>
                    </div>
                  </td>

                </tr>
              </tbody>
            </table>

            <div class="flex justify-center mt-4">
              <nav class="flex space-x-2 text-xs">
                <button
                  v-for="link in mahasiswas.links"
                  :key="link.label"
                  v-html="link.label"
                  @click="go(link.url)"
                  class="px-3 py-1 border rounded"
                  :class="{
                    'bg-blue-500 text-white': link.active,
                    'text-gray-400': !link.url
                  }"
                />
              </nav>
            </div>        
            
            

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
            <label class="block text-sm font-medium">Agama</label>
            <input
              v-model="editData.agama"
              class="w-full border p-2 rounded"
            />
          </div>
          <div>
            <label class="block text-sm font-medium">Alamat</label>
            <input
              v-model="editData.alamat"
              class="w-full border p-2 rounded"
            />
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
