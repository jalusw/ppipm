<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const updateFileTypeForm = useForm({
    name: "",
});

const props = defineProps({
    fileType: Object,
    errors: Object,
});

onMounted(() => {
    const { fileType } = props;
    updateFileTypeForm.name = fileType.name;
});

const updateFileTypeFormSubmitHandler = () =>
    router.put(
        route("management.file-types.update", props.fileType.id),
        updateFileTypeForm
    );
</script>

<template>
    <Head :title="'Edit Jenis File - ' + updateFileTypeForm.name" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Edit Jenis File</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Jenis File</li>
                <li>
                    <Link
                        :href="
                            route(
                                'management.file-types.edit',
                                props.fileType.id
                            )
                        "
                        >Edit Jenis File</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="updateFileTypeFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama Jenis File</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Masukkan Nama Jenis File"
                            v-model="updateFileTypeForm.name"
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
