import Home from '../pages/Home.vue';

export const routes = [
    {
        path: '/',
        name: 'home',
        component: require('../components/empleados/Index.vue').default,
        meta :{
            title: "Lista de Empleados"
        }
    },
    {
        path: '/empleados',
        component: require('../components/empleados/Layout.vue').default,
        children: [
            {
                path : '',
                name : 'empleados',
                component: require('../components/empleados/Index.vue').default,
                meta :{
                    title: "Lista de Empleados"
                }
            },
            {
                path : 'create',
                name : 'empleado-create',
                component: require('../components/empleados/Create.vue').default,
                meta :{
                    title: "Registro de Empleado"
                }
            },
            {
                path : ':id_empleado',
                name : 'empleado-show',
                props : true,
                component: require('../components/empleados/Show.vue').default,
                meta :{
                    title: "Consulta de Empleados"
                }
            },
        ],
    },
    {
        path: "/:catchAll(.*)",
        name: 'NotFound',
        component: require('../pages/NotFound.vue').default,
    },
];
