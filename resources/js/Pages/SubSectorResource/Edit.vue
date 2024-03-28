<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const updateSubSectorForm = useForm({
    sector_id: "",
    name: "",
    code: "",
    description: "",
    category: null,
});

const props = defineProps({
    sub_sector: Object,
    sectors: Object,
    categories: Object,
    errors: Object,
});

onMounted(() => {
    const { sub_sector } = props;
    updateSubSectorForm.sector_id = sub_sector.sector_id;
    updateSubSectorForm.name = sub_sector.name;
    updateSubSectorForm.code = sub_sector.code;
    updateSubSectorForm.description = sub_sector.description;
    updateSubSectorForm.category =
        sub_sector?.category?.master_category.id || null;
});

const updateSubSectorFormSubmitHandler = () =>
    router.put(
        route("management.sub-sectors.update", props.sub_sector.id),
        updateSubSectorForm
    );
</script>
<template>
    <Head title="Edit Sub Sektor" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Edit Sub Sektor Sektor</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Sub Sektor</li>
                <li>
                    <Link :href="route('management.sub-sectors.create')"
                        >Edit Sub Sector</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="updateSubSectorFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section class="col-span-2">
                        <label for="input-sector">Sektor</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-sector"
                            v-model="updateSubSectorForm.sector_id"
                        >
                            <option value="">Pilih Sektor</option>
                            <option
                                v-for="sector in sectors"
                                :value="sector.id"
                                :selected="
                                    sector.id == updateSubSectorForm.sector_id
                                "
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
                            v-model="updateSubSectorForm.name"
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
                            v-model="updateSubSectorForm.code"
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
                            v-model="updateSubSectorForm.category"
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
                            v-model="updateSubSectorForm.description"
                        ></textarea>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
