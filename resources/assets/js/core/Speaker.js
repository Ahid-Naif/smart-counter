
class Speaker {
    speak(text){
        let msg = new SpeechSynthesisUtterance();
        msg.text = text;

        speechSynthesis.speak(msg);
    }
}

export default Speaker