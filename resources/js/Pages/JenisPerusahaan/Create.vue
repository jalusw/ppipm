<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createJenisPerusahaanForm = useForm({
    name: "",
    description: "",
});

const props = defineProps({
    errors: Object,
});

const createJenisPerusahaanFormSubmitHandler = () =>
    router.post(
        route("management.jenis-perusahaans.store"),
        createJenisPerusahaanForm
    );
</script>

<template>
    <Head title="Buat Jenis Perusahaan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Jenis Perusahaan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Jenis Perusahaan</li>
                <li>
                    <Link :href="route('management.jenis-perusahaans.create')"
                        >Buat Jenis Perusahaan</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createJenisPerusahaanFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama Jenis Perusahaan</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukkan Nama Jenis Perusahaan"
                            v-model="createJenisPerusahaanForm.name"
                        />
                        <p class="text-error" v-if="errors.name">
                            {{ errors.name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-description">Keterangan</label>
                        <textarea
                            class="textarea textarea-bordered w-full"
                            id="input-description"
                            placeholder="Mohon Masukkan Keterangan"
                            v-model="createJenisPerusahaanForm.description"
                        ></textarea>
                        <p class="text-error" v-if="errors.description">
                            {{ errors.description }}
                        </p>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
