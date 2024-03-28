<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const updateKelurahanForm = useForm({
    kecamatan_id: "",
    name: "",
});

const props = defineProps({
    kelurahan: Object,
    kecamatans: Object,
    errors: Object,
});

onMounted(() => {
    const { kelurahan } = props;
    updateKelurahanForm.kecamatan_id = kelurahan.kecamatan_id;
    updateKelurahanForm.name = kelurahan.name;
});

const updateKelurahanFormSubmitHandler = () =>
    router.put(
        route("management.kelurahans.update", props.kelurahan.id),
        updateKelurahanForm
    );
</script>

<template>
    <Head title="Edit Kelurahan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Edit Kelurahan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kelurahan</li>
                <li>
                    <Link :href="route('management.kelurahans.create')"
                        >Edit Kelurahan</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="updateKelurahanFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section class="">
                        <label for="input-kecamatan">Kecamatan</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-kecamatan"
                            v-model="updateKelurahanForm.kecamatan_id"
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
                            v-model="updateKelurahanForm.name"
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
