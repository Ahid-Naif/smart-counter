<template>
    <div class="wizard-container">
        <div class="row">
            <div class="col-md-4">
                <a href="#">
                    <div class="card application-card red">
                        <h3 class="text-center">
                            <i class="material-icons">person</i><br>
                            Confirmation Letter
                        </h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#">
                    <div class="card application-card red">
                        <h3 class="text-center">
                            <i class="material-icons">person</i><br>
                            Certification Letter
                        </h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#">
                    <div class="card application-card red">
                        <h3 class="text-center">
                            <i class="material-icons">person</i><br>
                            Graduation Letter
                        </h3>
                    </div>
                </a>
            </div>
        </div>
        
        <loader v-if="isLoading"></loader>
    </div>
</template>

<script>
    import loader from '../components/Loader.vue'
    
    export default {
        data(){
            return {
                isLoading: false,
            }
        },
        methods: {
            submit(){
                this.isLoading = true;
                
                axios.post('/portal/application/store', {
                    "application_type_id" : this.selectedType.id,
                }).then(response => {
                    this.isLoading = false;
                    window.location.replace("/portal");
                }).catch(error => {
                    this.isLoading = false;
                });
            }
        },
        components: {
            loader,
        }
    }
</script>

<style>
    .card.application-card.red:hover {
        box-shadow: 0 0 0 1px #bc4c73, 0 0 0 1px white inset;
    }
</style>