<?php
/**
 * Project class.
 * @author RR
 */

class Project extends Model {

    /**
     * Database Instance
     * @var PDO object
     * @access private
     */
    private $db;

    /**
     * Allowed mimes types
     * @var mimes array
     * @access private
     */
    private $mimes;

    /**
     * Upload directory
     * @var String
     * @access private
     */
    private $upload_dir;

    /**
     * Constructor function.
     */
    public function __construct() {
        parent::__construct();
        //load database instance
        $this->db = DB::getInstance();

        //set upload directory
        $this->upload_dir = "../uploads/fichiersprojets/";

        //set allowed mimes types for download
        $this->mimes = array("application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

    }

    /**
     * Select all projects from DB
     * @return array
     */
    public function getAllProjects() {
        //build sql query
        $sql ="SELECT * FROM projects ";
        $sql .="ORDER BY projects.project_id ASC";

        //run & retun sql result(array)

        return $this->db->run($sql);
    }

    /**
     * Select project files by folder
     * @param Int $idp values
     * @param String $foldername values
     * @return array
     */
    public function getProjectFilesByFolder($idp,$foldername) {
        $bind = array(
            ":project_id" => $idp,
            ":folder_name" => $foldername
        );
        //SQL
        $sql = "select f.* ";
        $sql .="from files as f ";
        $sql .="inner join projects as p on f.project_id = p.project_id ";
        $sql .="inner join folders as fo on f.folder_id = fo.folder_id ";
        $sql .="where f.project_id = :project_id AND fo.folder_name = :folder_name ";
        $result = $this->db->run($sql,$bind);
        return $result;
    }

    public function test() {
        throw new Exception("This is an exception");
        return true;
    }

    /**
     * Add a project
     * @param array $insert values
     * @return array
     */
    public function insertProject($insert) {

        $uploadedFiles = array();
        $errorFiles = array();

        //add project
        try {
            if($this->db->insert("projects", $insert)) {
                $lastInsertId = $this->db->lastInsertId();
                // loop through the array of files
                if(!empty($_FILES)) {
                    $sdfile = new SDFile();
                    foreach($_FILES as $index => $file) {
                        //filename
                        $fileName = $file['name'];
                        //temp filename
                        $fileTempName = $file['tmp_name'];
                        // check if there is an error for particular entry in array
                        if(!empty($file['error'][$index])) {
                            // some error occurred with the file in index $index
                            // yield an error here
                            $errorFiles[]= $fileName;
                        } else {
                            // check temporary path and if uploaded file
                            if(!empty($fileTempName) && is_uploaded_file($fileTempName)) {
                                if(in_array($file['type'],$this->mimes)) {
                                    try {
                                        // move the file
                                        if(move_uploaded_file($fileTempName, $this->upload_dir . $fileName)) {

                                            $insert = array(
                                                "project_id" => $lastInsertId,
                                                "uploaded_filename" => $fileName,
                                                "stored_filename" => $fileName
                                            );
                                            if($sdfile->insertSDFile($insert)) {
                                                $uploadedFiles[]= $fileName;
                                            } else {
                                                //sleep(2);//for test purpose
                                                //delete uploaded file : no db trace
                                                if(unlink($this->upload_dir . $fileName)) $errorFiles[]= $fileName;
                                            }
                                        } else {
                                            $errorFiles[]= $fileName;
                                        }
                                    } catch (Exception $e) {
                                        $this->logIt($e->getMessage());
                                        $errorFiles[]= $fileName;
                                    }
                                } else {
                                    $errorFiles[]= $fileName;
                                }
                            } else {
                                $errorFiles[]= $fileName;
                            }
                        }
                    }
                    $msg = "<p>Projet enregistré.</p>";
                    $msg .= (empty($errorFiles) ? "<p>Tous les fichiers SD ont été enregistrés.</p>" : "<p>Un ou plusieurs fichiers SD n'ont pas été enregistrés.</p>");
                    return array("done" => true, "msg" => $msg, "id" => $lastInsertId);
                } else {
                    return array("done" => true,"msg" => "<p>projet crée !</p><p>les fichiers contour n'ont pas été sauvegardés.</p>","id" => $lastInsertId);
                }
            } else {
                return array("done" =>false,"msg" =>"Erreur enregistrement projet !");
            }
        } catch (Exception $e) {
            $this->logIt($e->getMessage());
            return array("done" =>false,"msg" =>"Erreur interne !");
        }

    }

    /**
     * Update a project
     * @param array $update values
     * @return array|bool|int
     */

    public function updateProject($update) {
        $bind = array(
            ":project_id" => $update['project_id']
        );
        var_dump($update);
        return $this->db->update("projects", $update['info'], "project_id = :project_id", $bind);
    }


    public function getProjectsbyid($project_id) {
        $bind = array(
            ":project_id" => $project_id
        );
        $result = $this->db->select("projects", "project_id = :project_id", $bind);
        return (!empty($result) ? $result[0] : false);
    }
    /**
     * Delete a project
     * @param array $delete
     * @return array|bool|int
     */
    public function deleteProject($delete) {
        $bind = array(
            ":project_id" => $delete['project_id']
        );
        return $this->db->delete("projects","project_id = :project_id", $bind);
    }

    /**
     * validation functions
     */
    private function isValidData(/*$data,$method*/) {
        return true;
    }
}// END class