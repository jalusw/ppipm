<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import KeyIcon from "../../Components/Icons/KeyIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteUserButtonHandler = (id) =>
    confirm("Yakin Ingin Hapus User Ini ? ") &&
    router.delete(route("management.users.destroy", id));

defineProps({
    users: Object,
});
</script>
<template>
    <Head title="Daftar Pengguna" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Pengguna</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Pengguna</li>
                <li>
                    <Link :href="route('management.users')"
                        >Daftar Pengguna</Link
                    >
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[45%]">Nama</th>
                        <th class="w-[25%]">Username</th>
                        <th class="w-[20%]">Status</th>
                        <th class="w-[10%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover" v-for="user in users" :key="user.id">
                        <td>{{ user.name }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.is_active ? "Aktif" : "Tidak Aktif" }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="route('authorize', user.id)"
                                title="Kontrol Hak Akses"
                            >
                                <KeyIcon />
                            </Link>
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="route('management.users.edit', user.id)"
                                title="Ubah"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Hapus"
                                @click="deleteUserButtonHandler(user.id)"
                            >
                                <TrashIcon />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
