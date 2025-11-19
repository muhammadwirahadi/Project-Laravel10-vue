<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps({
  daftarMagangs: Object,
  filters: {
    type: Object,
    default: () => ({ search: '' })
  }
});

const search = ref(props.filters.search ?? '');

const cari = () => {
  router.get('/admin/daftarmagang', { search: search.value }, { preserveState: true });
};

const go = (url) => {
  if (url) {
    router.get(url, {}, { preserveState: true });
  }
};

const ubahStatus = (id, status) => {
  router.put(`/admin/daftar-magang/${id}/status`, { status });
};

function hapus(id) {
  if (confirm("Yakin ingin menghapus data ini?")) {
    router.delete(route('daftarmagang.destroy', id));
  }
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

            <!-- Search -->
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-semibold text-lg">Pendaftar Magang</h3>

              <input
                v-model="search"
                @input="cari"
                placeholder="Cari Pendaftar..."
                class="border p-2 rounded"
              />
            </div>

            <table class="w-full border text-sm text-left">
              <thead>
                <tr class="bg-gray-100">
                  <th class="border p-2">No</th>
                  <th class="border p-2">Nama</th>
                  <th class="border p-2">Email</th>
                  <th class="border p-2">No. Telp</th>
                  <th class="border p-2">Lowongan / Divisi</th>
                  <th class="border p-2">Durasi</th>
                  <th class="border p-2">Tanggal Daftar</th>
                  <th class="border p-2">CV</th>
                  <th class="border p-2">Surat Permohonan</th>
                  <th class="border p-2">Surat Pembimbing</th>
                  <th class="border p-2 text-center">Status</th>
                  <th class="border p-2 text-center">Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(d, index) in daftarMagangs.data" :key="d.id" class="hover:bg-gray-50">
                  <td class="border p-2 text-center">
                    {{ (daftarMagangs.current_page - 1) * daftarMagangs.per_page + index + 1 }}
                  </td>
                  <td class="border p-2">{{ d.nama }}</td>
                  <td class="border p-2">{{ d.email }}</td>
                  <td class="border p-2">{{ d.no_tlp }}</td>
                  <td class="border p-2">{{ d.lowongan?.nama_lowongan }}</td>
                  <td class="border p-2">{{ d.durasi }} Bulan</td>
                  <td class="border p-2">
                    {{ new Date(d.created_at).toLocaleDateString('id-ID', { day:'2-digit',month:'short',year:'numeric'}) }}
                  </td>

                  <td class="border p-2 text-center">
                    <a v-if="d.cv_url" :href="d.cv_url" target="_blank" class="bg-blue-600 text-white px-2 py-1 text-xs rounded">Lihat</a>
                    <span v-else>-</span>
                  </td>

                  <td class="border p-2 text-center">
                    <a v-if="d.surat_permohonan_url" :href="d.surat_permohonan_url" target="_blank" class="bg-blue-600 text-white px-2 py-1 text-xs rounded">Lihat</a>
                    <span v-else>-</span>
                  </td>

                  <td class="border p-2 text-center">
                    <a v-if="d.pembimbing_url" :href="d.pembimbing_url" target="_blank" class="bg-blue-600 text-white px-2 py-1 text-xs rounded">Lihat</a>
                    <span v-else>-</span>
                  </td>

                  <td class="border p-2 text-center">
                    <select
                      class="border rounded px-6 py-1 text-xs"
                      :value="d.status"
                      @change="ubahStatus(d.id, $event.target.value)"
                    >
                      <option value="Pending">Pending</option>
                      <option value="Diterima" class="bg-green-400 ">Diterima</option>
                      <option value="Ditolak" class="bg-red-400 ">Ditolak</option>
                    </select>
                  </td>

                  <td class="border p-2 text-center">
                    <button @click="hapus(d.id)" class="bg-red-600 text-white px-3 py-1 text-xs rounded">
                      Hapus
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-center mt-4">
              <nav class="flex space-x-2 text-xs">
                <button
                  v-for="link in daftarMagangs.links"
                  :key="link.label"
                  @click="go(link.url)"
                  v-html="link.label"
                  :class="[
                    'px-3 py-1 border rounded',
                    link.active ? 'bg-blue-500 text-white' : '',
                    !link.url ? 'text-gray-400' : ''
                  ]"
                />
              </nav>
            </div>

          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
