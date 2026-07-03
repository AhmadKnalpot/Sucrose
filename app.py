from flask import Flask, request, jsonify
from database import get_connection
import os
from werkzeug.utils import secure_filename

app = Flask(__name__)

UPLOAD_FOLDER = "uploads"
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

app.config["UPLOAD_FOLDER"] = UPLOAD_FOLDER


@app.route("/upload", methods=["POST"])
def upload():

    if "image" not in request.files:
        return jsonify({"error":"Tidak ada gambar"})

    file = request.files["image"]

    filename = secure_filename(file.filename)

    filepath = os.path.join(app.config["UPLOAD_FOLDER"], filename)

    file.save(filepath)

    # =====================
    # Prediksi Edge Impulse
    # =====================

    hasil = "Matang"
    confidence = 98.7

    conn = get_connection()
    cursor = conn.cursor()

    cursor.execute("""
    INSERT INTO ripeness_detection
    (image_name,image_path,result,confidence)
    VALUES (%s,%s,%s,%s)
    """,
    (
        filename,
        filepath,
        hasil,
        confidence
    ))

    conn.commit()
    conn.close()

    return jsonify({
        "status":hasil,
        "confidence":confidence,
        "image":filepath
    })


if __name__=="__main__":
    app.run(debug=True)