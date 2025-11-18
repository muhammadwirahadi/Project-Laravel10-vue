<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

defineProps({
  daftarMagangs: Array,
});

const ubahStatus = (id, status) => {
  router.put(`/admin/daftar-magang/${id}/status`, { status });
};

function hapus(id) {
  if (confirm("Yakin ingin menghapus data ini?"))
    { router.delete(route('daftarmagang.destroy', id)); }
}

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
                  <th class="border p-2 text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(d, index) in daftarMagangs" :key="d.id" class="hover:bg-gray-50">
                  <td class="border p-2 text-center">{{ index + 1 }}</td>
                  <td class="border p-2">{{ d.nama || '-' }}</td>
                  <td class="border p-2">{{ d.email || '-' }}</td>
                  <td class="border p-2">{{ d.no_tlp || '-' }}</td>
                  <td class="border p-2">{{ d.lowongan?.nama_lowongan || '-' }}</td>
                  <td class="border p-2">{{ d.durasi || '-' }}</td>
                  <td class="border p-2">{{ d.created_at ? new Date(d.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) : '-' }}</td>
                  <td class="border p-2 text-center">
                    <a
                      v-if="d.cv_url"
                      :href="d.cv_url"
                      target="_blank"
                      rel="noopener"
                      class="text-xs text-white hover:bg-blue-800 bg-blue-600 px-2 py-1 rounded"
                    >
                      Lihat
                    </a>
                    <span v-else>-</span>
                  </td>

                  <td class="border p-2 text-center">
                    <a
                      v-if="d.surat_permohonan_url"
                      :href="d.surat_permohonan_url"
                      target="_blank"
                      rel="noopener"
                      class="text-xs text-white hover:bg-blue-800 bg-blue-600 px-2 py-1 rounded"
                    >
                      Lihat
                    </a>
                    <span v-else>-</span>
                  </td>

                  <td class="border p-2 text-center">
                    <a
                      v-if="d.pembimbing_url"
                      :href="d.pembimbing_url"
                      target="_blank"
                      rel="noopener"
                      class="text-xs text-white hover:bg-blue-800 bg-blue-600 px-2 py-1 rounded"
                    >
                      Lihat
                    </a>
                    <span v-else>-</span>
                  </td>

                <td class="border p-2">
                    <select
                        class="border rounded px-6 py-1 text-xs"
                        :value="d.status"
                        @change="ubahStatus(d.id, $event.target.value)"
                    >
                        <option value="Pending">Pending</option>
                        <option value="Diterima">Diterima</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </td>

                  <td class="border p-2">
                    <button 
                        @click="hapus(d.id)"
                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs"
                    >
                        Hapus
                    </button>                    
                  </td>


                </tr>
                <tr v-if="!daftarMagangs.length">
                  <td colspan="6" class="text-right text-gray-500 py-4">
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
