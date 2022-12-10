<template>
    <div>
        <div class="d-flex w-100 justify-content-start">
            <div v-show="!editOn">
                <small class="text-muted">{{ localText }}</small>
                <small class="text-muted"><b-icon-pencil v-on:click="changeEdit"/></small>
            </div>
            <div v-show="editOn">
                <textarea cols="100" rows="3" v-model="localText" class="pfc-textarea" placeholder="Escribe un párrafo"></textarea>
                <small class="text-muted"><b-icon-x-lg v-on:click="changeEdit"/></small>
            </div>
        </div>
        <br/>
    </div>
</template>

<script>
export default {
    name: 'PFCParagraphItem',
    props: {
        id: {
            type: Number,
            required: true
        }, 
        content: {
            type: String,
            required: true
        }
    },
    data: function () {
        return {
            editOn: false,
            localText: this.content
        }
    },
    methods: {
        changeEdit() {
            this.editOn = !this.editOn;
        }
    },
    watch: {
        localText(x) {
            this.$emit('update:content', x)
        }
    },
}
</script>

<style>
.pfc-textarea {
  width: 100%;
  height: 100px;
}
</style>