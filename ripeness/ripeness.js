const predict = document.getElementById("predict");

predict.addEventListener("click", async ()=>{

    const file =
        document.getElementById("upload").files[0] ||
        document.getElementById("camera").files[0];

    if(!file){
        alert("Pilih gambar dahulu");
        return;
    }

    let formData = new FormData();
    formData.append("image", file);

    const response = await fetch("http://127.0.0.1:5000/upload",{
        method:"POST",
        body:formData
    });

    const data = await response.json();

    document.getElementById("status").innerHTML =
        data.status;

    document.getElementById("confidence").innerHTML =
        data.confidence.toFixed(2)+" %";
});