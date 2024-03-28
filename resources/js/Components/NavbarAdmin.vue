<script setup>
import { Link, router } from "@inertiajs/vue3";
const props = defineProps({
    toggleSidebar: Function,
});
const logoutHandler = () => {
    router.post("/logout");
};
</script>
<template>
    <nav>
        <div class="sticky-top-0">
            <div class="bg-base-100 shadow">
                <div class="">
                    <div class="navbar">
                        <section class="navbar-start">
                            <button
                                class="btn btn-ghost"
                                type="button"
                                @click="toggleSidebar"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h7"
                                    />
                                </svg>
                            </button>
                        </section>
                        <section class="navbar-end">
                            <ul class="menu menu-horizontal">
                                <li>
                                    <Link href="/">Beranda</Link>
                                </li>
                                <li>
                                    <button @click="logoutHandler">
                                        Logout
                                    </button>
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
