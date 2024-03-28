<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const umkmForm = useForm({
    nib: "",
    business_name: "",
    email: "",
    phone_number: "",
    kbli: "",
    address: "",
    capital: "",
    kecamatan_id: null,
    kelurahan_id: null,
    jenis_perusahaan_id: null,
    status_penanaman_modal_id: null,
    personal_data: {
        name: "",
        nik: "",
        place_of_birth: "",
        date_of_birth: "",
        gender: "",
        address: "",
        phone_number: "",
        email: "",
    },
});

const kelurahan = ref([]);

const selectKecamatanHandler = () => {
    if (umkmForm.kecamatan_id == null) return;
    const selectedKecamatan = props.kecamatan.filter(
        (kecamatan) => kecamatan.id == umkmForm.kecamatan_id
    )[0];
    kelurahan.value = selectedKecamatan.kelurahan;
};
const props = defineProps({
    errors: Object,
    umkm: Object,
    kecamatan: Array,
    jenis_perusahaan: Array,
    status_penanaman_modal: Array,
});

const umkmFormSubmitHandler = () => {
    router.put(route("management.umkms.update", props.umkm.id), umkmForm);
};

onMounted(() => {
    const { umkm } = props;
    console.log(umkm);
    umkmForm.nib = umkm.nib;
    umkmForm.business_name = umkm.business_name;
    umkmForm.email = umkm.email;
    umkmForm.phone_number = umkm.phone_number;
    umkmForm.kbli = umkm.kbli;
    umkmForm.address = umkm.address;
    umkmForm.capital = umkm.capital;
    umkmForm.kecamatan_id = umkm.kecamatan_id || null;
    umkmForm.kelurahan_id = umkm?.kelurahan?.id || null;
    umkmForm.jenis_perusahaan_id = umkm.jenis_perusahaan_id;
    umkmForm.status_penanaman_modal_id = umkm.status_penanaman_modal_id;
    umkmForm.personal_data.name = umkm.personal_data.name;
    umkmForm.personal_data.nik = umkm.personal_data.nik;
    umkmForm.personal_data.place_of_birth = umkm.personal_data.place_of_birth;
    umkmForm.personal_data.date_of_birth = umkm.personal_data.date_of_birth;
    umkmForm.personal_data.gender = umkm.personal_data.gender;
    umkmForm.personal_data.address = umkm.personal_data.address;
    umkmForm.personal_data.phone_number = umkm.personal_data.phone_number;
    umkmForm.personal_data.email = umkm.personal_data.email;

    selectKecamatanHandler();
});
</script>

