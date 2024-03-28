<script setup>
import UnArchiveIcon from "../../Components/Icons/UnArchiveIcon.vue";
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const props = defineProps({
    comodities: Object,
});
const deleteComodityButtonHandler = (id) =>
    router.delete(route("management.comodities.destroy", id));
</script>
<template>
    <Head title="Arsip Komoditas" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Arsip Komoditas</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Komoditas</li>
                <li>
                    <Link :href="route('management.comodities')"
                        >Daftar Komoditas</Link
                    >
                </li>
                <li>
                    <Link :href="route('management.comodities.archived')">
                        Arsip
                    </Link>
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[15%]">Nama</th>
                        <th class="w-[20%]">Sub Sektor</th>
                        <th class="w-[25%]">Deskripsi</th>
                        <th class="w-[10%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="hover"
                        v-for="comodity in comodities"
                        :key="comodity.id"
                    >
                        <td>{{ comodity.name }}</td>
                        <td>{{ comodity.sub_sector.name }}</td>
                        <td>{{ comodity.description }}</td>
                        <td class="flex items-center space-x-2">
                            <button
                                class="btn btn-warning btn-sm"
                                @click="
                                    router.post(
                                        route(
                                            'management.comodities.archive',
                                            comodity.id
                                        )
                                    )
                                "
                                title="Keluarkan Dari Arsip"
                            >
                                <UnArchiveIcon />
                            </button>

                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.comodities.edit',
                                        comodity.id
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
                                    deleteComodityButtonHandler(comodity.id)
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
