<template>
    <div class="wizard-container">
        <div class="row">
            <div class="col-md-4" v-for="type in types">
                <div class="card application-card red as-link margin-top-20" @click="submit(type)">
                    <h3 class="text-center">
                        <i class="material-icons">assignment</i><br>
                        {{ type.name }}
                    </h3>
                </div>
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
                types: [],
                isLoading: false,
            }
        },
        methods: {
            submit(type){
                this.isLoading = true;
                
                axios.post('/portal/application/store', {
                    "application_type_id" : type.id,
                }).then(response => {
                    this.isLoading = false;
                    window.location.replace("/portal");
                }).catch(error => {
                    this.isLoading = false;
                });
            },
            fetchAllApplicationTypes() {
                this.isLoading = true;

                axios.post('/portal/application/types').then(response => {
                    this.isLoading = false;
                    this.types = response.data.data.types;
                }).catch(error => {
                    this.isLoading = false;
                });
            }
        },
        mounted(){
            this.fetchAllApplicationTypes();
        },
        components: {
            loader,
        }
    }
</script>

<style>
    .as-link {
        cursor: pointer;
    }
    
    .card.application-card.red:hover {
        box-shadow: 0 0 0 1px #bc4c73, 0 0 0 1px white inset;
    }
</style>