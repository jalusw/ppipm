<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const editUserForm = useForm({
    name: "",
    username: "",
    password: "",
    password_confirmation: "",
    status: true,
});

const editUserFormSubmitHandler = () =>
    router.put(route("management.users.update", props.user.id), editUserForm);

const props = defineProps({ user: Object, errors: Object });

onMounted(() => {
    const { user } = props;
    editUserForm.name = user.name;
    editUserForm.username = user.username;
    editUserForm.password = user.password;
    editUserForm.status = user.is_active;
});
</script>
<template>
    <Head title="Ubah Pengguna" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Ubah Pengguna</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Pengguna</li>
                <li>
                    <Link :href="route('management.users.edit', props.user.id)"
                        >Ubah Pengguna</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="editUserFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section>
                        <label for="input-nama-lengkap">Nama Lengkap </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-nama-lengkap"
                            type="text"
                            placeholder="Mohon Masukan Nama Lengkap"
                            v-model="editUserForm.name"
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
                            v-model="editUserForm.username"
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
                            v-model="editUserForm.password"
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
                            v-model="editUserForm.password_confirmation"
                        />
                    </section>
                    <section class="flex space-x-2">
                        <input
                            class="checkbox"
                            id="input-status"
                            type="checkbox"
                            v-model="editUserForm.status"
                            :checked="editUserForm.status"
                        />
                        <label for="input-status">Aktifkan User</label>
                    </section>
                </div>
                <button class="btn btn-outline btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
