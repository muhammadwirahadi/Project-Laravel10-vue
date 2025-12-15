<script setup>
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const form = useForm({});
const logout = () => form.post(route("logout"));

// data user login
const user = computed(() => page.props.auth?.user || {});

// misal status_magang: 'diterima' | 'ditolak' | 'pending'
const isAccepted = computed(() => user.value.status_magang === "diterima");
</script>

<template>
  <Head title="Profil Saya" />

  <!-- WRAPPER BG GRADIENT -->
  <div
    class="min-h-screen w-full relative overflow-hidden"
    style="
      background: linear-gradient(
        120deg,
        #f4f4f4 0%,
        #e8f3ed 18%,
        #d4e9df 32%,
        #b6d8c8 48%,
        #8cc6a2 65%,
        #006633 100%
      );
    "
  >
    <!-- LINGKARAN DEKORASI BESAR -->
    <div
      class="absolute -top-24 -left-24 w-[400px] h-[400px] rounded-full"
      style="
        background: linear-gradient(135deg, #006633 0%, #f4f4f4 85%);
        box-shadow: 10px 10px 25px rgba(0,0,0,0.25);
      "
    ></div>

    <div
      class="absolute -bottom-24 -right-24 w-[400px] h-[400px] rounded-full"
      style="
        background: linear-gradient(135deg, #006633 0%, #f4f4f4 85%);
        box-shadow: -10px -10px 25px rgba(0,0,0,0.25);
      "
    ></div>

    <!-- NAVBAR -->
    <nav
      class="fixed top-0 left-0 w-full z-50 backdrop-blur-md flex flex-wrap items-center gap-3 px-3 lg:px-10 py-2 md:py-4 shadow nav-animate"
    >
      <!-- LOGO + TEKS -->
      <div class="flex items-center space-x-2 flex-1 min-w-[220px]">
        <img src="/storage/img/logo-badilag.png" class="h-8 md:h-14 w-auto" />

        <div
          class="leading-snug text-[#006633] text-[9px] sm:text-xs md:text-sm font-semibold"
        >
          Mahkamah Agung Republik Indonesia<br />
          Direktorat Jenderal Badan Peradilan Agama
        </div>
      </div>

      <!-- MENU -->
      <div
        class="flex justify-center gap-4 text-[10px] sm:text-xs md:text-sm font-semibold flex-none"
      >
        <Link href="/" class="text-[#006633] hover:underline">BERANDA</Link>
        <Link href="/" class="text-[#006633] hover:underline">BENEFITS</Link>
        <Link :href="route('lowongan.index')" class="text-[#006633] hover:underline">
          LOWONGAN
        </Link>
      </div>

      <!-- NAMA USER + KELUAR -->
      <div
        class="flex items-center space-x-2 flex-1 justify-end min-w-[180px]"
      >
        <span class="text-[#004724] font-semibold truncate max-w-[150px] text-xs md:text-sm">
          {{ user.name }}
        </span>

        <button
          @click="logout"
          class="bg-[#006633] text-white px-3 py-1.5 md:px-4 md:py-2 rounded-md shadow-xl text-xs md:text-sm font-semibold hover:bg-[#005428] transition"
        >
          KELUAR
        </button>
      </div>
    </nav>

    <!-- KONTEN PROFIL -->
    <main
      class="relative pt-20 z-10 max-w-6xl mx-auto mt-1 md:mt-8 mb-2 md:mb-10 px-3 sm:px-6 lg:px-10"
    >
      <!-- LAYOUT: KIRI DATA DIRI, KANAN STATUS/LAPORAN -->
      <div class="flex flex-col md:flex-row gap-0 items-start">
        <!-- KOLOM KIRI: DATA DIRI -->
        <div class="flex-1 space-y-1 md:space-y-4 pr-[180px] md:pr-0">
          <!-- NAMA LENGKAP + TOMBOL (MOBILE) -->
          <div class="relative flex items-start gap-2">
            <!-- Nama Lengkap -->
            <div class="flex-1 flex flex-col">
              <label
                class="text-[#004724] font-semibold text-[10px] md:text-sm mb-0.5 md:mb-1"
              >
                Nama Lengkap
              </label>
              <input
                type="text"
                class="w-[180px] sm:w-[240px] md:w-[450px] lg:w-[779px] h-6 md:h-[39px] bg-[#F4F4F4] rounded-[10px]
                       shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                       px-2 md:px-4 outline-none border-0 text-[11px] md:text-sm"
                :value="user.name"
                disabled
              />
            </div>

            <!-- TOMBOL STATUS / LAPORAN / KEMBALI (HANYA MOBILE < md) -->
            <div
              class="md:hidden absolute left-[200px] top-[18px]
                     flex flex-col space-y-4 w-[110px]"
            >
              <Link
                href="/status-pendaftaran"
                class="h-[22px] flex items-center justify-center
                       bg-white rounded-[10px]
                       shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                       text-[#004724] font-semibold text-[9px] hover:opacity-90 transition"
              >
                Status
              </Link>

              <button
                v-if="!isAccepted"
                type="button"
                class="h-[22px] flex items-center justify-center space-x-1
                       bg-white rounded-[10px]
                       shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                       text-[#004724] font-semibold text-[9px] opacity-70 cursor-not-allowed"
              >
                <span>Laporan</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="10"
                  height="10"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="#006633"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 15v2m-4 3h8a2 2 0 002-2v-5a2 2 0 00-2-2H8a2 2 0 00-2 2v5a2 2 0 002 2zm2-9V7a4 4 0 118 0v2"
                  />
                </svg>
              </button>

              <Link
                v-else
                href="/laporan"
                class="h-[22px] flex items-center justify-center
                       bg-white rounded-[10px]
                       shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                       text-[#004724] font-semibold text-[9px] hover:opacity-90 transition"
              >
                Laporan
              </Link>

              <Link
                href="/"
                class="h-[22px] flex items-center justify-center
                       bg-[#006633] text-white rounded-[10px]
                       shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                       text-[9px] font-semibold hover:bg-[#005428] transition"
              >
                Kembali
              </Link>
            </div>
          </div>

          <!-- Tgl Lahir -->
          <div class="flex flex-col">
            <label
              class="text-[#004724] font-semibold text-[10px] md:text-sm mb-0.5 md:mb-1"
            >
              Tanggal Lahir
            </label>
            <input
              type="text"
              class="w-full md:w-[450px] lg:w-[779px] h-6 md:h-[39px] bg-[#F4F4F4] rounded-[10px]
                     shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                     px-2 md:px-4 outline-none border-0 text-[11px] md:text-sm"
              :value="user.tgl_lahir || '-'"
              disabled
            />
          </div>

          <!-- No tlp -->
          <div class="flex flex-col">
            <label
              class="text-[#004724] font-semibold text-[10px] md:text-sm mb-0.5 md:mb-1"
            >
              Nomor Handphone
            </label>
            <input
              type="text"
              class="w-full md:w-[450px] lg:w-[779px] h-6 md:h-[39px] bg-[#F4F4F4] rounded-[10px]
                     shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                     px-2 md:px-4 outline-none border-0 text-[11px] md:text-sm"
              :value="user.no_tlp || '-'"
              disabled
            />
          </div>

          <!-- Agama -->
          <div class="flex flex-col">
            <label
              class="text-[#004724] font-semibold text-[10px] md:text-sm mb-0.5 md:mb-1"
            >
              Agama
            </label>
            <input
              type="text"
              class="w-full md:w-[450px] lg:w-[779px] h-6 md:h-[39px] bg-[#F4F4F4] rounded-[10px]
                     shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                     px-2 md:px-4 outline-none border-0 text-[11px] md:text-sm"
              :value="user.agama || '-'"
              disabled
            />
          </div>

          <!-- Asal Sekolah / Univ -->
          <div class="flex flex-col">
            <label
              class="text-[#004724] font-semibold text-[10px] md:text-sm mb-0.5 md:mb-1"
            >
              Asal Sekolah / Universitas
            </label>
            <input
              type="text"
              class="w-full md:w-[450px] lg:w-[779px] h-6 md:h-[39px] bg-[#F4F4F4] rounded-[10px]
                     shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                     px-2 md:px-4 outline-none border-0 text-[11px] md:text-sm"
              :value="user.sekolah_univ || '-'"
              disabled
            />
          </div>

          <!-- Jenis kelamin -->
          <div class="flex flex-col">
            <label
              class="text-[#004724] font-semibold text-[10px] md:text-sm mb-0.5 md:mb-1"
            >
              Jenis Kelamin
            </label>
            <input
              type="text"
              class="w-full md:w-[450px] lg:w-[779px] h-6 md:h-[39px] bg-[#F4F4F4] rounded-[10px]
                     shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                     px-2 md:px-4 outline-none border-0 text-[11px] md:text-sm"
              :value="user.gender || '-'"
              disabled
            />
          </div>

          <!-- Email -->
          <div class="flex flex-col">
            <label
              class="text-[#004724] font-semibold text-[10px] md:text-sm mb-0.5 md:mb-1"
            >
              E-mail
            </label>
            <input
              type="text"
              class="w-full md:w-[450px] lg:w-[779px] h-6 md:h-[39px] bg-[#F4F4F4] rounded-[10px]
                     shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                     px-2 md:px-4 outline-none border-0 text-[11px] md:text-sm"
              :value="user.email || '-'"
              disabled
            />
          </div>

          <!-- Alamat -->
          <div class="flex flex-col">
            <label
              class="text-[#004724] font-semibold text-[10px] md:text-sm mb-0.5 md:mb-1"
            >
              Alamat
            </label>
            <input
              type="text"
              class="w-full md:w-[450px] lg:w-[779px] h-6 md:h-[39px] bg-[#F4F4F4] rounded-[10px]
                     shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                     px-2 md:px-4 outline-none border-0 text-[11px] md:text-sm"
              :value="user.alamat || '-'"
              disabled
            />
          </div>

        </div>

        <!-- KOLOM KANAN: STATUS & LAPORAN (TABLET & DESKTOP) -->
        <div class="hidden md:flex flex-col w-[200px] space-y-9 pt-[26px] -ml-20">
          <Link
            href="/status-pendaftaran"
            class="w-[180px] h-[39px] flex items-center justify-center
                   bg-white rounded-[10px]
                   shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                   text-[#004724] font-semibold text-sm hover:opacity-90 transition"
          >
            Status Pendaftaran
          </Link>

          <button
            v-if="!isAccepted"
            type="button"
            class="w-[180px] h-[39px] flex items-center justify-center space-x-2
                   bg-white rounded-[10px]
                   shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                   text-[#004724] font-semibold text-sm opacity-70 cursor-not-allowed"
          >
            <span>Laporan</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="none"
              viewBox="0 0 24 24"
              stroke="#006633"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 15v2m-4 3h8a2 2 0 002-2v-5a2 2 0 00-2-2H8a2 2 0 00-2 2v5a2 2 0 002 2zm2-9V7a4 4 0 118 0v2"
              />
            </svg>
          </button>

          <Link
            v-else
            href="/laporan"
            class="w-[180px] h-[39px] flex items-center justify-center
                   bg-white rounded-[10px]
                   shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                   text-[#004724] font-semibold text-sm hover:opacity-90 transition"
          >
            Laporan
          </Link>

          <Link
            href="/"
            class="hidden md:flex lg:hidden w-[180px] h-[39px] items-center justify-center
                   bg-[#006633] text-white rounded-[10px]
                   shadow-[5px_5px_10px_rgba(0,0,0,0.25)]
                   text-sm font-semibold hover:bg-[#005428] transition"
          >
            Kembali
          </Link>
        </div>
      </div>

      <!-- FOOTNOTE -->
      <p
        class="mt-3 md:mt-10 text-center whitespace-normal text-[12px] md:text-base text-[#004724] font-semibold px-2 md:px-0"
      >
        *Halaman profil ini tidak dapat diubah oleh pengguna.
        Jika terdapat kesalahan data, silakan hubungi admin melalui <br></br>e-mail:
        admin_badilag@gmail.com
      </p>
    </main>
  </div>
</template>