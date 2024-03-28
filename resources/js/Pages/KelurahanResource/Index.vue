<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import MoreVertIcon from "../../Components/Icons/MoreVertIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteKelurahan = (id) =>
    router.delete(route("management.kelurahans.destroy", id));

const props = defineProps({
    kelurahans: Object,
});
</script>

<template>
    <Head title="Daftar Kelurahan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Kelurahan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kelurahan</li>
                <li>
                    <Link :href="route('management.kelurahans')"
                        >Daftar Kelurahan</Link
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
                    <tr v-for="kelurahan in kelurahans" :key="kelurahan.id">
                        <td>{{ kelurahan.name }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.kelurahans.edit',
                                        kelurahan.id
                                    )
                                "
                                title="Ubah"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Hapus"
                                @click="deleteKelurahan(kelurahan.id)"
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