<template>
    <Head title="Entry Data UMKM" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Entry Data UMKM</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Data UMKM</li>
                <li>
                    <Link :href="route('management.umkms.create')"
                        >Entry Data UMKM</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-4">
            <form @submit.prevent="umkmFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <h2 class="text-xl font-bold mt-6">Data Pemilik Usaha</h2>
                    <section>
                        <label for="input-name">Nama</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Masukkan Nama"
                            v-model="umkmForm.personal_data.name"
                        />
                        <p
                            class="text-error"
                            v-if="
                                errors.personal_data &&
                                errors.personal_data.name
                            "
                        >
                            {{ errors.personal_data.name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-nik">NIK</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-nik"
                            type="text"
                            placeholder="Masukkan NIK"
                            v-model="umkmForm.personal_data.nik"
                        />
                        <p
                            class="text-error"
                            v-if="
                                errors.personal_data && errors.personal_data.nik
                            "
                        >
                            {{ errors.personal_data.nik }}
                        </p>
                    </section>
                    <section>
                        <label for="input-place_of_birth">Tempat Lahir</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-place_of_birth"
                            type="text"
                            placeholder="Masukkan Tempat Lahir"
                            v-model="umkmForm.personal_data.place_of_birth"
                        />
                        <p
                            class="text-error"
                            v-if="
                                errors.personal_data &&
                                errors.personal_data.place_of_birth
                            "
                        >
                            {{ errors.personal_data.place_of_birth }}
                        </p>
                    </section>
                    <section>
                        <label for="input-date_of_birth">Tanggal Lahir</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-date_of_birth"
                            type="date"
                            v-model="umkmForm.personal_data.date_of_birth"
                        />
                        <p
                            class="text-error"
                            v-if="
                                errors.personal_data &&
                                errors.personal_data.date_of_birth
                            "
                        >
                            {{ errors.personal_data.date_of_birth }}
                        </p>
                    </section>
                    <section>
                        <label for="input-gender">Jenis Kelamin</label>
                        <select
                            class="select select-bordered w-full"
                            id="input-gender"
                            v-model="umkmForm.personal_data.gender"
                        >
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                        <p
                            class="text-error"
                            v-if="
                                errors.personal_data &&
                                errors.personal_data.gender
                            "
                        >
                            {{ errors.personal_data.gender }}
                        </p>
                    </section>
                    <section>
                        <label for="input-address_personal"
                            >Alamat Personal</label
                        >
                        <textarea
                            class="textarea textarea-bordered w-full"
                            id="input-address_personal"
                            placeholder="Masukkan Alamat Personal"
                            v-model="umkmForm.personal_data.address"
                        ></textarea>
                        <p
                            class="text-error"
                            v-if="
                                errors.personal_data &&
                                errors.personal_data.address
                            "
                        >
                            {{ errors.personal_data.address }}
                        </p>
                    </section>
                    <section>
                        <label for="input-phone_number_personal"
                            >Nomor Telepon Personal</label
                        >
                        <input
                            class="input input-bordered w-full"
                            id="input-phone_number_personal"
                            type="tel"
                            placeholder="Masukkan Nomor Telepon Personal"
                            v-model="umkmForm.personal_data.phone_number"
                        />
                        <p
                            class="text-error"
                            v-if="
                                errors.personal_data &&
                                errors.personal_data.phone_number
                            "
                        >
                            {{ errors.personal_data.phone_number }}
                        </p>
                    </section>
                    <section>
                        <label for="input-email_personal">Email Personal</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-email_personal"
                            type="email"
                            placeholder="Masukkan Email Personal"
                            v-model="umkmForm.personal_data.email"
                        />
                        <p
                            class="text-error"
                            v-if="
                                errors.personal_data &&
                                errors.personal_data.email
                            "
                        >
                            {{ errors.personal_data.email }}
                        </p>
                    </section>

                    <h2 class="text-xl font-bold">Data Usaha</h2>
                    <section>
                        <label for="input-nib">NIB</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-nib"
                            type="text"
                            placeholder="Masukkan NIB"
                            v-model="umkmForm.nib"
                        />
                        <p class="text-error" v-if="errors.nib">
                            {{ errors.nib }}
                        </p>
                    </section>
                    <section>
                        <label for="input-business_name">Nama Usaha</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-business_name"
                            type="text"
                            placeholder="Masukkan Nama Usaha"
                            v-model="umkmForm.business_name"
                        />
                        <p class="text-error" v-if="errors.business_name">
                            {{ errors.business_name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-email">Email</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-email"
                            type="email"
                            placeholder="Masukkan Email"
                            v-model="umkmForm.email"
                        />
                        <p class="text-error" v-if="errors.email">
                            {{ errors.email }}
                        </p>
                    </section>
                    <section>
                        <label for="input-phone_number">Nomor Telepon</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-phone_number"
                            type="tel"
                            placeholder="Masukkan Nomor Telepon"
                            v-model="umkmForm.phone_number"
                        />
                        <p class="text-error" v-if="errors.phone_number">
                            {{ errors.phone_number }}
                        </p>
                    </section>
                    <section>
                        <label for="input-kbli">KBLI</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-kbli"
                            type="text"
                            placeholder="Masukkan KBLI"
                            v-model="umkmForm.kbli"
                        />
                        <p class="text-error" v-if="errors.kbli">
                            {{ errors.kbli }}
                        </p>
                    </section>
                    <section>
                        <label for="input-capital">Modal</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-capital"
                            type="number"
                            placeholder="Masukkan Modal"
                            v-model="umkmForm.capital"
                        />
                        <p class="text-error" v-if="errors.capital">
                            {{ errors.capital }}
                        </p>
                    </section>
                    <section>
                        <label for="input-jenis-perusahaan"
                            >Jenis Perusahaan</label
                        >
                        <select
                            class="select select-bordered w-full"
                            id="input-jenis-perusahaan"
                            v-model="umkmForm.jenis_perusahaan_id"
                        >
                            <option
                                v-for="jenis in jenis_perusahaan"
                                :value="jenis.id"
                            >
                                {{ jenis.name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-status-penanaman-modal"
                            >Status Penanaman Modal</label
                        >
                        <select
                            class="select select-bordered w-full"
                            id="input-status-penanaman-modal"
                            v-model="umkmForm.status_penanaman_modal_id"
                        >
                            <option
                                v-for="status in status_penanaman_modal"
                                :value="status.id"
                            >
                                {{ status.name }}
                            </option>
                        </select>
                    </section>
                    <h2 class="font-bold text-xl">Alamat Usaha</h2>
                    <section>
                        <label for="input-kecamatan">Kecamatan</label>
                        <select
                            @change="selectKecamatanHandler"
                            class="select select-bordered w-full"
                            v-model="umkmForm.kecamatan_id"
                        >
                            <option
                                v-for="_kecamatan in kecamatan"
                                :value="_kecamatan.id"
                            >
                                {{ _kecamatan.name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-kelurahan">Kelurahan</label>
                        <select
                            class="select select-bordered w-full"
                            v-model="umkmForm.kelurahan_id"
                        >
                            <option
                                v-for="_kelurahan in kelurahan"
                                :value="_kelurahan.id"
                            >
                                {{ _kelurahan.name }}
                            </option>
                        </select>
                    </section>
                    <section>
                        <label for="input-address">Alamat</label>
                        <textarea
                            class="textarea textarea-bordered w-full"
                            id="input-address"
                            placeholder="Masukkan Alamat"
                            v-model="umkmForm.address"
                        ></textarea>
                        <p class="text-error" v-if="errors.address">
                            {{ errors.address }}
                        </p>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
