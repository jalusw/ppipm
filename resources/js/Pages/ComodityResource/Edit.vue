<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const updateComodityForm = useForm({
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
        (sector) => sector.id == updateComodityForm.sector_id
    )[0];
    subSectors.value = selectedSector.sub_sectors;
};

const props = defineProps({
    comodity: Object,
    categories: Object,
    errors: Object,
    sectors: Object,
    sub_sectors: Object,
});

onMounted(() => {
    const { comodity } = props;
    updateComodityForm.name = comodity.name;
    updateComodityForm.sub_sector_id = comodity.sub_sector.id;
    updateComodityForm.sector_id = comodity.sub_sector.sector.id;
    updateComodityForm.description = comodity.description;
    updateComodityForm.category = comodity.category.master_category_id;
    sectorSelectedHandler();
});

const updateComodityFormSubmitHandler = () =>
    router.post(route("management.comodities.update", props.comodity.id), {
        _method: "put",
        forceFormData: true,
        name: updateComodityForm.name,
        sub_sector_id: updateComodityForm.sub_sector_id,
        description: updateComodityForm.description,
        image: updateComodityForm.image,
        category: updateComodityForm.category,
    });
</script>
<template>
    <Head title="Edit Komoditas" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Edit Komoditas</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Komoditas</li>
                <li>
                    <Link
                        :href="route('management.comodities.edit', comodity.id)"
                        >Edit Komoditas</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="updateComodityFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section>
                        <label for="input-name">Nama Komoditas</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Masukan Nama Komoditas"
                            v-model="updateComodityForm.name"
                        />
                        <p class="text-error" v-if="errors.name">
                            {{ errors.name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-image">Gambar</label>
                        <input
                            class="file-input file-input-bordered w-full"
                            id="input-file"
                            type="file"
                            @input="
                                updateComodityForm.image =
                                    $event.target.files[0]
                            "
                        />
                    </section>
                    <section>
                        <label for="input-sektor">Sektor</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-sektor"
                            v-model="updateComodityForm.sector_id"
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
                            v-model="updateComodityForm.sub_sector_id"
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
                        <label for="input-category">Kelompokan Sebagai</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-category"
                            v-model="updateComodityForm.category"
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
                            v-model="updateComodityForm.description"
                        ></textarea>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
