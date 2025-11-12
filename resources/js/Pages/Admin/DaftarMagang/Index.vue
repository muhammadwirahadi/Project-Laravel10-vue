<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
  daftarMagangs: Array,
});
</script>

<template>
  <Head title="Daftar Magang" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Magang</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">Data Pendaftar Magang</h3>

            <table class="w-full border text-sm text-left">
              <thead>
                <tr class="bg-gray-100">
                  <th class="border p-2">No</th>
                  <th class="border p-2">Nama</th>
                  <th class="border p-2">Email</th>
                  <th class="border p-2">No. Telp</th>
                  <th class="border p-2">Lowongan</th>
                  <th class="border p-2">Durasi Magang</th>
                  <th class="border p-2">Tanggal Daftar</th>
                  <th class="border p-2 text-center">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(d, index) in daftarMagangs" :key="d.id" class="hover:bg-gray-50">
                  <td class="border p-2 text-center">{{ index + 1 }}</td>
                  <td class="border p-2">{{ d.user?.name || '-' }}</td>
                  <td class="border p-2">{{ d.user?.email || '-' }}</td>
                  <td class="border p-2">{{ d.user?.no_tlp || '-' }}</td>
                  <td class="border p-2">{{ d.lowongan?.nama_lowongan || '-' }}</td>
                  <td class="border p-2">{{ d.durasi || '-' }}</td>
                  <td class="border p-2">{{ d.created_at ? new Date(d.created_at).toLocaleDateString() : '-' }}</td>
                  <td class="border p-2 text-center">{{ d.status || 'Pending' }}</td>
                </tr>
                <tr v-if="!daftarMagangs.length">
                  <td colspan="6" class="text-center text-gray-500 py-4">
                    Belum ada pendaftar magang.
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
