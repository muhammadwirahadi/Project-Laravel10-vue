<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
defineProps({ lowongans: Array });

const nama = ref('');

const tambah = () => {
  router.post('/admin/lowongan', { nama_lowongan: nama.value });
  nama.value = '';
};

const hapus = (id) => {
  router.delete(`/admin/lowongan/${id}`);
};
</script>

<template>
    <Head title="Lowongan" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lowongan</h2>
      </template>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6">
                <div class="mb-4 mt-4 ml-4">
                  <input v-model="nama" placeholder="Nama lowongan" class="border p-2 rounded" />
                  <button @click="tambah" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Tambah</button>
                </div>
 
                <table class="w-full border">
                  <thead>
                    <tr class="bg-gray-100 text-left">
                      <th class="p-2 border">No</th>
                      <th class="p-2 border">ID</th>
                      <th class="p-2 border">Nama Lowongan</th>
                      <th class="p-2 border text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="l, index in lowongans" :key="l.id">
                      <td class="p-2 border text-center">{{ index + 1 }}</td>
                      <td class="p-2 border text-center">{{ l.id }}</td>
                      <td class="p-2 border">{{ l.nama_lowongan }}</td>
                      <td class="p-2 border text-center">
                        <button @click="hapus(l.id)" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Hapus</button>
                      </td>
                    </tr>
                    <tr v-if="!lowongans.length">
                      <td colspan="9" class="text-center text-gray-500 py-4">
                        Belum ada data Lowongan.
                      </td>
                    </tr>                    
                  </tbody>
                </table>
              </div>

          </div>
        </div>
      </div>

      
    </AuthenticatedLayout>
</template>
