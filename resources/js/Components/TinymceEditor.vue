<script setup>
import Editor from "@tinymce/tinymce-vue";
import { onMounted } from "vue";

const props = defineProps({
    form: Object,
});
</script>
<template>
    <Editor
        id="input-description"
        v-model="props.form.body"
        api-key="8jll2ke6nnxbxhg7ze5uvcnfwsghzplyzfny0mndtx3gxvt0"
        :init="{
            plugins:
                'code table lists anchor charmap emoticons fullscreen image insertdatetime link preview searchreplace visualblocks',
            toolbar:
                'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table | anchor | link |  charmap  emoticons | image | code |  insertdatetime | searchreplace | visualblocks | fullscreen',
        }"
    />
</template>
