<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createSubSectorForm = useForm({
    sector_id: "",
    name: "",
    code: "",
    description: "",
    category: null,
});

const props = defineProps({
    sectors: Object,
    errors: Object,
    categories: Object,
});

const createSubSectorFormSubmitHandler = () =>
    router.post(route("management.sub-sectors.store"), createSubSectorForm);
</script>
<template>
    <Head title="Buat Sub Sektor" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Sub Sektor Sektor</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Sub Sektor</li>
                <li>
                    <Link :href="route('management.sub-sectors.create')"
                        >Buat Sub Sector</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createSubSectorFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section class="col-span-2">
                        <label for="input-sector">Sektor</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-sector"
                            v-model="createSubSectorForm.sector_id"
                        >
                            <option value="">Pilih Sektor</option>
                            <option
                                v-for="sector in sectors"
                                :value="sector.id"
                            >
                                {{ sector.name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-name">Nama Sub Sektor </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukan Nama Sektor"
                            v-model="createSubSectorForm.name"
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
                            v-model="createSubSectorForm.code"
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
                            v-model="createSubSectorForm.category"
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
                            v-model="createSubSectorForm.description"
                        ></textarea>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
