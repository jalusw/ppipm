<script setup>
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const deleteStatus = (id) =>
    router.delete(route("management.status-penanaman-modals.destroy", id));

const props = defineProps({
    statuses: Object,
});
</script>

<template>
    <Head title="Daftar Status Penanaman Modal" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">
            Daftar Status Penanaman Modal
        </h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Status Penanaman Modal</li>
                <li>
                    <Link :href="route('management.status-penanaman-modals')"
                        >Daftar Status Penanaman Modal</Link
                    >
                </li>
            </ul>
        </div>
        <div>
            <table class="table mt-8">
                <thead>
                    <tr>
                        <th class="w-[25%]">Nama</th>
                        <th class="w-[50%]">Deskripsi</th>
                        <th class="w-[10%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="hover"
                        v-for="status in statuses"
                        :key="status.id"
                    >
                        <td>{{ status.name }}</td>
                        <td>{{ status.description }}</td>
                        <td class="flex items-center space-x-2">
                            <Link
                                class="btn btn-warning btn-sm"
                                :href="
                                    route(
                                        'management.status-penanaman-modals.edit',
                                        status.id
                                    )
                                "
                                title="Ubah"
                            >
                                <EditIcon />
                            </Link>
                            <button
                                class="btn btn-error btn-sm"
                                title="Hapus"
                                @click="deleteStatus(status.id)"
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
