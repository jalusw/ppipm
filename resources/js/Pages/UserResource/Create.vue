<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createUserForm = useForm({
    name: "",
    username: "",
    password: "",
    password_confirmation: "",
    status: true,
});

const createUserFormSubmitHandler = () =>
    router.post(route("management.users.create"), createUserForm);

defineProps({ errors: Object });
</script>
<template>
    <Head title="Buat Pengguna" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Pengguna</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Pengguna</li>
                <li>
                    <Link :href="route('management.users.create')"
                        >Buat Pengguna</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createUserFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section>
                        <label for="input-nama-lengkap">Nama Lengkap </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-nama-lengkap"
                            type="text"
                            placeholder="Mohon Masukan Nama Lengkap"
                            v-model="createUserForm.name"
                        />
                        <p class="text-error mt-2" v-if="errors.name">
                            {{ errors.name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-nama-pengguna">Nama Pengguna </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-nama-pengguna"
                            type="text"
                            placeholder="Mohon Masukan Nama Pengguna"
                            v-model="createUserForm.username"
                        />
                        <p class="text-error mt-2" v-if="errors.username">
                            {{ errors.username }}
                        </p>
                    </section>
                    <section>
                        <label for="input-password">Password</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-password"
                            type="password"
                            placeholder="Mohon Masukan Password"
                            v-model="createUserForm.password"
                        />
                        <p class="text-error mt-2" v-if="errors.password">
                            {{ errors.password }}
                        </p>
                    </section>
                    <section>
                        <label for="input-password-confirmation"
                            >Konfirmasi Password</label
                        >
                        <input
                            class="input input-bordered w-full"
                            id="input-password-confirmation"
                            type="password"
                            placeholder="Mohon Konfirmasi Password"
                            v-model="createUserForm.password_confirmation"
                        />
                    </section>
                    <section class="flex space-x-2">
                        <input
                            class="checkbox"
                            id="input-status"
                            type="checkbox"
                            v-model="createUserForm.status"
                        />
                        <label for="input-status">Aktifkan User</label>
                    </section>
                </div>
                <button class="btn btn-outline btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
