<template>
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>

            <div class="error-content">
                <h6><i class="fa fa-warning text-warning"></i> Oops! Página no encontrada.</h6>

                <p>
                    No pudimos encontrar la página que buscabas <br>
                    <router-link to="/">Regresar a la página de inicio</router-link>
                </p>
            </div>
        </div>
        <!-- /.error-page -->
    </section>
</template>

<script>
    export default {
        name: "NotFound"
    }
</script>

<style scoped>

</style>
