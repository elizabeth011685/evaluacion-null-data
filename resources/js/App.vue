<template>
    <body className="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
    <div className="wrapper">
        <app-header/>
        <app-sidebar/>
        <div className="content-wrapper px-4 py-2">
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-md-12">
                            <h5>{{ this.$route.meta.title }}</h5>
                        </div>

                    </div>
                </div>
            </section>
            <section className="content">
                <div className="container-fluid">
                    <div className="row">
                        <div className="col-md-12">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <app-footer></app-footer>
    </div>
    </body>
</template>

<script>
import AppHeader from "./components/AppHeader.vue";
import AppSidebar from "./components/AppSidebar.vue";
import AppFooter from "./components/AppFooter.vue";

export default {
    name: 'app',
    components: {AppFooter, AppSidebar, AppHeader},
    data() {
        return {

        }
    },

}

</script>

<style scoped>

</style>
