const URI = '/api/empleados/';
export default {
    namespaced : true,
    state: {
        empleados : [
            {
                nombre:'Elizabeth Martinez',
                fecha_nacimiento:'16/01/1985',
                email : 'elizabeth011685@gmail.com',
                puesto : 'Desarrollador',
                direccion : 'Guadalupe Victoria #4 Tecámac, Estado de México'

            },
            {
                nombre:'Jesús Romero',
                fecha_nacimiento:'28/07/1987',
                email : 'jromero@gmail.com',
                puesto : 'Reclutador',
                direccion : 'Av Revolucion 563, San Pedro de los Pinos'

            }
        ],
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
