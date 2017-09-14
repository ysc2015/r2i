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

				$stm = $db->prepare("DELETE FROM flag_csv WHERE id_ressource=:id_ressource");
				$stm->bindParam(':id_ressource',$id);
				$stm->execute();

                /*$stm_decoche = $db->prepare("update sous_projet_distribution_recette set fichier_flag = :fichier_flag where id_sous_projet = :id_sous_projet");
                $stm_decoche->bindParam(":id_sous_projet", $idsp);
                $stm_decoche->bindValue(":fichier_flag", 0);
                $stm_decoche->execute();*/

        }

		echo "DELETED";

		exit(0);
	}

}

echo "NO FILE";

?>