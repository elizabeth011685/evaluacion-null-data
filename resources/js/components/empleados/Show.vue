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
                {{currentEmpleado.nombre}}
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Fecha de Nacimiento:</label>
                        <div class="form-control">
                            {{currentEmpleado.fecha_nacimiento}}
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
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Skills:</label>
                        <div class="row" v-for="(skill, i) in currentEmpleado.skills">
                            <div class="col-md-6">{{skill.skill}}</div>
                            <div class="col-md-6">
                                <evaluacion v-bind:total="5" v-bind:evaluacion="skill.evaluacion"></evaluacion>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Dirección:</label>
                        <div class="row">
                            <div class="col-md-12">
                                {{currentEmpleado.domicilio}}
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>
<script >
    import Evaluacion from "./partials/Evaluacion.vue";

    export default {
        name: 'empleado-show',
        components: {Evaluacion},
        props : ['id_empleado'],
        data(){
            return {
                cargando:false,
            }
        },
        mounted() {
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
            }
        },

        computed: {
            currentEmpleado() {
                return this.$store.getters['empleado/currentEmpleado']
            }
        }
    }
</script>

<style scoped>

</style>
