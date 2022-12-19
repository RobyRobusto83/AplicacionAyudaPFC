<template>
    <div v-html="newText"></div>
</template>

<script>
export default {
    name: 'PFCFreeTextViewer',
    components: {
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
            newText: ''
        }
    },
    mounted() {
        this.newText = this.content
    }
}
</script>

<style>
</style>