<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

const createStatusForm = useForm({
    name: "",
    description: "",
});

const props = defineProps({
    errors: Object,
});

const createStatusFormSubmitHandler = () =>
    router.post(
        route("management.status-penanaman-modals.store"),
        createStatusForm
    );
</script>

<template>
    <Head title="Buat Status Penanaman Modal" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">
            Buat Status Penanaman Modal
        </h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Status Penanaman Modal</li>
                <li>
                    <Link
                        :href="
                            route('management.status-penanaman-modals.create')
                        "
                        >Buat Status Penanaman Modal</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createStatusFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukkan Nama"
                            v-model="createStatusForm.name"
                        />
                        <p class="text-error" v-if="errors.name">
                            {{ errors.name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-description">Deskripsi</label>
                        <textarea
                            class="textarea textarea-bordered w-full"
                            id="input-description"
                            placeholder="Mohon Masukkan Deskripsi"
                            v-model="createStatusForm.description"
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
