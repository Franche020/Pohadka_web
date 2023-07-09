<?php

namespace Controllers;


class ImagesController {
    
    public function uploadImage()
    {
        $targetDir = 'uploads/'; // Directorio donde se guardarán las imágenes
        $uploadedFile = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($uploadedFile, $targetPath)) {
            $response = [
                'uploaded' => true,
                'url' => $targetPath
            ];
        } else {
            $response = [
                'uploaded' => false,
                'error' => 'Error al cargar la imagen'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}


