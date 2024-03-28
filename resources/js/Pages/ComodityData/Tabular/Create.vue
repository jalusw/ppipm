<script setup>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import TableEditor from "../../../Components/TableEditor.vue";
import { Head, router, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const formData = useForm({
    title: "",
    description: "",
    source: "",
    tableData: { columns: [], rows: [] },
});

const saveTableData = (tableData) => (formData.tableData = tableData);
const submitData = () => {
    router.post(
        route("management.comodities.data-tabular.store", props.comodity.id),
        formData
    );
};

const props = defineProps({
    comodity: Object,
    tabular_data: Object,
    errors: Object,
});
</script>
<template>
    <Head title="Data Tabular Komoditias" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Data Tabular Komoditas</h1>
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
            <form @submit.prevent="submitData">
                <section class="my-4">
                    <label for="input-title">Judul Data</label>
                    <input
                        class="input input-bordered input-md w-full mt-2"
                        id="input-title"
                        type="text"
                        placeholder="Mohon Masukan Judul Data"
                        v-model="formData.title"
                    />
                    <p class="text-error" v-if="errors.title">
                        {{ errors.title }}
                    </p>
                </section>
                <section class="my-4">
                    <label for="input-source">Sumber Data</label>
                    <input
                        class="input input-bordered input-md w-full mt-2"
                        id="input-title"
                        type="text"
                        placeholder="Mohon Masukan Sumber Data "
                        v-model="formData.source"
                    />
                    <p class="text-error" v-if="errors.source">
                        {{ errors.source }}
                    </p>
                </section>
                <section class="my-4">
                    <label for="input-description">Deskripsi</label>
                    <textarea
                        class="textarea textarea-bordered w-full"
                        id="input-description"
                        placeholder="Mohon Masukan Deskripsi"
                        v-model="formData.description"
                    ></textarea>
                </section>
                <hr />
                <section class="my-8">
                    <strong>Table</strong>
                    <TableEditor :saveData="saveTableData"></TableEditor>
                </section>
                <section class="mt-8">
                    <button class="btn btn-primary" type="submit">
                        Simpan
                    </button>
                </section>
            </form>
        </div>
    </AdminLayout>
</template>
