<template>
    <div>
        <div class="d-flex w-100 justify-content-start">
            <div v-if="!isEditable" v-html="newText"></div>
            <b-button size="sm" @click="editChanged()" class="mr-1" variant="outline-secondary" v-if="!isEditable"><b-icon-pencil/></b-button>
            <vue-editor  v-if="isEditable" v-model="newText" :editor-toolbar="customToolbar"/>
            <b-button size="sm" @click="updateContent(newText)" class="mr-1" variant="primary" v-if="isEditable"><b-icon-check-square/></b-button>
            <b-button size="sm" @click="editChanged()" class="mr-1" variant="outline-secondary" v-if="isEditable"><b-icon-x-square/></b-button>
        </div>
        <br/>
    </div>
</template>

<script>
  import { VueEditor } from "vue2-editor";

export default {
    name: 'FreeTextPFC',
    components: { 
        VueEditor 
    },
    props: {
        section: {
            type: String,
            required: true
        }, 
        id: {
            type: String,
            required: true
        }, 
        content: {
            type: String,
            required: true
        }
    },
    data: function () {
        return {
            isEditable: false,
            newText: '',

            customToolbar: [
                // [{ font: [] }],
                [{ header: [
                    false, 
                    // 1, 
                    // 2, 
                    3, 
                    4, 
                    5, 
                    6] 
                }],
                // [{ size: ["small", false, "large", "huge"] }],
                ["bold", "italic", "underline", "strike"],
                [
                { align: "" },
                { align: "center" },
                { align: "right" },
                { align: "justify" }
                ],
                // [{ header: 1 }, { header: 2 }],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                // [{ script: "sub" }, { script: "super" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ color: [] }, { background: [] }],
                [
                    "link", 
                    "image", 
                    // "video", 
                    // "formula"
                ],
                // [{ direction: "rtl" }],
                // ["clean"]
            ]
        }
    },
    computed: {
        targetContent() {
            return this.content
        }
    },
    mounted() {
        this.newText = this.content
    },
    methods: {
        updateContent(payload) {
            this.isEditable = !this.isEditable;
            this.$store.dispatch('pfc/updateSubsectionContent', {section: this.section, subsection: this.id, content: payload});
            // this.$emit("update-new-text", payload) ;
        },
        editChanged() {
            this.isEditable = !this.isEditable;
        }
    }
}
</script>

<style>
</style>