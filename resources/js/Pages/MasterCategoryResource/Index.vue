<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteMasterCategoryButtonHandler = (id) =>
    router.delete(route("management.master-categories.destroy", id));

const props = defineProps({
    master_categories: Object,
});
</script>

<template>
    <Head title="Daftar  Kategori" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Daftar Kategori</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kategori</li>
                <li>
                    <Link :href="route('management.master-categories')"
                        >Daftar Kategori</Link
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
                        v-for="masterCategory in master_categories"
                        :key="masterCategory.id"
                    >
                        <td>{{ masterCategory.name }}</td>
                        <!-- Tambahkan kolom sesuai dengan kebutuhan -->
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.master-categories.edit',
                                        masterCategory.id
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
                                    deleteMasterCategoryButtonHandler(
                                        masterCategory.id
                                    )
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
