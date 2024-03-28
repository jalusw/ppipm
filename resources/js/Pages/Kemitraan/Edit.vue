<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const kemitraanForm = useForm({
    umkm_id: null,
    perusahaan_id: null,
    partnership_form: "",
    description: "",
    start_of_partnership: null,
    end_of_partnership: null,
    partnership_status: "Aktif",
});

const props = defineProps({
    kemitraan: Object,
    perusahaans: Object,
    umkms: Object,
    errors: Object,
});

const submit = () =>
    router.put(
        route("management.kemitraans.update", props.kemitraan.id),
        kemitraanForm
    );

onMounted(() => {
    kemitraanForm.umkm_id = props.kemitraan.umkm_id;
    kemitraanForm.perusahaan_id = props.kemitraan.perusahaan_id;
    kemitraanForm.start_of_partnership = props.kemitraan.start_of_partnership;
    kemitraanForm.end_of_partnership = props.kemitraan.end_of_partnership;
    kemitraanForm.partnership_form = props.kemitraan.partnership_form;
    kemitraanForm.description = props.kemitraan.description;
});
</script>

<template>
    <Head title="Edit Kemitraan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Edit Kemitraan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kemitraan</li>
                <li>
                    <Link
                        :href="
                            route(
                                'management.kemitraans.edit',
                                props.kemitraan.id
                            )
                        "
                        >Edit Kemitraan</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="submit">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-4">
                    <section>
                        <label for="input-umkm">UMKM</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-umkm"
                            v-model="kemitraanForm.umkm_id"
                            disabled
                        >
                            <option v-for="umkm in umkms" :value="umkm.id">
                                {{ umkm.business_name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-perusahaan">Perusahaan</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-perusahaan"
                            v-model="kemitraanForm.perusahaan_id"
                            disabled
                        >
                            <option
                                v-for="perusahaan in perusahaans"
                                :value="perusahaan.id"
                            >
                                {{ perusahaan.business_name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-start"> Tanggal Awal </label>
                        <input
                            class="input input-bordered w-full"
                            type="date"
                            v-model="kemitraanForm.start_of_partnership"
                        />
                    </section>
                    <section>
                        <label for="input-start"> Tanggal Akhir </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-start"
                            type="date"
                            v-model="kemitraanForm.end_of_partnership"
                        />
                    </section>
                    <section>
                        <label for="input-end"> Bentuk Kemitraan </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-end"
                            type="text"
                            v-model="kemitraanForm.partnership_form"
                        />
                    </section>
                    <section>
                        <label for="input-status">Status Kemitraan</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-perusahaan"
                            v-model="kemitraanForm.partnership_status"
                        >
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
                    </section>
                    <section class="md:col-span-2">
                        <label for="input-description"
                            >Keterangan Kemitraan</label
                        >
                        <textarea
                            class="textarea textarea-bordered w-full"
                            id="input-description"
                            v-model="kemitraanForm.description"
                        ></textarea>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
