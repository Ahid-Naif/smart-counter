<template>
    <div>
        <div class="col-md-12">
            <div id="applications" class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">school</i>
                </div>
                <br>
                <h4 class="card-title">
                    Applications
                </h4>
                <div class="content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="tableRow"
                                v-for="application, index in applications"
                                @click="showApplication(application)">
                                <td>{{ index + 1 }}</td>
                                <td>{{ application.type }}</td>
                                <td>{{ application.date }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
                applications: [],
                isLoading: false,
            }
        },
        methods: {
            fetchApplications(){
                this.isLoading = true;
                axios.post('/portal/applications')
                    .then(response => {
                        this.applications = response.data.data.applications;
                        this.isLoading = false;
                    }).catch(error => {
                        this.isLoading = false;
                    });
            },
        },
        mounted(){
            this.fetchApplications();
        },
        components: {
            loader,
        }
    }
</script>

<style>
    .tableRow {
        padding: 5px;
        transition: all 0.3s;
    }

    .tableRow:hover {
        background-color: #eaeaea;
    }


    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s
    }

    .fade-enter,
    .fade-leave-to
    {
        opacity: 0
    }
</style>