<template>
    <div>
      <b-list-group>
      <small>
        <div>
          <b-button v-b-modal.modal-1>Acciones</b-button>
          <b-modal id="modal-1" title="Nuevo título">
            <form class="form-horizontal" method="post">
              <fieldset>
                <div class="form-group">
                  <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                  <div class="col-md-8">
                      <input id="fname" name="name" type="text" placeholder="Nombre" class="form-control">
                  </div>
               </div>
                <div class="form-group">
                  <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                  <div class="col-md-8">
                    <textarea class="form-control" id="message" name="message" placeholder="Descripción" rows="7"></textarea>
                  </div>
                </div>                               
              </fieldset>
            </form>
          </b-modal>
        </div>
      </small>
        <ChapterPfc chapter="Capitulo 1" days="24 días" paragraph="Lorem ipsum1" subparagraph="Alea jacta est1" />      
      </b-list-group>  
    </div>
</template>
  
<script>
import ChapterPfc from '../components/ChapterPfc.vue'

export default {
  name: 'PFC',
  components: {
    ChapterPfc
  }
}
</script>
  
<style>
.test {
    color: red;
}
</style>