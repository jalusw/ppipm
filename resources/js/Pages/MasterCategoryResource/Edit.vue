<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const updateMasterCategoryForm = useForm({
    name: "",
});

const props = defineProps({
    master_category: Object,
    errors: Object,
});

onMounted(() => {
    const { master_category } = props;
    updateMasterCategoryForm.name = master_category.name;
});

const updateMasterCategoryFormSubmitHandler = () =>
    router.put(
        route("management.master-categories.update", props.master_category.id),
        updateMasterCategoryForm
    );
</script>

<template>
    <Head title="Edit Kategori" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Edit Kategori</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Kategori</li>
                <li>
                    <Link
                        :href="
                            route(
                                'management.master-categories.edit',
                                props.master_category.id
                            )
                        "
                        >Edit Kategori</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="updateMasterCategoryFormSubmitHandler">
                <div class="grid grid-cols-1 gap-y-4">
                    <section>
                        <label for="input-name">Nama Kategori</label>
                        <input
                            class="input input-bordered w-full"
                            id="input-name"
                            type="text"
                            placeholder="Mohon Masukan Nama  Kategori"
                            v-model="updateMasterCategoryForm.name"
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
