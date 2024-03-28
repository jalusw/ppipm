<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createMasterCategoryForm = useForm({
    name: "",
});

const props = defineProps({
    errors: Object,
});

const createMasterCategoryFormSubmitHandler = () =>
    router.post(
        route("management.master-categories.store"),
        createMasterCategoryForm
    );
</script>

<template>
    <Head title="Buat  Kategori" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Kategori</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kategori</li>
                <li>
                    <Link :href="route('management.master-categories.create')"
                        >Buat Kategori</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createMasterCategoryFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama Kategori</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukan Nama  Kategori"
                            v-model="createMasterCategoryForm.name"
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
