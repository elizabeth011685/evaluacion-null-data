<template>
    <Form @submit="onSubmit">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Nombre:</label>
                            <Field
                                name = "nombre"
                                type = "input"
                                class="form-control"
                                v-model="nombre"
                                :rules = "validarNombre"
                            />
                            <ErrorMessage name="nombre" v-slot="{ message }" >
                                <p style="color: red" >{{ message }}</p>
                            </ErrorMessage>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Nacimiento:</label>
                            <VueDatePicker v-model="fecha_nacimiento"
                                           :format="format" month-name-format="long"
                            :format-locale="es"></VueDatePicker>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <Field
                                name = "email"
                                type = "email"
                                class="form-control"
                                v-model="email"
                                :rules = "validarEmail"
                            />
                            <ErrorMessage name="email" v-slot="{ message }" >
                                <p style="color: red" >{{ message }}</p>
                            </ErrorMessage>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Puesto:</label>
                            <Field
                                name = "puesto"
                                class="form-control"
                                v-model="puesto"
                                :rules = "validarPuesto"
                            />
                            <ErrorMessage name="puesto" v-slot="{ message }" >
                                <p style="color: red" >{{ message }}</p>
                            </ErrorMessage>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Skills:</label>
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
                                        <th class="encabezado icono">
                                            <button type="button" class="btn btn-sm btn-outline-success" @click="agregarSkill" :disabled="cargando">
                                                <i class="fa fa-spin fa-spinner" v-if="cargando"></i>
                                                <i class="fa fa-plus" v-else></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(skill, i) in this.skills">
                                        <td>{{i+1}}</td>
                                        <td>
                                            <field
                                                :name="`skill_${i}`"
                                                type="input"
                                                class="form-control"
                                                v-model="skill.skill"
                                                :rules = "validarSkill"
                                            >
                                            </field>
                                            <ErrorMessage :name="`skill_${i}`" v-slot="{ message }" >
                                                <p style="color: red" >{{ message }}</p>
                                            </ErrorMessage>
                                        </td>
                                        <td >
                                            <div class="pl-3">
                                                <vue-star-rating
                                                    v-model:rating="skill.evaluacion"
                                                    v-bind:increment="1"
                                                    v-bind:max-rating="5"
                                                    inactive-color="lightgray"
                                                    active-color="gold"
                                                    v-bind:star-size="15">
                                                </vue-star-rating>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-sm btn-outline-danger" @click="quitarSkill(i)" :disabled="skills.length == 1" >
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Dirección:</label>
                                    <field
                                        name="direccion"
                                        type="textarea"
                                        class="form-control"
                                        :rules = "validarDireccion"
                                    >
                                    </field>
                                    <ErrorMessage name="direccion" v-slot="{ message }" >
                                        <p style="color: red" >{{ message }}</p>
                                    </ErrorMessage>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Coordenadas de Dirección:</label>
                                    <field
                                        name="direccion_coordenadas"
                                        type="input"
                                        class="form-control"
                                        :rules = "validarCoordenadas"
                                        placeholder = "19.425370900725362, -99.1744424270933"
                                    >
                                    </field>
                                    <ErrorMessage name="direccion_coordenadas" v-slot="{ message }" >
                                        <p style="color: red" >{{ message }}</p>
                                    </ErrorMessage>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="pull-right">
                    <router-link  :to="{ name: 'home'}" type="button" class="btn btn-primary mr-2" title="Regresar">
                        <i class="fa fa-angle-left"></i> Regresar
                    </router-link>
                    <button  type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </Form>

</template>
<script setup>
import { ref } from 'vue';
import { es } from 'date-fns/locale';


const date = ref(new Date());
const format = (date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
}


</script>
<script >
    //import StarRating from 'vue-star-rating';
    import {Form, Field, ErrorMessage} from "vee-validate";
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css';
    //import vue3starRatings from "vue3-star-ratings";
    import VueStarRating from 'vue-star-rating';

    export default {
        name: 'empleado-create',
        components: {VueDatePicker, Form, Field, ErrorMessage, VueStarRating},
        data() {
            return {
                date: null,
                cargando : false,
                nombre : '',
                puesto : '',
                email : '',
                fecha_nacimiento : new Date(),
                apiKey : process.env.MIX_VUE_APP_GOOGLE_MAPS_API_KEY,
                skills : [{
                    'skill' : '',
                    'evaluacion' : 0,
                }]
            };
        },
        mounted() {
            this.apiKey = process.env.MIX_VUE_APP_GOOGLE_MAPS_API_KEY;
        },
        methods: {
            agregarSkill(){
                var array = {
                    'skill' : '',
                    'evaluacion' : 0,
                }
                this.skills.push(array);
            },
            quitarSkill(index){
                this.skills.splice(index, 1);
            },
            validarSkill(value)
            {
                if (!value) {
                    return 'Este campo es requerido';
                }
                return true;
            },
            validarEmail(value) {
                if (!value) {
                    return 'Este campo es requerido';
                }
                const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
                if (!regex.test(value)) {
                    return 'Este campo debe ser un email válido';
                }
                return true;
            },
            validarPuesto(value) {
                if (!value) {
                    return 'Este campo es requerido';
                }
                return true;
            },
            validarDireccion(value) {
                if (!value) {
                    return 'Este campo es requerido';
                }
                return true;
            },
            validarNombre(value) {
                if (!value) {
                    return 'Este campo es requerido';
                }
                return true;
            },
            validarCoordenadas(value) {
                if (!value) {
                    return 'Este campo es requerido';
                }
                const regex = /^(\-?([0-8]?[0-9](\.\d+)?|90(.[0]+)))([,]\s?)+(\-?([0-9]{1,2}(\.\d+)?|1[0-7][0-9](\.\d+)?|180))$/i;
                if (!regex.test(value)) {
                    return 'Este campo debe tener un formato válido';
                }
                return true;
            },
            onSubmit(values) {
                console.log(values);
            },
        }
    }
</script>

<style scoped>

</style>
