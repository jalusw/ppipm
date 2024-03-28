<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteJenisPerusahaan = (id) =>
    router.delete(route("management.jenis-perusahaans.destroy", id));

const props = defineProps({
    jenisPerusahaans: Object,
});
</script>

<template>
    <Head title="Daftar Jenis Perusahaan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Jenis Perusahaan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Jenis Perusahaan</li>
                <li>
                    <Link :href="route('management.jenis-perusahaans')"
                        >Daftar Jenis Perusahaan</Link
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
                    <tr
                        class="hover"
                        v-for="jenisPerusahaan in jenisPerusahaans"
                        :key="jenisPerusahaan.id"
                    >
                        <td>{{ jenisPerusahaan.name }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.jenis-perusahaans.edit',
                                        jenisPerusahaan.id
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
                                    deleteJenisPerusahaan(jenisPerusahaan.id)
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
