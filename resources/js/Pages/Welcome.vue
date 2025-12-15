<template>
  <!-- IMPORT POPPINS + SET TITLE -->
  <Head title="Welcome">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
  </Head>

  <!-- WRAPPER  -->
  <div
    class="min-h-screen w-full relative overflow-hidden"
    style="
      background: linear-gradient(
        120deg,
       #F4F4F4 0%,
       #E2ECE7 18%,
       #CFE3D8 32%,
       #ADCFBF 48%,
       #84B99E 65%,
       #1C7A4A 100%
      );
    "
  >
    <!-- NAVBAR -->
    <nav
      class="fixed top-0 left-0 w-full z-50 backdrop-blur-md flex flex-wrap items-center gap-3 px-3 lg:px-10 py-2 md:py-4 shadow nav-animate">
      <!-- ELLIPSE DEKORASI (MOBILE SAJA, HILANG DI TABLET) -->
      <div
        class="absolute sm:hidden rounded-full pointer-events-none"
        style="
          width: 249px;
          height: 244px;
          top: -95px;
          left: -140px;
          background: linear-gradient(135deg, #006633 0%, #f4f4f4 80%);
          box-shadow: 10px 10px 20px rgba(0,0,0,0.25);
          z-index: 5;
        "
      ></div>

      <!-- KIRI: LOGO + TEKS -->
      <div class="flex items-center space-x-3 flex-1 relative z-10">
        <img src="/storage/img/logo-badilag.png" class="h-14 w-auto" />

        <div
          class="leading-snug text-[#006633] text-[10px] sm:text-xs md:text-sm font-semibold"
        >
          Mahkamah Agung Republik Indonesia<br />
          Direktorat Jenderal Badan Peradilan Agama
        </div>
      </div>

      <!-- TENGAH: MENU (HANYA DESKTOP / LG KE ATAS) -->
      <div
        class="hidden lg:flex space-x-8 text-sm sm:text-base font-semibold justify-center"
      >
        <Link href="/" class="text-[#006633] hover:underline">BERANDA</Link>
        <a href="#benefits" class="text-[#006633] hover:underline">BENEFITS</a>
        <a href="#lowongan" class="text-[#006633] hover:underline">LOWONGAN</a>
      </div>

      <!-- KANAN: AUTH / PROFIL (HANYA DESKTOP / LG KE ATAS) -->
      <div class="hidden lg:flex items-center space-x-4 flex-1 justify-end">
        <template v-if="!$page.props.auth?.user">
          <!-- DAFTAR: teks saja -->
          <Link
            :href="route('register')"
            class="text-[#004724] font-bold text-sm hover:opacity-80"
          >
            DAFTAR
          </Link>

          <!-- MASUK: tombol hijau -->
          <Link
            :href="route('login')"
            class="bg-[#006633] text-white px-4 py-2 rounded-md shadow-2xl text-sm font-semibold hover:bg-[#005428] transition"
          >
            MASUK
          </Link>
        </template>

        <!-- SUDAH LOGIN -->
        <template v-else>
          <Link
            :href="route('user.profile.index')"
            class="flex items-center space-x-2 bg-white/90 px-3 py-1 pl-1 rounded-full shadow hover:bg-white max-w-[230px]"
          >
            <div
              class="w-8 h-8 rounded-full bg-[#006633] text-white flex items-center justify-center text-sm font-bold uppercase"
            >
              {{ $page.props.auth.user.name.charAt(0) }}
            </div>

            <span class="text-xs sm:text-sm text-[#006633] font-semibold truncate">
              {{ $page.props.auth.user.name }}
            </span>
          </Link>

          <button
            @click="logout"
            class="bg-green-800 text-white px-4 py-2 rounded-lg shadow-2xl text-sm font-semibold"
          >
            KELUAR
          </button>
        </template>
      </div>

      <!-- HAMBURGER (MOBILE + TABLET, HILANG DI DESKTOP) -->
      <button
        class="lg:hidden text-[#006633] ml-4 relative z-10"
        @click="isMobileMenuOpen = true"
      >
        <!-- icon 3 garis -->
        <svg
          v-if="!isMobileMenuOpen"
          xmlns="http://www.w3.org/2000/svg"
          class="h-7 w-7"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
        </svg>
      </button>
    </nav>
    
    <!-- TEKS UTAMA (ANIMASI MASUK DARI KIRI) -->
    <div class="mt-16 lg:mt-28 px-10 pt-14 lg:ml-16 lg:px-0 max-w-[630px] hero-left-animate">
      <h1
        class="font-bold text-[#006633]
               text-[23px] lg:text-[50px]
               leading-[1.5] 
               max-w-[309px] lg:max-w-[630px]"
        style="font-family: 'Poppins', sans-serif;"
      >
        Bersama <span class="text-[#BAA647]">BADILAG</span> <br>Menuju Dunia Kerja
      </h1>

      <p
        class="mt-6 text-[16px] lg:text-[22px]"
        style="
          max-width: 599px;
          font-family: 'Poppins', sans-serif;
          font-size: 17px;
          font-weight: 400;
          line-height: 1.4;
          color: #004724;
        "
      >
        Ditjen Badan Peradilan Agama, membuka kesempatan magang bagi mahasiswa dan pelajar untuk bersama mengasah potensi dan raih pengalaman kerja di lingkungan Badan Peradilan Agama.
      </p>

      <Link
        :href="route('register')"
        class="mt-8 inline-flex items-center gap-3 bg-[#006633] text-white px-6 py-3 rounded-lg shadow-lg text-lg font-normal hover:bg-green-800"
      >
        Daftar Sekarang
        <!-- ikon panah -->
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="22"
          height="22"
          fill="none"
          stroke="white"
          stroke-width="2.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M5 12h12"></path>
          <path d="M13 6l6 6-6 6"></path>
        </svg>
      </Link>
    </div>

    <!-- LINGKARAN + ORANG (DESKTOP SAJA) -->
    <div class="hidden lg:block">
      <!-- LINGKARAN GRADIENT -->
      <div
        class="absolute rounded-full hero-right-animate"
        style="
          width: 550px;
          height: 550px;
          top: 150px;
          left: 920px;
          background: linear-gradient(100deg, #006633 5%, #f4f4f4 100%);
          filter: drop-shadow(-10px -10px 20px rgba(0,0,0,0.25));
        "
      ></div>

      <!-- GAMBAR ORANG -->
      <img
        src="/storage/img/orang.png"
        class="absolute z-10 hero-right-animate"
        style="
          width: 580px;
          height: 580px;
          top: 93px;
          left: 930px;
          object-fit: cover;
        "
      />
    </div>

    <!-- LINGKARAN SAJA DI TABLET (SM-MD) -->
    <div class="hidden sm:block lg:hidden">
      <div
        class="absolute rounded-full"
        style="
          width: 400px;
          height: 400px;
          bottom: 80px;
          right: -150px;
          background: linear-gradient(135deg, #006633 0%, #f4f4f4 100%);
          filter: drop-shadow(-10px -10px 20px rgba(0,0,0,0.25));
        "
      ></div>
    </div>

    <!-- MOBILE + TABLET FULLSCREEN MENU -->
    <div
      v-if="isMobileMenuOpen"
      class="fixed inset-0 z-40 flex flex-col items-center justify-center"
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
      <!-- dekorasi lingkaran bawah (FULLSCREEN MENU) -->
      <div
        class="absolute rounded-full sm:bottom-[-80px] sm:right-[-120px]"
        style="
          width: 249px;
          height: 244px;
          bottom: -20px;
          right: -140px;
          background: linear-gradient(135deg, #006633 0%, #f4f4f4 80%);
          box-shadow: 10px 10px 20px rgba(0,0,0,0.25);
        "
      ></div>

      <!-- TOP: logo + close -->
      <div class="absolute top-4 left-4 flex items-center space-x-3">
        <img src="/storage/img/logo-badilag.png" class="h-14 w-auto" />
        <div class="leading-snug text-[#006633] text-[10px] sm:text-xs md:text-sm font-semibold">
          Mahkamah Agung Republik Indonesia<br />
          Direktorat Jenderal Badan Peradilan Agama
        </div>
      </div>

      <button
        class="absolute top-6 right-6 text-[#006633]"
        @click="isMobileMenuOpen = false"
      >
        <!-- ikon X -->
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-7 w-7"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- MENU ITEMS -->
      <div class="flex flex-col items-center space-y-6 text-sm font-semibold text-[#004724]">
        <template v-if="!$page.props.auth?.user">
          <Link :href="route('login')" @click="isMobileMenuOpen = false">
            LOG IN
          </Link>
          <Link href="/" @click="isMobileMenuOpen = false">
            Beranda
          </Link>
          <a href="#benefits" @click="isMobileMenuOpen = false">
            Benefits
          </a>
          <a href="#lowongan" @click="isMobileMenuOpen = false">
            Lowongan
          </a>
        </template>

        <template v-else>
          <span class="uppercase tracking-wide">Profil</span>
          <Link :href="route('user.profile.index')" @click="isMobileMenuOpen = false">
            {{ $page.props.auth.user.name }}
          </Link>

          <button
            class="mt-6 uppercase tracking-wide"
            @click="() => { isMobileMenuOpen = false; logout(); }"
          >
            LOG OUT
          </button>
        </template>
      </div>
    </div>
  </div>

  <!-- BENEFITS SECTION -->
  <div 
    id="benefits"
    class="min-h-screen w-full relative overflow-hidden py-12 md:py-16 lg:py-24"
    style="
      background: linear-gradient(
        120deg,
        #F4F4F4 0%,
        #E2ECE7 18%,
        #CFE3D8 32%,
        #ADCFBF 48%,
        #84B99E 65%,
        #1C7A4A 100%
      );
    "
  >
    <!-- LINGKARAN DEKORASI KIRI -->
    <div
      ref="benefitsCircle"
      class="absolute rounded-full benefits-circle-animate"
      :class="{ 'benefits-circle-visible': isCircleVisible }"
      style="
        width: min(75vw, 500px);
        height: min(75vw, 500px);
        top: 250px;
        left: -220px;
        transform: translateY(-50%);
        background: linear-gradient(315deg, #006633 0%, #F4F4F4 80%);
        box-shadow: 10px -10px 20px rgba(0, 0, 0, 0.25);
      "
    ></div>

    <div class="container mx-auto px-4 lg:px-10 relative z-10">
      <!-- TITLE -->
      <h2 
        ref="benefitsTitle"
        class="text-center font-bold text-[#004724] benefits-title-animate mb-6 md:mb-10 lg:mb-16"
        :class="{ 'benefits-title-visible': isTitleVisible }"
        style="font-family: 'Poppins', sans-serif; font-size: clamp(24px, 5vw, 35px); line-height: 1.3;"
      >
        Apa saja yang akan kamu dapatkan<br class="hidden sm:block" />
        ketika Magang di Direktorat Jendral Badan Peradilan Agama??
      </h2>

      <!-- CARDS CONTAINER -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8 max-w-7xl mx-auto">
        <!-- CARD 1: Pengembangan Keahlian -->
        <div 
          ref="card1"
          class="bg-[#F4F4F4] rounded-2xl p-6 lg:p-8 shadow-lg benefits-card-animate"
          :class="{ 'benefits-card-visible': isCard1Visible }"
          style="transition-delay: 0s;"
        >
          <div class="flex justify-center mb-6">
            <img src="/storage/img/Vector.png" alt="Pengembangan Keahlian" class="h-16 w-16 lg:h-20 lg:w-20" />
          </div>
          <h3 class="text-center font-bold text-[#006633] text-xl lg:text-2xl mb-4" style="font-family: 'Poppins', sans-serif;">
            Pengembangan Keahlian
          </h3>
          <p class="text-center text-[#006633] text-sm lg:text-base leading-relaxed" style="font-family: 'Poppins', sans-serif;">
            Anda akan menguasai skill teknis dan manajerial yang spesifik (misalnya, analisis SIPP, tata naskah dinas elektronik, atau prosedur audit birokrasi) langsung dari ahlinya.
          </p>
        </div>

        <!-- CARD 2: Pengalaman Kerja Otentik -->
        <div 
          ref="card2"
          class="bg-[#F4F4F4] rounded-2xl p-6 lg:p-8 shadow-lg benefits-card-animate"
          :class="{ 'benefits-card-visible': isCard2Visible }"
          style="transition-delay: 0.2s;"
        >
          <div class="flex justify-center mb-6">
            <img src="/storage/img/HS.png" alt="Pengalaman Kerja Otentik" class="h-16 w-16 lg:h-20 lg:w-20" />
          </div>
          <h3 class="text-center font-bold text-[#006633] text-xl lg:text-2xl mb-4" style="font-family: 'Poppins', sans-serif;">
            Pengalaman Kerja Otentik
          </h3>
          <p class="text-center text-[#006633] text-sm lg:text-base leading-relaxed" style="font-family: 'Poppins', sans-serif;">
            Terlibat dalam tugas dan proyek nyata di lingkungan birokrasi Eselon I Mahkamah Agung RI, membangun pemahaman otentik tentang sistem peradilan negara.
          </p>
        </div>

        <!-- CARD 3: Sertifikat dan Networking -->
        <div 
          ref="card3"
          class="bg-[#F4F4F4] rounded-2xl p-6 lg:p-8 shadow-lg benefits-card-animate md:col-span-2 lg:col-span-1"
          :class="{ 'benefits-card-visible': isCard3Visible }"
          style="transition-delay: 0.4s;"
        >
          <div class="flex justify-center mb-6">
            <img src="/storage/img/serti.png" alt="Sertifikat dan Networking" class="h-16 w-16 lg:h-20 lg:w-20" />
          </div>
          <h3 class="text-center font-bold text-[#006633] text-xl lg:text-2xl mb-4" style="font-family: 'Poppins', sans-serif;">
            Sertifikat dan Networking
          </h3>
          <p class="text-center text-[#006633] text-sm lg:text-base leading-relaxed" style="font-family: 'Poppins', sans-serif;">
            Mendapatkan Sertifikat Magang resmi yang kredibel, sekaligus membangun jejaring profesional dengan Hakim, Auditor, dan ASN untuk masa depan karier Anda.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- LOWONGAN SECTION -->
  <div 
    id="lowongan"
    class="min-h-screen w-full relative overflow-hidden py-12 md:py-16 lg:py-24"
    style="
      background: linear-gradient(
        120deg,
        #F4F4F4 0%,
        #E2ECE7 18%,
        #CFE3D8 32%,
        #ADCFBF 48%,
        #84B99E 65%,
        #1C7A4A 100%
      );
    "
  >
    <!-- LINGKARAN DEKORASI KIRI ATAS -->
    <div
      ref="lowonganCircleTop"
      class="absolute rounded-full lowongan-circle-top-animate"
      :class="{ 'lowongan-circle-visible': isLowonganCircleTopVisible }"
      style="
        width: min(65vw, 400px);
        height: min(65vw, 400px);
        top: -100px;
        left: -150px;
        background: linear-gradient(135deg, #006633 0%, #F4F4F4 80%);
        box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.25);
      "
    ></div>

    <!-- LINGKARAN DEKORASI KANAN BAWAH -->
    <div
      ref="lowonganCircleBottom"
      class="absolute rounded-full lowongan-circle-bottom-animate"
      :class="{ 'lowongan-circle-visible': isLowonganCircleBottomVisible }"
      style="
        width: min(75vw, 500px);
        height: min(75vw, 500px);
        bottom: -150px;
        right: -200px;
        background: linear-gradient(315deg, #006633 0%, #F4F4F4 80%);
        box-shadow: -10px -10px 20px rgba(0, 0, 0, 0.25);
      "
    ></div>

    <div class="container mx-auto px-4 lg:px-10 relative z-10">
      <!-- TITLE -->
      <h2 
        ref="lowonganTitle"
        class="text-center font-bold text-[#004724] lowongan-title-animate mb-6 md:mb-10 lg:mb-16"
        :class="{ 'lowongan-title-visible': isLowonganTitleVisible }"
        style="font-family: 'Poppins', sans-serif; font-size: clamp(24px, 5vw, 35px); line-height: 1.3;"
      >
        Lowongan 
      </h2>

      <!-- LOWONGAN CARDS CONTAINER -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10 max-w-7xl mx-auto">

  <!-- CARD 1: Kesekretariatan -->
  <div 
    ref="lowonganCard1"
    class="relative rounded-[26px]
           pt-16 lg:pt-[200px] pb-10 px-7 lg:px-10
           shadow-[10px_10px_20px_rgba(0,0,0,0.25)]
           lowongan-card-animate overflow-hidden
           min-h-[260px] md:min-h-[310px] lg:min-h-[350px]"
    :class="{ 'lowongan-card-visible': isLowonganCard1Visible }"
    style="
      background: linear-gradient(
        to bottom left,
        #F4F4F4 0%,
        #E9F7F0 12%,
        #27B768 70%,
        #00AD58 100%
      );
      transition-delay: 0.1s;
    "
  >
    <h3
      class="text-white font-normal text-xl lg:text-2xl mb-4 leading-snug"
      style="font-family: 'Poppins', sans-serif;"
    >
      Kesekretariatan
    </h3>

    <button 
      @click="goToLowongan"
      class="absolute bottom-6 right-6 bg-[#004724] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#003318] transition"
    >
      Selengkapnya
    </button>
  </div>

  <!-- CARD 2: Ditbinganis -->
  <div 
    ref="lowonganCard2"
    class="relative rounded-[26px]
           pt-10 lg:pt-[200px] pb-10 px-7 lg:px-10
           shadow-[10px_10px_20px_rgba(0,0,0,0.25)]
           lowongan-card-animate overflow-hidden
           min-h-[260px] md:min-h-[310px] lg:min-h-[350px]"
    :class="{ 'lowongan-card-visible': isLowonganCard2Visible }"
    style="
      background: linear-gradient(
        to bottom left,
        #F4F4F4 0%,
        #E9F7F0 12%,
        #27B768 70%,
        #00AD58 100%
      );
      transition-delay: 0.2s;
    "
  >
    <h3
      class="text-white font-normal text-xl lg:text-2xl mb-4 leading-snug"
      style="font-family: 'Poppins', sans-serif;"
    >
      Ditbinganis
    </h3>

    <button 
      @click="goToLowongan"
      class="absolute bottom-6 right-6 bg-[#004724] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#003318] transition"
    >
      Selengkapnya
    </button>
  </div>

  <!-- CARD 3: Ditbinadmin -->
  <div 
    ref="lowonganCard3"
    class="relative rounded-[26px]
           pt-16 lg:pt-[200px] pb-10 px-7 lg:px-10
           shadow-[10px_10px_20px_rgba(0,0,0,0.25)]
           lowongan-card-animate overflow-hidden
           min-h-[260px] md:min-h-[310px] lg:min-h-[350px]
           md:col-span-2 lg:col-span-1"
    :class="{ 'lowongan-card-visible': isLowonganCard3Visible }"
    style="
      background: linear-gradient(
        to bottom left,
        #F4F4F4 0%,
        #E9F7F0 12%,
        #27B768 70%,
        #00AD58 100%
      );
      transition-delay: 0.3s;
    "
  >
    <h3
      class="text-white font-normal text-xl lg:text-2xl mb-4 leading-snug"
      style="font-family: 'Poppins', sans-serif;"
    >
      Ditbinadmin
    </h3>

    <button 
      @click="goToLowongan"
      class="absolute bottom-6 right-6 bg-[#004724] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#003318] transition"
    >
      Selengkapnya
          </button>
        </div>
      </div>
    </div>
  </div>

 <!-- FOOTER SECTION -->
<footer
  ref="footer"
  class="w-full relative overflow-hidden footer-animate"
  :class="{ 'footer-visible': isFooterVisible }"
  style="
    background: linear-gradient(
      120deg,
      #F4F4F4 0%,
      #E2ECE7 18%,
      #CFE3D8 32%,
      #ADCFBF 48%,
      #84B99E 65%,
      #1C7A4A 100%
    );
  "
>
  <div class="container mx-auto px-4 lg:px-10 py-10 lg:py-14">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

      <!-- KOLOM 1: Logo -->
      <div class="space-y-5">
        <div class="flex items-center space-x-4">
          <img src="/storage/img/logo-badilag.png" class="h-16 w-auto" />
          <div class="leading-snug text-[#004724] text-sm font-semibold">
            Mahkamah Agung Republik Indonesia<br />
            Direktorat Jenderal Badan Peradilan Agama
          </div>
        </div>

        <!-- Social Media -->
        <div class="flex space-x-4 pt-3 pl-2">
          <a href="#" class="text-[#004724] hover:text-[#003718] transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
            </svg>
          </a>

          <a href="#" class="text-[#004724] hover:opacity-70 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
              <circle cx="12" cy="12" r="4"></circle>
              <circle cx="17.5" cy="6.5" r="1.5"></circle>
            </svg>
          </a>

          <a href="#" class="text-[#004724] hover:text-[#003718] transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231z"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- KOLOM 2: Kontak -->
      <div class="space-y-3">
        <h3 class="font-bold text-[#004724] text-lg mb-4 font-poppins">Kontak</h3>

        <p class="text-[#004724] text-sm"><strong>Telp:</strong> 021-29079177</p>
        <p class="text-[#004724] text-sm"><strong>Fax:</strong> 021-29079277</p>

        <p class="text-[#004724] text-sm">
          <strong>Email Redaksi:</strong><br />
          <a href="mailto:dokinfo.badilag@gmail.com" class="hover:underline">
            dokinfo.badilag@gmail.com
          </a>
        </p>

        <p class="text-[#004724] text-sm">
          <strong>Email Ditjen:</strong><br />
          <a href="mailto:ditjen.badilag@mahkamahagung.go.id" class="hover:underline">
            ditjen.badilag@mahkamahagung.go.id
          </a>
        </p>
      </div>

      <!-- KOLOM 3: Map -->
      <div class="space-y-4">
        <h3 class="font-bold text-[#004724] text-lg mb-4 font-poppins">Lokasi</h3>

        <div class="w-full h-64 rounded-lg overflow-hidden shadow-md">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.615653219365!2d106.8748773!3d-6.182166799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4f2285d228b%3A0xca048b48825985f8!2sGedung%20Sekretariat%20Mahkamah%20Agung%20Republik%20Indonesia!5e0!3m2!1sid!2sid!4v1764209284035!5m2!1sid!2sid"
            class="w-full h-full"
            style="border:0;" 
            loading="lazy"
            allowfullscreen=""
          ></iframe>
        </div>

        <!-- ALAMAT DENGAN WARNA YANG DIMINTA -->
        <p class="text-[#004724] text-sm">
          Jl. Jend. Ahmad Yani Kav. 58 ByPass<br />
          Jakarta Pusat
        </p>
      </div>

    </div>
  </div>

  <!-- GARIS FULL WIDTH & COPYRIGHT -->
  <div class="w-full border-t border-[#003718]/40"></div>

  <div class="text-center py-4 text-[#003718] text-sm">
    © 2025 Direktorat Jenderal Badan Peradilan Agama. All rights reserved.
  </div>
</footer>
</template>

<script setup>
import { Head, Link, usePage, useForm, router } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";

const page = usePage();
const form = useForm({});
const logout = () => form.post(route("logout"));

const isMobileMenuOpen = ref(false);

// Refs untuk intersection observer - Benefits
const benefitsTitle = ref(null);
const benefitsCircle = ref(null);
const card1 = ref(null);
const card2 = ref(null);
const card3 = ref(null);

const isTitleVisible = ref(false);
const isCircleVisible = ref(false);
const isCard1Visible = ref(false);
const isCard2Visible = ref(false);
const isCard3Visible = ref(false);

// Refs untuk intersection observer - Lowongan
const lowonganTitle = ref(null);
const lowonganCircleTop = ref(null);
const lowonganCircleBottom = ref(null);
const lowonganCard1 = ref(null);
const lowonganCard2 = ref(null);
const lowonganCard3 = ref(null);

const isLowonganTitleVisible = ref(false);
const isLowonganCircleTopVisible = ref(false);
const isLowonganCircleBottomVisible = ref(false);
const isLowonganCard1Visible = ref(false);
const isLowonganCard2Visible = ref(false);
const isLowonganCard3Visible = ref(false);

// Refs untuk footer
const footer = ref(null);
const isFooterVisible = ref(false);

let observer;

// Function untuk navigasi ke halaman lowongan
const goToLowongan = () => {
  router.visit(route('lowongan.index'));
};

onMounted(() => {
  // Setup Intersection Observer
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // Benefits section
          if (entry.target === benefitsTitle.value) {
            isTitleVisible.value = true;
            setTimeout(() => {
              isCircleVisible.value = true;
            }, 300);
          }
          if (entry.target === card1.value) isCard1Visible.value = true;
          if (entry.target === card2.value) isCard2Visible.value = true;
          if (entry.target === card3.value) isCard3Visible.value = true;

          // Lowongan section
          if (entry.target === lowonganTitle.value) {
            isLowonganTitleVisible.value = true;
          }
          if (entry.target === lowonganCircleTop.value) {
            isLowonganCircleTopVisible.value = true;
            setTimeout(() => {
              isLowonganCircleBottomVisible.value = true;
            }, 200);
          }
          if (entry.target === lowonganCard1.value) isLowonganCard1Visible.value = true;
          if (entry.target === lowonganCard2.value) isLowonganCard2Visible.value = true;
          if (entry.target === lowonganCard3.value) isLowonganCard3Visible.value = true;

          // Footer
          if (entry.target === footer.value) isFooterVisible.value = true;
        }
      });
    },
    {
      threshold: 0.2,
      rootMargin: "0px 0px -50px 0px"
    }
  );

  // Observe elements - Benefits
  if (benefitsTitle.value) observer.observe(benefitsTitle.value);
  if (card1.value) observer.observe(card1.value);
  if (card2.value) observer.observe(card2.value);
  if (card3.value) observer.observe(card3.value);

  // Observe elements - Lowongan
  if (lowonganTitle.value) observer.observe(lowonganTitle.value);
  if (lowonganCircleTop.value) observer.observe(lowonganCircleTop.value);
  if (lowonganCard1.value) observer.observe(lowonganCard1.value);
  if (lowonganCard2.value) observer.observe(lowonganCard2.value);
  if (lowonganCard3.value) observer.observe(lowonganCard3.value);

  // Observe footer
  if (footer.value) observer.observe(footer.value);
});

onUnmounted(() => {
  if (observer) {
    observer.disconnect();
  }
});
</script>

<style>
/* NAVBAR: turun dari atas */
@keyframes slideDownFade {
  0% {
    opacity: 0;
    transform: translateY(-30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.nav-animate {
  opacity: 0;
  animation: slideDownFade 0.7s ease-out forwards;
}

/* HERO TEKS: masuk dari kiri */
@keyframes slideLeftFade {
  0% {
    opacity: 0;
    transform: translateX(-40px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.hero-left-animate {
  opacity: 0;
  animation: slideLeftFade 1s ease-out 1s forwards;
}

/* ORANG + LINGKARAN: masuk dari kanan (desktop) */
@keyframes slideRightFade {
  0% {
    opacity: 0;
    transform: translateX(40px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.hero-right-animate {
  opacity: 0;
  animation: slideRightFade 1s ease-out 1s forwards;
}

/* BENEFITS ANIMATIONS */
.benefits-title-animate {
  opacity: 0;
  transform: translateY(-50px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.benefits-title-visible {
  opacity: 1;
  transform: translateY(0);
}

.benefits-circle-animate {
  opacity: 0;
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.benefits-circle-visible {
  opacity: 1;
}

.benefits-card-animate {
  opacity: 0;
  transform: translateY(60px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.benefits-card-visible {
  opacity: 1;
  transform: translateY(0);
}

/* LOWONGAN ANIMATIONS */
.lowongan-title-animate {
  opacity: 0;
  transform: translateY(-50px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.lowongan-title-visible {
  opacity: 1;
  transform: translateY(0);
}

.lowongan-circle-top-animate {
  opacity: 0;
  transform: translateX(-100px) translateY(-50px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.lowongan-circle-bottom-animate {
  opacity: 0;
  transform: translateX(100px) translateY(50px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.lowongan-circle-visible {
  opacity: 1;
  transform: translate(0, 0);
}

.lowongan-card-animate {
  opacity: 0;
  transform: translateY(60px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.lowongan-card-visible {
  opacity: 1;
  transform: translateY(0);
}

/* FOOTER ANIMATIONS */
.footer-animate {
  opacity: 0;
  transform: translateY(50px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.footer-visible {
  opacity: 1;
  transform: translateY(0);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .benefits-title-animate,
  .lowongan-title-animate {
    transform: translateY(-30px);
  }
  
  .benefits-card-animate,
  .lowongan-card-animate {
    transform: translateY(40px);
  }
  
  .lowongan-circle-top-animate {
    transform: translateX(-50px) translateY(-30px);
  }
  
  .lowongan-circle-bottom-animate {
    transform: translateX(50px) translateY(30px);
  }
}
</style>