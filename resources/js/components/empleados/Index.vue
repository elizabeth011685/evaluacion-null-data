<template>
    <div class="card" v-if="cargando">
        <div class="card-body">
            <div class="card-header">
                <div class="spinner-border text-success" role="status" >
                    <span class="sr-only">Cargando...</span>
                </div>
            </div>
        </div>
    </div>
    <div class="card" v-else>
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
                    <i class="fa fa-users" /> Lista de Empleados
                </div>
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th style="width: 100px">Fecha de Nacimiento</th>
                        <th>Email</th>
                        <th>Puesto</th>
                        <th>Dirección del Domicilio</th>
                        <th style="width: 200px">Coordenadas del Domicilio</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody v-if="empleados.length > 0">
                    <tr v-for="(empleado, i) in empleados">
                        <td>{{parseInt(i)+1}}</td>
                        <td>{{empleado.nombre}}</td>
                        <td style="text-align: center">{{ this.formatea_fecha(empleado.fecha_nacimiento) }}</td>
                        <td>{{empleado.email}}</td>
                        <td>{{empleado.puesto}}</td>
                        <td>{{empleado.domicilio}}</td>
                        <td style="text-align: center">{{empleado.domicilio_latitud}}, {{empleado.domicilio_longitud}}</td>
                        <td class="acciones">
                            <action-buttons v-bind:empleado="empleado"></action-buttons>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script >

import ActionButtons from "./partials/ActionButtons.vue";

export default {
    name : 'empleado-index',
    components: {ActionButtons},

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
            }).finally(() => {
                this.cargando = false;
            })
        },
        formatea_fecha(value) {
            var d = 0;
            var m = 0;
            var y = 0;

            if(value){
                var date =  new Date (value);
                d = date.getDate();
                m = date.getMonth() + 1;
                y = date.getFullYear();
                if (d < 10) {
                    d = '0' + d;
                }
                if (m < 10) {
                    m = '0' + m;
                }
                return d+'/'+ m+'/'+y;
            }
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
