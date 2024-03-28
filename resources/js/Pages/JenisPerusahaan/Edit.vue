<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const updateJenisPerusahaanForm = useForm({
    name: "",
    description: "",
});

const props = defineProps({
    jenisPerusahaan: Object,
    errors: Object,
});

onMounted(() => {
    const { jenisPerusahaan } = props;
    updateJenisPerusahaanForm.name = jenisPerusahaan.name;
    updateJenisPerusahaanForm.description = jenisPerusahaan.description;
});

const updateJenisPerusahaanFormSubmitHandler = () =>
    router.put(
        route("management.jenis-perusahaans.update", props.jenisPerusahaan.id),
        updateJenisPerusahaanForm
    );
</script>

<template>
    <Head title="Edit Jenis Perusahaan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Edit Jenis Perusahaan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Jenis Perusahaan</li>
                <li>
                    <Link :href="route('management.jenis-perusahaans.create')"
                        >Edit Jenis Perusahaan</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="updateJenisPerusahaanFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama Jenis Perusahaan</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukkan Nama Jenis Perusahaan"
                            v-model="updateJenisPerusahaanForm.name"
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
                            v-model="updateJenisPerusahaanForm.description"
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
