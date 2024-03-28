<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const props = defineProps({
    permissions: Object,
});

const deletePermissionButtonHandler = (id) =>
    confirm("Yakin Ingin Menghapus Role Ini ? ") &&
    router.delete(route("management.permissions.destroy", id));
</script>
<template>
    <Head title="Daftar Hak Akses" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Hak Akses</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Hak Akses</li>
                <li>
                    <Link href="/permissions">Daftar Hak Akses</Link>
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[25%]">Nama</th>
                        <th class="w-[25%]">Kode Akses</th>
                        <th class="w-[40%]">Deskripsi</th>
                        <th class="w-[10%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="hover"
                        v-for="permission in permissions"
                        :key="permission.id"
                    >
                        <td>{{ permission.name }}</td>
                        <td>{{ permission.access_code }}</td>
                        <td>{{ permission.description }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.permissions.edit',
                                        permission.id
                                    )
                                "
                                title="Ubah"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Hapus"
                                @click="
                                    deletePermissionButtonHandler(permission.id)
                                "
                            >
                                <DeleteIcon />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
