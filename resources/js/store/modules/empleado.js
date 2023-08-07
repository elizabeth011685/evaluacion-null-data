import Swal from "sweetalert2";

const URI = '/api/empleados/';
export default {
    namespaced : true,
    state: {
        empleados : [],
        currentEmpleado : '',
        meta : {},
    },
    mutations: {
        SET_EMPLEADOS(state,data){
            state.empleados = data;
        },
        SET_EMPLEADO(state,data){
            state.currentEmpleado = data;
        },
        SET_META(state,data){
            state.meta = data;
        },

        UPDATE_ATTRIBUTE(state, data) {
            _.set(state.currentEmpleado, data.attribute, data.value);
        },

        UPDATE_EMPLEADO(state, data) {
            state.empleados = state.empleados.map(em => {
                if (em.id === data.id) {
                    return Object.assign({}, em, data)
                }
                return em
            })
            state.currentEmpleado = data;
        },
    },
    actions: {
        index(context, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .get(URI, { params: payload.params })
                    .then(r => r.data)
                    .then(data => {
                        resolve(data);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        find(context, payload) {
            return new Promise((resolve, reject) => {
                axios.get(URI + payload.id, {  })
                    .then(r => r.data)
                    .then(data => {
                        resolve(data);
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },
        store(context,payload){
            let _self = this;

            return new Promise((resolve, reject) => {
                 Swal.fire(
                        {
                            title: "Registrar Empleado",
                            text: "¿Está seguro de que la información es correcta?",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: 'Si',
                            cancelButtonText: 'Cancelar'
                        }
                    )
                    .then((value) => {
                        if (value.isConfirmed) {
                            axios
                                .post(URI, payload)
                                .then(r => r.data)
                                .then(data => {
                                    Swal.fire({
                                        title : "Empleado registrado correctamente",
                                        icon : "success",
                                        timer: 1500,
                                    }).then(() => {
                                        resolve(data);
                                    })
                                })
                                .catch(error => {

                                    Swal.fire({
                                        title : "Error durante el registro",
                                        text : _.flatten(_.toArray(error.response.data.errors)),
                                        icon : "error",
                                    }).then(() => {
                                        reject(error);
                                    })
                                });
                        }
                    });
            });

        },

    },
    getters: {
        empleados(state){
            return state.empleados;
        },
        currentEmpleado(state) {
            return state.currentEmpleado;
        },
        meta(state) {
            return state.meta;
        },
    }
}
