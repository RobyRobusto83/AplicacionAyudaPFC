<template>
    <div>
        <div class="d-flex w-100 justify-content-start">
            <div v-if="!isEditable" v-html="newText"></div>
            <b-button size="sm" @click="editChanged()" class="mr-1" variant="outline-secondary" v-if="!isEditable"><b-icon-pencil/></b-button>
            <RichTextEditor v-if="isEditable" :content="newText"/>
            <b-button size="sm" @click="changeTitle(newText)" class="mr-1" variant="primary" v-if="isEditable"><b-icon-check-square/></b-button>
            <b-button size="sm" @click="editChanged()" class="mr-1" variant="outline-secondary" v-if="isEditable"><b-icon-x-square/></b-button>
        </div>
        <br/>
    </div>
</template>

<script>
import RichTextEditor from './RichTextEditor.vue'

export default {
    name: 'FreeTextPFC',
    components: {
        RichTextEditor
    },
    props: {
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
            newText: ''
        }
    },
    mounted() {
        this.newText = this.content
    },
    computed: {
        targetTitle() {
            return this.content
        }
    },
    methods: {
        changeTitle(payload) {
        this.isEditable = !this.isEditable;
        var currentChapter = {
            id: this.id,
            title: payload
        }
        this.$store.dispatch('pfc/updateCurrentChapter', currentChapter);
        this.$emit("update-new-text", payload) ;
        },
        editChanged() {
        this.isEditable = !this.isEditable;
        }
    }
}
</script>

<style>
</style>