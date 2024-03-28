<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const updatePermissionForm = useForm({
    name: "",
    access_code: "",
    description: "",
});

const props = defineProps({
    permission: Object,
    errors: Object,
});

onMounted(() => {
    const { permission } = props;
    updatePermissionForm.name = permission.name;
    updatePermissionForm.access_code = permission.access_code;
    updatePermissionForm.description = permission.description;
});

const updatePermissionFormSubmitHandler = () =>
    router.put(
        route("management.permissions.update", props.permission.id),
        updatePermissionForm
    );
</script>
<template>
    <Head title="Ubah Hak Akses" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Ubah Hak Akses</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Hak Akses</li>
                <li>
                    <Link
                        :href="
                            route(
                                'management.permissions.edit',
                                props.permission.id
                            )
                        "
                        >Ubah Hak Akses</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="updatePermissionFormSubmitHandler">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <section>
                        <label for="input-name"> Nama Hak Akses </label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukan Nama Hak Akses"
                            v-model="updatePermissionForm.name"
                        />
                        <p class="text-error" v-if="errors.name">
                            {{ errors.name }}
                        </p>
                    </section>
                    <section>
                        <label for="input-access-code">Kode Hak Akses</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-access-code"
                            type="text"
                            placeholder="Mohon Masukan Kode Hak Akses"
                            v-model="updatePermissionForm.access_code"
                        />
                        <p class="text-error" v-if="errors.access_code">
                            {{ errors.access_code }}
                        </p>
                    </section>
                    <section class="md:col-span-2">
                        <label for="input-description">Deskripsi</label>
                        <textarea
                            class="textarea textarea-bordered w-full"
                            id="input-description"
                            placeholder="Mohon Masukan Deskripsi"
                            v-model="updatePermissionForm.description"
                        ></textarea>
                    </section>
                </div>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
