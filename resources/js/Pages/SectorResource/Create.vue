<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createSectorForm = useForm({
    name: "",
    code: "",
    description: "",
    category: null,
});

const props = defineProps({
    errors: Object,
    categories: Object,
});

const createSectorFormSubmitHandler = () =>
    router.post(route("management.sectors.store"), createSectorForm);
</script>
<template>
    <Head title="Buat Sektor" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Sektor</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Sektor</li>
                <li>
                    <Link :href="route('management.sectors.create')"
                        >Buat Sector</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createSectorFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section>
                        <label for="input-name"> Nama Sektor </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukan Nama Sektor"
                            v-model="createSectorForm.name"
                        />
                        <p class="text-error" v-if="errors.name">
                            {{ errors.name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-code"> Nama Kode </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-code"
                            type="text"
                            placeholder="Mohon Masukan Kode Sektor"
                            v-model="createSectorForm.code"
                        />
                        <p class="text-error" v-if="errors.code">
                            {{ errors.code }}
                        </p>
                    </section>
                    <section>
                        <label for="input-category">Kategorikan Sebagai</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-category"
                            v-model="createSectorForm.category"
                        >
                            <option
                                v-for="category in categories"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </section>
                    <section class="col-span-2">
                        <label for="input-code"> Deskripsi </label>
                        <textarea
                            class="textarea textarea-bordered w-full"
                            id="input-code"
                            type="text"
                            placeholder="Mohon Masukan Kode Sektor"
                            v-model="createSectorForm.description"
                        ></textarea>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
