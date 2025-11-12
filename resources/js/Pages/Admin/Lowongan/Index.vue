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
              <div class="mb-4 mt-4 ml-4">
                <input v-model="nama" placeholder="Nama lowongan" class="border p-2 rounded" />
                <button @click="tambah" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Tambah</button>
              </div>

              <table class="w-full border">
                <thead>
                  <tr class="bg-gray-100">
                    <th class="p-2">No</th>
                    <th class="p-2">ID</th>
                    <th class="p-2">Nama Lowongan</th>
                    <th class="p-2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="l, index in lowongans" :key="l.id">
                    <td class="p-2 text-center">{{ index + 1 }}</td>
                    <td class="p-2 text-center">{{ l.id }}</td>
                    <td class="p-2">{{ l.nama_lowongan }}</td>
                    <td class="p-2 text-center">
                      <button @click="hapus(l.id)" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            <div class="p-6 text-gray-900"></div>
          </div>
        </div>
      </div>

      
    </AuthenticatedLayout>
</template>
