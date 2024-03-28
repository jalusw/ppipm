<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteKemitraan = (id) =>
    router.delete(route("management.kemitraans.destroy", id));

const props = defineProps({
    daftar_kemitraan: Object,
});
</script>

<template>
    <Head title="Daftar Kemitraan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Kemitraan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kemitraan</li>
                <li>
                    <Link :href="route('management.kemitraans')"
                        >Daftar Kemitraan</Link
                    >
                </li>
            </ul>
        </div>
        <div>
            <div class="overflow-x-scroll">
                <table class="table mt-8">
                    <thead>
                        <tr>
                            <th class="min-w-[200px]">Bentuk Kerjasama</th>
                            <th class="min-w-[200px]">UMKM</th>
                            <th class="min-w-[200px]">Perusahaan</th>
                            <th class="min-w-[200px]">Tanggal Mulai</th>
                            <th class="min-w-[200px]">Tanggal Akhir</th>
                            <th class="min-w-[200px]">Status</th>
                            <th class="min-w-[200px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="hover"
                            v-for="kemitraan in daftar_kemitraan"
                            :key="kemitraan.id"
                        >
                            <td>{{ kemitraan.partnership_form }}</td>
                            <td>{{ kemitraan.umkm.business_name }}</td>
                            <td>{{ kemitraan.perusahaan.business_name }}</td>
                            <td>{{ kemitraan.start_of_partnership }}</td>
                            <td>{{ kemitraan.end_of_partnership }}</td>
                            <td>{{ kemitraan.partnership_status }}</td>
                            <td class="flex items-center space-x-2">
                                <Link
                                    class="btn btn-warning btn-sm"
                                    :href="
                                        route(
                                            'management.kemitraans.edit',
                                            kemitraan.id
                                        )
                                    "
                                    title="Ubah"
                                >
                                    <EditIcon />
                                </Link>
                                <button
                                    class="btn btn-error btn-sm"
                                    title="Hapus"
                                    @click="deleteKemitraan(kemitraan.id)"
                                >
                                    <TrashIcon />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
