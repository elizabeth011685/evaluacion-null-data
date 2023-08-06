<template>
    <div class="btn-group">
        <router-link :to="{ name: 'empleado-show', params: { id_empleado: this.empleado.id}}"  type="button" class="btn btn-sm btn-outline-secondary" title="Ver">
            <i class="fa fa-eye"></i>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "action-buttons",
        props: ['empleado'],
    }
</script>

