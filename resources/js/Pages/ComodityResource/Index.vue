<script setup>
import ArchiveIcon from "../../Components/Icons/ArchiveIcon.vue";
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import ArticleIcon from "../../Components/Icons/ArticleIcon.vue";
import BarChartIcon from "../../Components/Icons/BarChartIcon.vue";
import MoreVertIcon from "../../Components/Icons/MoreVertIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const props = defineProps({
    comodities: Object,
});

const deleteComodityButtonHandler = (id) =>
    router.delete(route("management.comodities.destroy", id));
</script>
<template>
    <Head title="Daftar Komoditas" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Komoditas</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Komoditas</li>
                <li>
                    <Link :href="route('management.comodities')"
                        >Daftar Komoditas</Link
                    >
                </li>
            </ul>
        </div>
        <div>
            <table class="table table-zebra table-sm mt-8">
                <thead>
                    <tr>
                        <th class="w-[15%]">Nama</th>
                        <th class="w-[20%]">Sub Sektor</th>
                        <th class="w-[25%]">Kategori</th>
                        <th class="w-[5%]">Aksi</th>
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
                        <td>
                            {{ comodity.category?.master_category?.name }}
                        </td>
                        <td class="flex items-center space-x-2">
                            <details class="dropdown">
                                <summary class="m-1 btn btn-sm btn-primary">
                                    <MoreVertIcon />
                                </summary>
                                <ul
                                    class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52"
                                >
                                    <li>
                                        <Link
                                            :href="
                                                route(
                                                    'management.comodities.data',
                                                    comodity.id
                                                )
                                            "
                                        >
                                            Data Komoditas
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="
                                                route(
                                                    'management.comodities.article',
                                                    comodity.id
                                                )
                                            "
                                        >
                                            Artikel Komoditas
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="
                                                route(
                                                    'management.comodities.location',
                                                    comodity.id
                                                )
                                            "
                                        >
                                            Lokasi Komoditas
                                        </Link>
                                    </li>
                                </ul>
                            </details>

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
                                title="Arsipkan"
                            >
                                <ArchiveIcon />
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
