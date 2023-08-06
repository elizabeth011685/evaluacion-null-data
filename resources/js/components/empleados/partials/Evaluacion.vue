<template>
    <div class="evaluacion-container">
        <i class="fa fa-star" style="color: gold"  v-for="idx in rangoEvaluacion"></i>
        <i class="fa fa-star" style="color: lightgray"  v-for="idx in rangoTotal"></i>
    </div>
</template>
<script >

const rango = (start, end, length = end - start + 1) =>
    Array.from({ length }, (_, i) => start + i);
export default {
    name: 'evaluacion',
    props: ["evaluacion","total"],
    data () {
        return {
            rangoEvaluacion: rango(0, this.evaluacion - 1),
            rangoTotal: rango(0, this.total - this.evaluacion)
        }
    },
}

</script>

<style scoped>
    .evaluaion-container {
        display:flex;
        justify-content: center;
    }
</style>
