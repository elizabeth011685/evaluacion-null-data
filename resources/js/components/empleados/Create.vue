<template>
    <Form @submit="onSubmit">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-address-card"></i> Datos Generales
                            </div>
                            <div class="card-body">
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
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-home"></i> Domicilio
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label">Dirección:</label>
                                            <field
                                                v-model="domicilio"
                                                name="direccion"
                                                type="textarea"
                                                class="form-control"
                                                :rules = "validarDireccion"
                                                placeholder="Lago Meru 20, Granada, Miguel Hidalgo, Ciudad de México"
                                            >
                                            </field>
                                            <ErrorMessage name="direccion" v-slot="{ message }" >
                                                <p style="color: red" >{{ message }}</p>
                                            </ErrorMessage>
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
    import {Form, Field, ErrorMessage} from "vee-validate";
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css';
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
                domicilio :'',
                domicilio_coordenadas : '',
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
                const regex = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+(?:\s+[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+){1,5}(?<!\s)$/;
                if (!regex.test(value)) {
                    return 'El nombre del empleado sólo debe contener letras y tener al menos un apellido';
                }
                return true;
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
            onSubmit(values) {
                let _self = this;
                let errores = 0;
                this.skills.forEach(
                    function (skill,i)
                    {
                        if(!skill.evaluacion > 0)
                        {
                            errores++;
                        }
                    }
                );
                if(errores>0)
                {
                    new swal("Error","Las evaluaciones de los skills deben tener un valor mayor a 0","error");
                }else{

                    return this.$store.dispatch('empleado/store', {
                        "nombre": _self.nombre,
                        "puesto": _self.puesto,
                        "email": _self.email,
                        "fecha_nacimiento" : this.formatea_fecha(_self.fecha_nacimiento),
                        "domicilio" : _self.domicilio,
                        "skills" : { "data" : _self.skills }
                    })
                        .then((data) => {
                            this.$router.push({name: 'empleados'});
                        });
                }
            },
        }
    }
</script>

<style scoped>

</style>
