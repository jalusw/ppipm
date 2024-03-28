<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createKecamatanForm = useForm({
    name: "",
});

const props = defineProps({
    errors: Object,
});

const createKecamatanFormSubmitHandler = () =>
    router.post(route("management.kecamatans.store"), createKecamatanForm);
</script>

<template>
    <Head title="Buat Kecamatan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Kecamatan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kecamatan</li>
                <li>
                    <Link :href="route('management.kecamatans.create')"
                        >Buat Kecamatan</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createKecamatanFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama Kecamatan</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukan Nama Kecamatan"
                            v-model="createKecamatanForm.name"
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
