<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deletePerusahaan = (id) =>
    router.delete(route("management.perusahaans.destroy", id));

const props = defineProps({
    perusahaans: Array,
});
</script>

<template>
    <Head title="Daftar Perusahaan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Perusahaan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Perusahaan</li>
                <li>
                    <Link :href="route('management.perusahaans')"
                        >Daftar Perusahaan</Link
                    >
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[20%]">Perusahaan</th>
                        <th class="w-[15%]">Email</th>
                        <th class="w-[15%]">Telepon</th>
                        <th class="w-[15%]">Alamat</th>
                        <th class="w-[20%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="perusahaan in perusahaans" :key="perusahaan.id">
                        <td>{{ perusahaan.business_name }}</td>
                        <td>{{ perusahaan.email }}</td>
                        <td>{{ perusahaan.phone_number }}</td>
                        <td>{{ perusahaan.address }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.perusahaans.edit',
                                        perusahaan.id
                                    )
                                "
                                title="Ubah"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Hapus"
                                @click="deletePerusahaan(perusahaan.id)"
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
