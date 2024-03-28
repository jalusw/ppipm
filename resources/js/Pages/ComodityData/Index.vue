<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, router, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import EditIcon from "../../Components/Icons/EditIcon.vue";
import TrashIcon from "../../Components/Icons/TrashIcon.vue";
const props = defineProps({
    comodity: Object,
});
const deleteComodityTabularData = (comodity) =>
    router.delete(
        route("management.comodities.data-tabular.destroy", comodity)
    );
</script>
<template>
    <Head title="Data Komoditias" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Data Komoditas</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Komoditas</li>
                <li>
                    <Link :href="route('management.comodities')"
                        >Daftar Komoditas</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('management.comodities.data', comodity.id)"
                        >Data Komoditas</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <section>
                <div class="flex items-center justify-between">
                    <h2 class="font-bold">Data Tabular</h2>
                    <Link
                        class="btn btn-sm btn-outline btn-primary"
                        :href="
                            route(
                                'management.comodities.data-tabular.create',
                                comodity.id
                            )
                        "
                        >Data Baru</Link
                    >
                </div>
                <table class="table table-zebra table-bordered">
                    <thead>
                        <tr>
                            <th class="w-[35%]">Judul</th>
                            <th class="w-[40%]">Sumber</th>
                            <th class="w-[15%]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="hover"
                            v-for="tabular in comodity.tabular_data"
                            :key="tabular.id"
                        >
                            <td>{{ tabular.title }}</td>
                            <td>{{ tabular.source }}</td>
                            <td>
                                <Link
                                    class="btn btn-warning btn-sm"
                                    :href="
                                        route(
                                            'management.comodities.data-tabular.edit',
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
                                        deleteComodityTabularData(comodity.id)
                                    "
                                >
                                    <TrashIcon />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </AdminLayout>
</template>
