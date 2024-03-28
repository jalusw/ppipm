<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

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
    perusahaans: Object,
    umkms: Object,
    errors: Object,
});

const submit = () =>
    router.post(route("management.kemitraans.store"), kemitraanForm);
</script>

<template>
    <Head title="Buat Kemitraan" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Buat Kemitraan</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kemitraan</li>
                <li>
                    <Link :href="route('management.kemitraans.create')"
                        >Buat Kemitraan</Link
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
