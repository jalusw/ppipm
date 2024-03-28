<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const scrolled = ref(false);

window.addEventListener("scroll", () => {
    if (
        document.body.scrollTop > 40 ||
        document.documentElement.scrollTop > 40
    ) {
        scrolled.value = true;
        return;
    }
    scrolled.value = false;
    return;
});
</script>
<template>
    <div
        :class="
            scrolled
                ? 'transition bg-white fixed w-full shadow-border'
                : 'bg-primary text-white'
        "
    >
        <div class="container">
            <div class="navbar flex justify-between">
                <a
                    :class="`btn btn-ghost text-2xl ${
                        scrolled ? 'text-primary' : ''
                    }`"
                    >PPIPM</a
                >
                <ul class="menu menu-horizontal flex">
                    <li><Link href="/">Home</Link></li>
                    <li>
                        <Link href="#">Kemitraan</Link>
                    </li>
                    <li>
                        <Link href="#">Peluang Investasi</Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
