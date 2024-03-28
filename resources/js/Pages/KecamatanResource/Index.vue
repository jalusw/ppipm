<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import MoreVertIcon from "../../Components/Icons/MoreVertIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteKecamatan = (id) =>
    router.delete(route("management.kecamatans.destroy", id));

const props = defineProps({
    kecamatans: Object,
});
</script>

<template>
    <Head title="Daftar Kecamatan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Kecamatan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kecamatan</li>
                <li>
                    <Link :href="route('management.kecamatans')"
                        >Daftar Kecamatan</Link
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
                        v-for="kecamatan in kecamatans"
                        :key="kecamatan.id"
                    >
                        <td>{{ kecamatan.name }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.kecamatans.edit',
                                        kecamatan.id
                                    )
                                "
                                title="Ubah"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Hapus"
                                @click="deleteKecamatan(kecamatan.id)"
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
