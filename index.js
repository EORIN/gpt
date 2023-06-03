import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';
import fs from 'fs';
import bodyParser from 'body-parser';
import translate from "translate";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.get('/', (request, response) => {
    response.sendFile(__dirname + '/form.html');
});

app.post('/post', (request, response) => {
    let translated = async () => {
        return await translate(request.body.data, 'en')
    }
    let requestText = request.body.data
    let translate = new Translater();
    translate.translateToEng(requestText)

    Translater.translated().then(r => fs.writeFileSync(`./gpt.txt`, r))
    fs.readFile(`./gpt_f.txt`, 'utf8', (err, data) => {

    let result = async () => {

        return await translate(data, 'ru')
    }
    console.log(result())
    res.send(result())
    })

    fs.writeFileSync(__dirname + '/gpt_text/gpt.txt', request.body.data);
    fs.readFile(__dirname + `/gpt_text/gpt_f.txt`, 'utf8', (err, data) => {
        response.send(data);
    });
});

app.listen('3333', () => {
    console.log('i am working');
});