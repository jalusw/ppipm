<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteSectorButtonHandler = (id) =>
    router.delete(route("management.sectors.destroy", id));

const props = defineProps({
    sectors: Object,
});
</script>
<template>
    <Head title="Daftar Sektor" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Sektor</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Sektor</li>
                <li>
                    <Link :href="route('management.sectors')"
                        >Daftar Sektor</Link
                    >
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[25%]">Nama</th>
                        <th class="w-[25%]">Kode</th>
                        <th class="w-[40%]">Kategori</th>
                        <th class="w-[10%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="hover"
                        v-for="sector in sectors"
                        :key="sector.id"
                    >
                        <td>{{ sector.name }}</td>
                        <td>{{ sector.code }}</td>
                        <td>{{ sector.category?.master_category?.name }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="'/management/sectors/edit/' + sector.id"
                                title="Ubah"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Hapus"
                                @click="deleteSectorButtonHandler(sector.id)"
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
