<template>
    <div class="wizard-container">
        <div class="row">
            <div class="text-center">
                <h2>
                    Select one application to process
                    <br>
                    Or
                </h2>
                <div class="btn btn-success"
                     @click="toggleRecording"
                     :class="{'btn-rose' : isRecording}">
                    chat with the bot
                    <i class="fa fa-microphone" aria-hidden="true"></i>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4" v-for="type in types">
                <div class="card application-card red as-link margin-top-20" @click="submit(type.name, 1)">
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
    import loader from '../components/Loader.vue';
    import {ApiAiClient} from "api-ai-javascript";
    import Speaker from "../core/Speaker";
    const client = new ApiAiClient({accessToken: 'dacb528b0e2b426b8ab61da10cdb4307'});
    
    export default {
        data(){
            return {
                types: [],
                isLoading: false,
                speaker: new Speaker,
                recognition: null,
                isRecording: false,
            }
        },
        methods: {
            submit(type, copies){
                this.isLoading = true;
                
                axios.post('/portal/application/store', {
                    "application_type" : type,
                    "copies" : copies
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
            },
            communicateWithBot(text){
                client.textRequest(text)
                    .then((response) => {
                        if(response.result.action == 'Print'){
                            let type = response.result.parameters.Application;
                            let copies = response.result.parameters.copies;
                            this.submit(type, copies);
                        }
                        this.speaker.speak(response.result.fulfillment.speech);
                    })
                    .catch((error) => {
                        this.speaker.speak("Opps, something wen wrong!");
                    })
            },
            startRecognition(){
                this.recognition = new webkitSpeechRecognition();

                this.recognition.onstart = () => this.isRecording = true;

                this.recognition.onresult = () => {
                    let text = "";
                    for (let i = event.resultIndex; i < event.results.length; ++i) {
                        text += event.results[i][0].transcript;
                    }
                    this.communicateWithBot(text);
                };

                this.recognition.onend = () => this.stopRecognition();

                this.recognition.lang = "en-US";
                this.recognition.start();
            },
            stopRecognition() {
                if (this.recognition) {
                    this.recognition.stop();
                    this.recognition = null;
                    this.isRecording = false;
                }
            },
            toggleRecording() {
                if (this.recognition) {
                    this.stopRecognition();
                } else {
                    this.startRecognition();
                }
            },
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