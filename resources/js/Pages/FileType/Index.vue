<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteFileTypeHandler = (id) =>
    router.delete(route("management.file-types.destroy", id));

const props = defineProps({
    fileTypes: Object,
});
</script>

<template>
    <Head title="Manajamen Tipe File" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Tipe File</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Tipe File</li>
                <li>
                    <Link :href="route('management.file-types')"
                        >Daftar Tipe File</Link
                    >
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[25%]">Nama</th>
                        <th class="w-[10%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="fileType in fileTypes" :key="fileType.id">
                        <td>{{ fileType.name }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.file-types.edit',
                                        fileType.id
                                    )
                                "
                                title="Edit"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Delete"
                                @click="deleteFileTypeHandler(fileType.id)"
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
