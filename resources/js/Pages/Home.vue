<script setup>
import { Head } from "@inertiajs/vue3";
import Footer from "../Components/Footer.vue";
import Navbar from "../Components/Navbar.vue";
</script>

<template>
    <Head title="Inovasi PPIPM | DPMPTSP Kabupaten Tapin" />
    <Navbar />
    <a class="btn btn-primary absolute top-[-100%] focus:top-0" href="#main"
        >Lompat Ke Konten Utama</a
    >
    <header class="py-32 bg-primary">
        <div class="container">
            <div class="">
                <img
                    class="w-full max-w-[150px] mx-auto"
                    src="/Lambang_Kabupaten_Tapin.png"
                    alt="Lambang Kabupaten Tapin"
                    srcset=""
                    width="150"
                    height="250"
                />
            </div>
            <div class="prose mx-auto text-center mt-8">
                <h1 class="my-4 leading-tight">
                    <span class="text-white"> PPIPM </span>
                </h1>
                <p class="my-0 mt-4 text-white leading-relaxed">
                    Selamat Datang Di Situs Inovasi Bidang Perencanaan dan
                    Pengembangan Iklim Penanaman Modal, Dinas Penanaman Modal
                    dan Pelayanan Terpadu Satu Pintu Kabupaten Tapin
                </p>
            </div>
        </div>
    </header>

    <main id="main"></main>
    <Footer />
</template>
