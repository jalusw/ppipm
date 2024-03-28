<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const updateKecamatanForm = useForm({
    name: "",
});

const props = defineProps({
    kecamatan: Object,
    errors: Object,
});

onMounted(() => {
    const { kecamatan } = props;
    updateKecamatanForm.name = kecamatan.name;
});

const updateKecamatanFormSubmitHandler = () =>
    router.put(
        route("management.kecamatans.update", props.kecamatan.id),
        updateKecamatanForm
    );
</script>

<template>
    <Head title="Edit Kecamatan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Edit Kecamatan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kecamatan</li>
                <li>
                    <Link :href="route('management.kecamatans.create')"
                        >Edit Kecamatan</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="updateKecamatanFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama Kecamatan</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukkan Nama Kecamatan"
                            v-model="updateKecamatanForm.name"
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
