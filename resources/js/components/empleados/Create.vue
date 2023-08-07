<template>
    <Form @submit="onSubmit">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
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
                                :rules = "validarPuesto"
                            />
                            <ErrorMessage name="puesto" v-slot="{ message }" >
                                <p style="color: red" >{{ message }}</p>
                            </ErrorMessage>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Skills:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Dirección:</label>
                            <div class="row">
                                <div class="col-md-12">
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
                            <div class="row">
                                <div class="col-md-12" >
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
    import '@vuepic/vue-datepicker/dist/main.css'

    export default {
        name: 'empleado-create',
        components: {VueDatePicker, Form, Field, ErrorMessage},
        data() {
            return {
                date: null,
                fecha_nacimiento : new Date(),
            };
        },
        methods: {
            onSubmit(values) {
                console.log(values);
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
        }
    }
</script>

<style scoped>

</style>
