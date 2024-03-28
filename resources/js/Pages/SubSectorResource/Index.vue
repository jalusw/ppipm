<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deletePermissionButtonHandler = (id) =>
    router.delete(route("management.sub-sectors.destroy", id));

const props = defineProps({
    sub_sectors: Object,
});
</script>
<template>
    <Head title="Daftar Sub Sektor" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Sub Sektor</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Sub Sektor</li>
                <li>
                    <Link :href="route('management.sub-sectors')"
                        >Daftar Sub Sektor</Link
                    >
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[25%]">Nama</th>
                        <th class="w-[10%]">Sektor</th>
                        <th class="w-[25%]">Kode</th>
                        <th class="w-[30%]">Kategori</th>
                        <th class="w-[10%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="hover"
                        v-for="subSector in sub_sectors"
                        :key="subSector.id"
                    >
                        <td>{{ subSector.name }}</td>
                        <td>{{ subSector.sector.name }}</td>
                        <td>{{ subSector.code }}</td>
                        <td>{{ subSector.category?.master_category?.name }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.sub-sectors.edit',
                                        subSector.id
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
                                    deletePermissionButtonHandler(subSector.id)
                                "
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
