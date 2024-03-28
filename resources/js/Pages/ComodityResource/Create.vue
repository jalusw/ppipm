<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const createComodityForm = useForm({
    name: "",
    sector_id: null,
    sub_sector_id: null,
    description: "",
    image: null,
    category: null,
});

let subSectors = ref([]);

const sectorSelectedHandler = () => {
    const selectedSector = props.sectors.filter(
        (sector) => sector.id == createComodityForm.sector_id
    )[0];
    subSectors.value = selectedSector.sub_sectors;
};

const props = defineProps({
    errors: Object,
    sectors: Object,
    categories: Object,
});

const createComodityFormSubmitHandler = () =>
    router.post(route("management.comodities.store"), createComodityForm, {
        forceFormData: true,
    });
</script>
<template>
    <Head title="Buat Komoditas" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Komoditas</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Komoditas</li>
                <li>
                    <Link :href="route('management.comodities.create')"
                        >Buat Komoditas</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="createComodityFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section>
                        <label for="input-name">Nama Komoditas</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Masukan Nama Komoditas"
                            v-model="createComodityForm.name"
                        />
                        <p class="text-error" v-if="errors.name">
                            {{ errors.name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-image">Gambar</label>
                        <input
                            class="w-full file-input file-input-bordered"
                            type="file"
                            @input="
                                createComodityForm.image =
                                    $event.target.files[0]
                            "
                        />
                    </section>
                    <section>
                        <label for="input-sektor">Sektor</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-sektor"
                            v-model="createComodityForm.sector_id"
                            @change.prevent="sectorSelectedHandler"
                        >
                            <option
                                v-for="sector in sectors"
                                :value="sector.id"
                            >
                                {{ sector.name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-sub-sektor">Sub Sektor</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-sub-sektor"
                            v-model="createComodityForm.sub_sector_id"
                        >
                            <option
                                v-for="subSector in subSectors"
                                :value="subSector.id"
                            >
                                {{ subSector.name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-category">Kategorikan Sebagai</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-category"
                            v-model="createComodityForm.category"
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
                        <label for="input-description"
                            >Deskripsi Komoditas
                        </label>
                        <textarea
                            class="textarea textarea-bordered w-full"
                            id="input-description"
                            placeholder="Masukan Deskripsi Komoditas"
                            v-model="createComodityForm.description"
                        ></textarea>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
