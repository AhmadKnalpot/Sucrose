const express = require("express");
const multer = require("multer");
const cors = require("cors");
const { exec } = require("child_process");
const path = require("path");

const app = express();

app.use(cors());

const storage = multer.diskStorage({
    destination: "uploads/",
    filename: (req, file, cb)=>{
        cb(null, Date.now()+"_"+file.originalname);
    }
});

const upload = multer({storage});

app.post("/predict", upload.single("image"), (req,res)=>{

    const image = req.file.path;

    const command =
`python edge-impulse/classify.py "${image}"`;

    exec(command,(err,stdout,stderr)=>{

        if(err){
            return res.status(500).json({
                error:stderr
            });
        }

        res.send(stdout);

    });

});

app.listen(3000,()=>{

console.log("Server Running");

});