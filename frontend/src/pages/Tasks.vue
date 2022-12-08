<template>
<div>
<div>
  <div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Listado de tareas</h5>
            </div>
        </div>
                <div>
                    <a href="/addTask" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><b-icon icon="plus"></b-icon> Nueva tarea</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="ps-4" style="width: 50px;"></th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Prioridades</th>
                                <th scope="col" style="width: 200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          <TaskItem />
                          <TaskItem />                                               
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <div class="row g-0 align-items-center pb-4">
        <div class="col-sm-6">
            <div><p class="mb-sm-0">Primera página</p></div>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-end">
                <ul class="pagination mb-sm-0">
                    <li class="page-item disabled">
                        <a href="#" class="page-link"><b-icon icon="chevron-double-left"></b-icon></a>
                    </li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item disabled">
                        <a href="#" class="page-link"><b-icon icon="chevron-double-right"></b-icon></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import TaskItem from '../components/TaskItem.vue'
export default {
  name: 'TaskList',
  components: {
    TaskItem
  }
}
</script>

<style>
body {
  padding-top: 5rem;
}
.starter-template {
  padding: 3rem 1.5rem;
  text-align: center;
}

.header {
    color: #36A0FF;
    font-size: 27px;
    padding: 10px;
}

.bigicon {
    font-size: 35px;
    color: #36A0FF;
}

/* css zona de tareas */
body
{margin-top:20px;
  background-color:#eee;
  }
  .project-list-table {
      border-collapse: separate;
      border-spacing: 0 12px
  }
  
  .project-list-table tr {
      background-color: #fff
  }
  
  .table-nowrap td, .table-nowrap th {
      white-space: nowrap;
  }
  .table-borderless>:not(caption)>*>* {
      border-bottom-width: 0;
  }
  .table>:not(caption)>*>* {
      padding: 0.75rem 0.75rem;
      background-color: var(--bs-table-bg);
      border-bottom-width: 1px;
      box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
  }
  
  .avatar-sm {
      height: 2rem;
      width: 2rem;
  }
  .rounded-circle {
      border-radius: 50%!important;
  }
  .me-2 {
      margin-right: 0.5rem!important;
  }
  a {
      color: #3b76e1;
      text-decoration: none;
  }
  
  .badge-soft-danger {
      color: #f56e6e !important;
      background-color: rgba(245,110,110,.1);
  }
  .badge-soft-success {
      color: #63ad6f !important;
      background-color: rgba(99,173,111,.1);
  }
  
  .badge-soft-primary {
      color: #3b76e1 !important;
      background-color: rgba(59,118,225,.1);
  }
  
  .badge-soft-info {
      color: #57c9eb !important;
      background-color: rgba(87,201,235,.1);
  }
  
 
  .bg-soft-primary {
      background-color: rgba(59,118,225,.25)!important;
  }
</style>