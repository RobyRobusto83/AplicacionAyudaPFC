<template>
    <tr>
        <th scope="row" class="ps-4">
            <div class="form-check font-size-16">
                <input type="checkbox" class="form-check-input" id="contacusercheck1" />
                <label class="form-check-label" for="contacusercheck1"></label>
            </div>
        </th>
        <td>
            <a href="#" class="text-body">Tarea 1</a>
        </td>
        <td>
            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                <div class="col-md-8">
                    <textarea class="form-control" id="message" name="message" placeholder="Descripción" rows="7"></textarea>
                </div>
            </div>
        </td>
        <td>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Prioridades
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Alta</a>
                    <a class="dropdown-item" href="#">Media</a>
                    <a class="dropdown-item" href="#">Baja</a>
                </div>
            </div>
        </td>
        <td>
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary"><b-icon icon="pen-fill"></b-icon></a>
                </li>
                <li class="list-inline-item">
                    <a href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger"><b-icon icon="trash"></b-icon></a>
                </li>
                <li class="list-inline-item">
                    <a href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporizador" class="px-2 text-success"><b-icon icon="clock"></b-icon></a>
                </li>
            </ul>
        </td>
    </tr>
</template>
  
<script>
  export default {
    name: 'TaskItem'
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
body{margin-top:20px;
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
  img, svg {
      vertical-align: middle;
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
  
  .avatar-title {
      align-items: center;
      background-color: #3b76e1;
      color: #fff;
      display: flex;
      font-weight: 500;
      height: 100%;
      justify-content: center;
      width: 100%;
  }
  .bg-soft-primary {
      background-color: rgba(59,118,225,.25)!important;
  }
  </style>