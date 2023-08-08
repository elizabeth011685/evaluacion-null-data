<template>
    <div class="card" v-if="!currentEmpleado">
        <div class="card-body">
            <div class="card-header">
                <div class="spinner-border text-success" role="status" >
                    <span class="sr-only">Cargando...</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card" v-else>
        <div class="card-header">
            <h5>
                <i class="fa fa-user" /> {{currentEmpleado.nombre}}
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-address-card"></i> Datos Generales
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Fecha de Nacimiento:</label>
                                <div class="form-control">
                                    {{ formatea_fecha(currentEmpleado.fecha_nacimiento)}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <div class="form-control">
                                    {{currentEmpleado.email}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Puesto:</label>
                                <div class="form-control">
                                    {{currentEmpleado.puesto}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-glasses"></i> Skills
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <table class="table  table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="index_corto">
                                                #
                                            </th>
                                            <th >
                                                Skill
                                            </th>
                                            <th style="width: 120px">
                                                Evaluación
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(skill, i) in currentEmpleado.skills">
                                            <td>{{i+1}}</td>
                                            <td>
                                                {{skill.skill}}
                                            </td>
                                            <td >
                                                <div class="pl-3">
                                                    <evaluacion v-bind:total="5" v-bind:evaluacion="skill.evaluacion"></evaluacion>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-home"></i> Domicilio
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Dirección:</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{currentEmpleado.domicilio}}
                                    </div>
                                </div>
                                <label class="form-label mt-2">Coordenadas:</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{currentEmpleado.domicilio_latitud}}, {{currentEmpleado.domicilio_longitud}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-2" >
                                        <mapa v-bind:api-key="apiKey" v-bind:latitud="Number(currentEmpleado.domicilio_latitud)" v-bind:longitud="Number(currentEmpleado.domicilio_longitud)"></mapa>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="pull-right">
                <router-link  :to="{ name: 'home'}" type="button" class="btn btn-primary" title="Regresar">
                    <i class="fa fa-angle-left"></i> Regresar
                </router-link>
            </div>
        </div>
    </div>

</template>
<script >
    import Evaluacion from "./partials/Evaluacion.vue";
    import Mapa from "../general/Mapa.vue";

    export default {
        name: 'empleado-show',
        components: {Mapa, Evaluacion},
        props : ['id_empleado'],
        data(){
            return {
                cargando:false,
                apiKey : process.env.MIX_VUE_APP_GOOGLE_MAPS_API_KEY,
            }
        },
        mounted() {
            this.apiKey = process.env.MIX_VUE_APP_GOOGLE_MAPS_API_KEY;
            this.find();
        },
        methods: {
            find()
            {
                this.cargando = true;
                this.$store.commit('empleado/SET_EMPLEADO', null);
                return this.$store.dispatch('empleado/find', {
                    id: this.id_empleado
                }).then(data => {
                    this.$store.commit('empleado/SET_EMPLEADO', data.empleado);
                }).finally(() => {
                    this.cargando = false;
                });
            },
            formatea_fecha(value) {
                var d = 0;
                var m = 0;
                var y = 0;

                if(value){
                    var date =  new Date (value);

                    date.toLocaleDateString('es-MX',{
                        timeZone :'America/Mexico_City',
                    });

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
            currentEmpleado() {
                return this.$store.getters['empleado/currentEmpleado']
            },
        }
    }
</script>

<style scoped>

</style>
