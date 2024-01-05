<?php
namespace App\Class;

class UploadImg {

    const EXTENSIONS = ["jpg", "jpeg", "png"];
    const MAX_SIZE = 400000;

    private $name;
    private $type;
    private $tmp_name;
    private $error;
    private $size;
    private $extension;
    private $uniq_name;
    private $path;

    public function __construct(array $file) {
        $this->name = $file["name"];
        $this->type = $file["type"];
        $this->tmp_name = $file["tmp_name"];
        $this->error = $file["error"];
        $this->size = $file["size"];
        $this->extension = strtolower(end(explode('.', $this->name)));
        $this->uniq_name = uniqid('', true) . "." . $this->extension;
        $this->path = null;
    }

    public function getName() { return $this->name; }

    public function getType() { return $this->type; }

    public function getTmpName() { return $this->tmp_name; }

    public function getError() { return $this->error; }

    public function getSize() { return $this->size; }

    public function getExtension() { return $this->extension; }

    public function getUniqName() { return $this->uniq_name; }

    public function upload(string $path): bool {
        if(!$this->verifData()) {
            return false;
        } else {
            if(move_uploaded_file($this->tmp_name, $path . $this->uniq_name)) {
                $this->path = $path;
                return true;
            } else {
                Feedback::setError("Une erreur s'est produite lors de l'upload de l'image.");
                return false;
            }
        }
    }

    private function verifData() {
        if($this->error !== UPLOAD_ERR_OK) {
            Feedback::setError("Une erreur s'est produite lors de l'upload de l'image.");
            return false;
        } elseif($this->size > self::MAX_SIZE) {
            Feedback::setError("Erreur, le fichier est trop volumineux.");
            return false;
        } elseif(!in_array($this->extension, self::EXTENSIONS)) {
            Feedback::setError("Erreur, cette extension n'est pas autorisée.");
            return false;
        } else {
            return true;
        }
        // manage file inclusion
    }

    public function delete() {
        unlink($this->path . $this->uniq_name);
    }

}