<template>
    <div>
        <div class="starter-template" v-if="!$store.getters['pfc/hasContent']">
            <h1>{{ $store.getters['pfc/title'] }}</h1>
            <p class="lead">No has definido un PFC</p>          
            <a href="#/pfc" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Defínelo</a>

        </div>
        <div v-if="$store.getters['pfc/hasContent']">
            <PFCSectionViewer
                v-for="section in $store.getters['pfc/content']"
                :key="section.id"
                v-bind="section"
            />
        </div>
    </div>
</template>

<script>
import PFCSectionViewer from '@/components/pfcViewer/PFCSectionViewer.vue'

export default {
    name: 'PFCViewer',
    components: {
        PFCSectionViewer
    },
    created() {
        this.$store.dispatch('pfc/fetchDocument');
    }
}
</script>