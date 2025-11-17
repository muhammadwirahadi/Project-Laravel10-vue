<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

defineProps({
  daftarMagangs: Array,
});

const ubahStatus = (id, status) => {
  router.put(`/admin/daftar-magang/${id}/status`, { status });
};
</script>

<template>
  <Head title="Daftar Magang" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pendaftar Magang</h2>
    </template>

    <div class="py-12">
      <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
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
                  <th class="border p-2">Lowongan / Divisi</th>
                  <th class="border p-2">Durasi Magang</th>
                  <th class="border p-2">Tanggal Daftar</th>
                  <th class="border p-2">CV</th>
                  <th class="border p-2">Surat Permohonan Magang</th>
                  <th class="border p-2">Surat Pembimbing</th>
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
                  <td class="border p-2">{{ d.created_at ? new Date(d.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) : '-' }}</td>
                  <td class="border p-2 text-center">{{ d.cv || '-' }}</td>
                  <td class="border p-2 text-center">{{ d.surat_permohonan_magang || '-' }}</td>
                  <td class="border p-2 text-center">{{ d.pembimbing || '-' }}</td>
                  <td class="border p-2 text-center">
                    <div class="flex items-center justify-center gap-2">
                      <!-- STATUS -->
                      <span
                        class="px-2 py-1 rounded text-xs font-semibold"
                        :class="{
                          'bg-gray-300 text-gray-700': d.status === 'Pending',
                          'bg-green-500 text-white': d.status === 'Diterima',
                          'bg-red-500 text-white': d.status === 'Ditolak',
                        }"
                      >
                        {{ d.status }}
                      </span>

                      <!-- TOMBOL TERIMA -->
                      <button
                        @click="ubahStatus(d.id, 'Diterima')"
                        class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 text-xs"
                      >
                        Terima
                      </button>

                      <!-- TOMBOL TOLAK -->
                      <button
                        @click="ubahStatus(d.id, 'Ditolak')"
                        class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs"
                      >
                        Tolak
                      </button>

                    </div>
                  </td>
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
