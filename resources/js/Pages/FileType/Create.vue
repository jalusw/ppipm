<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createFileTypeForm = useForm({
    name: "",
    description: "",
});

const props = defineProps({
    errors: Object,
});

const createFileTypeFormSubmitHandler = () =>
    router.post(route("management.file-types.store"), createFileTypeForm);
</script>

<template>
    <Head title="Buat Jenis File" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Jenis File</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Jenis File</li>
                <li>
                    <Link :href="route('management.file-types.create')"
                        >Buat Jenis File</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createFileTypeFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama Jenis File</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Masukkan Nama Jenis File"
                            v-model="createFileTypeForm.name"
                        />
                        <p class="text-error" v-if="errors.name">
                            {{ errors.name }}
                        </p>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
