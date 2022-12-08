<template>
    <div>
        <div>
  <b-button v-b-modal.modal-1>Launch demo modal</b-button>

  <b-modal id="modal-1" title="BootstrapVue">
    <p class="my-4">Hello from modal!</p><form class="form-horizontal" method="post">
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

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <a href="#/tasks" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Guardar</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
  </b-modal>
</div>


        <b-list-group>
            <ChapterPfc chapter="Capitulo 1" days="24 días" paragraph="Lorem ipsum1" subparagraph="Alea jacta est1" />
            <ChapterPfc chapter="Capitulo 2" days="24 días" paragraph="Lorem ipsum2" subparagraph="Alea jacta est2" />
            <ChapterPfc chapter="Capitulo 3" days="24 días" paragraph="Lorem ipsum3" subparagraph="Alea jacta est3" />
  <b-list-group-item href="#" active class="flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Capitulo 1</h5>
      <small><button class="test">Click me</button><button>Remove</button> days ago</small>
    </div>

    <p class="mb-1">
      Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
    </p>

    <small>Donec id elit non mi porta.</small>
  </b-list-group-item>

  <b-list-group-item href="#" class="flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Capitulo 2</h5>
      <small class="text-muted">3 days ago</small>
    </div>

    <p class="mb-1">
      Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
    </p>
    <p class="mb-1">
      Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
    </p>

    <small class="text-muted">Donec id elit non mi porta.</small>
  </b-list-group-item>

  <b-list-group-item href="#" disabled class="flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Disabled List Group item</h5>
      <small class="text-muted">3 days ago</small>
    </div>

    <p class="mb-1">
      Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
    </p>

    <small class="text-muted">Donec id elit non mi porta.</small>
  </b-list-group-item>
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