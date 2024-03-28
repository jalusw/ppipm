<script setup>
import TinymceEditor from "../../Components/TinymceEditor.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, router, Link, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const articleForm = useForm({
    body: "",
    format: true,
});

const props = defineProps({
    comodity: Object,
});

onMounted(() => {
    articleForm.body = props.comodity.article_content?.body;
});

const saveHandler = () => {
    router.post(
        route("management.comodities.article", props.comodity.id),
        articleForm
    );
};
</script>
<template>
    <Head title="Artikel Komoditias" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Artikel Komoditas</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Komoditas</li>
                <li>
                    <Link
                        :href="
                            route('management.comodities.article', comodity.id)
                        "
                        >Artikel Komoditas</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="saveHandler" action="">
                <TinymceEditor :form="articleForm" />
                <section class="flex items-center mt-4 space-x-2">
                    <input
                        class="checkbox checkbox-bordered"
                        id="input-format-option"
                        type="checkbox"
                        v-model="articleForm.format"
                    />
                    <label for="input-format-option">Format Default </label>
                </section>
                <section class="mt-8 space-x-4">
                    <button class="btn btn-primary" type="submit">
                        Simpan
                    </button>
                    <Link
                        class="btn btn-primary"
                        :href="
                            route(
                                'management.comodities.article-preview',
                                props.comodity.id
                            )
                        "
                        >Preview</Link
                    >
                </section>
            </form>
        </div>
    </AdminLayout>
</template>
