<!-- resources/views/KelurahanResource/Create.vue -->

<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createKelurahanForm = useForm({
    kecamatan_id: "",
    name: "",
});

const props = defineProps({
    kecamatans: Object,
    errors: Object,
});

const createKelurahanFormSubmitHandler = () =>
    router.post(route("management.kelurahans.store"), createKelurahanForm);
</script>

<template>
    <Head title="Buat Kelurahan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Kelurahan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kelurahan</li>
                <li>
                    <Link :href="route('management.kelurahans.create')"
                        >Buat Kelurahan</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createKelurahanFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section class="">
                        <label for="input-kecamatan">Kecamatan</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-kecamatan"
                            v-model="createKelurahanForm.kecamatan_id"
                        >
                            <option value="">Pilih Kecamatan</option>
                            <option
                                v-for="kecamatan in kecamatans"
                                :value="kecamatan.id"
                            >
                                {{ kecamatan.name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-name">Nama Kelurahan</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukan Nama Kelurahan"
                            v-model="createKelurahanForm.name"
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
