<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const loginForm = useForm({
    username: "",
    password: "",
});

const loginSubmitHandler = () => router.post(route("authenticate"), loginForm);
onMounted(() => {});
</script>
<template>
    <Head title="Login" />
    <main class="bg-primary h-[100vh] pt-20">
        <div
            class="container mx-auto px-8 py-16 max-w-[500px] bg-white rounded-2xl"
        >
            <div class="prose">
                <h1 class="text-primary m-0">Masuk</h1>
                <p class="mt-2">Mohon Masuk Untuk Melanjutkan</p>
            </div>
            <form
                class="mt-8"
                method="POST"
                @submit.prevent="loginSubmitHandler"
            >
                <section class="my-2">
                    <label class="text-slate-500 font-bold" for="username-input"
                        >Nama Pengguna</label
                    >
                    <input
                        class="input input-bordered w-full mt-2"
                        id="username-input"
                        type="text"
                        placeholder="Mohon Masukan Nama Pengguna"
                        v-model="loginForm.username"
                    />
                </section>
                <section class="my-2">
                    <label class="text-slate-500 font-bold" for="password-input"
                        >Kata Sandi</label
                    >
                    <input
                        class="input input-bordered w-full mt-2"
                        id="password-input"
                        type="password"
                        placeholder="Mohon Masukan Password"
                        v-model="loginForm.password"
                    />
                </section>
                <button class="btn btn-primary btn-outline mt-8" type="submit">
                    Masuk
                </button>
            </form>
        </div>
    </main>
</template>
