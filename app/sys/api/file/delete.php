<?php

extract($_POST);

if(isset($id)) {
	$stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
	$stm->bindParam(':id',$id);
	$stm->execute();
	$row = $stm->fetch(PDO::FETCH_OBJ);

	if($row) {
		$fileName = $row->nom_fichier;
		$filePath = __DIR__."/../uploads/". $row->dossier . "/" .$row->nom_fichier_disque;

		if (file_exists($filePath))
		{
			unlink($filePath);
		}

		$stm->closeCursor();

		$stm = $db->prepare("DELETE FROM ressource WHERE id_ressource=:id");
		$stm->bindParam(':id',$id);
		if($stm->execute()) {
			if(isset($delete_ch)) {
				$stm = $db->prepare("DELETE FROM chambre WHERE id_ressource=:id_ressource");
				$stm->bindParam(':id_ressource',$id);
				$stm->execute();
			}
		}

		echo "DELETED";

		exit(0);
	}

}

echo "NO FILE";

?>