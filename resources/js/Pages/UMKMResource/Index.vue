<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteUmkm = (id) => router.delete(route("management.umkms.destroy", id));

const props = defineProps({
    umkms: Array,
});
</script>

<template>
    <Head title="Daftar Umkm" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Umkm</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Umkm</li>
                <li>
                    <Link :href="route('management.umkms')">Daftar Umkm</Link>
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[15%]">NIB</th>
                        <th class="w-[20%]">Nama Usaha</th>
                        <th class="w-[15%]">Email</th>
                        <th class="w-[15%]">Telepon</th>
                        <th class="w-[15%]">KBLI</th>
                        <th class="w-[20%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="umkm in umkms" :key="umkm.id">
                        <td>{{ umkm.nib }}</td>
                        <td>{{ umkm.business_name }}</td>
                        <td>{{ umkm.email }}</td>
                        <td>{{ umkm.phone_number }}</td>
                        <td>{{ umkm.kbli }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="route('management.umkms.edit', umkm.id)"
                                title="Ubah"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Hapus"
                                @click="deleteUmkm(umkm.id)"
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
