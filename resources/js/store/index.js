import { createStore } from 'vuex'
import empleado from "./modules/empleado";


const store = createStore({
    modules :{
        'empleado' : empleado,
    }
})
export default store;


