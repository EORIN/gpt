import express from 'express'
import fs from 'fs'
// import translate from "translate";
import bodyParser from "body-parser";


const app = express()
// app.use(express.static(__dirname + "/"));


app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended: true}))

app.get('/', (req, res) => {

    res.sendFile('C:\\Users\\ur_mom\\PhpstormProjects\\gpt\\form.html')
})
app.post('/post', (req, res) => {
    // let translated = async () => {
    //     return await translate(req.body.data, 'en')
    // }
    // let reqText = req.body.data
    // let translate = new Translater();
    // translate.translateToEng(reqText)


    // Translater.translated().then(r => fs.writeFileSync(`./gpt.txt`, r))
    // fs.readFile(`./gpt_f.txt`, 'utf8', (err, data) => {

    // let result = async () => {
    //
    //     return await translate(data, 'ru')
    // }
    // console.log(result())
    // res.send(result())
    // })
    fs.writeFileSync('C:\\Users\\ur_mom\\PhpstormProjects\\gpt\\gpt.txt', req.body.data)
    fs.readFile(`C:\\Users\\ur_mom\\PhpstormProjects\\gpt\\gpt_f.txt`, 'utf8', (err, data) => {

        res.send(data)


    })})


    app.listen('3333', () => {
        console.log('i am working')
    })