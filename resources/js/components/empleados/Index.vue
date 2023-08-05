<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <router-view></router-view>
                <div class="col-md-12">
                    <router-link  :to="{ name: 'empleado-create'}" type="button" class="btn btn-app pull-right" title="Registrar">
                        <i class="fa fa-plus"></i> Registrar
                    </router-link>
                </div>
            </div>
            <div class="table-responsive">
                <div class="encabezado_tabla">
                    Lista de Empleados
                </div>
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Fecha Nacimiento</th>
                        <th>Email</th>
                        <th>Puesto</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody v-if="empleados.length > 0">
                    <tr v-for="(empleado, i) in empleados">
                        <td>{{parseInt(i)+1}}</td>
                        <td>{{empleado.nombre}}</td>
                        <td>{{empleado.fecha_nacimiento}}</td>
                        <td>{{empleado.email}}</td>
                        <td>{{empleado.puesto}}</td>
                        <td>{{empleado.domicilio}}</td>
                        <td class="acciones">
                            <router-link :to="{ name: ''}"  type="button" class="btn btn-sm btn-outline-secondary" title="Ver">
                                <i class="fa fa-eye"></i>
                            </router-link>
                            <router-link :to="{ name: ''}"  type="button" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                <i class="fa fa-trash"></i>
                            </router-link>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script >

export default {
    name : 'empleado-index',

    data(){
        return{
            HeaderSettings: false,
            columns: [
                { title: '#', field:'index',sortable: false },
            ],
            data: [],
            total: 0,
            query: {
                sort: 'id',  order: 'desc'
            },
            cargando: false
        }
    },
    mounted() {
        this.getEmpledos();
    },
    methods :{
        getEmpledos() {
            this.empresas = [];
            this.cargando = true;
            return this.$store.dispatch('empleado/index', {
                params: {

                }
            })
            .then(data => {
                this.$store.commit('empleado/SET_EMPLEADOS', data.empleados);
            })
        },
    },
    computed: {
        empleados() {
            return this.$store.getters['empleado/empleados']
        }
    }
}


</script>

<style scoped>

</style>
