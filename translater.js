import translate from "translate";

translate.engine = "google";
translate.key = process.env.DEEPL_KEY;

class Translater {
    translateToEng(text) {
        translate(text, 'en').then(r => console.log(r, 1))
    }
}

export {Translater}