<?php
/**
 * Project PDO class.
 * @author RR
 */

class ProjectPDO {

    /**
     * Database Instance
     * @var PDO object
     * @access private
     */
    private static $db;

    /**
     * Table name
     * @var string
     * @access private
     */
    private static $table;

    /**
     * Allowed mimes types
     * @var mimes array
     * @access private
     */
    private static $mimes;

    /**
     * Upload directory
     * @var String
     * @access private
     */
    private static $upload_dir;

    /**
     * Initialize indicator
     * @var bool
     * @access private
     */
    private static $initialized = false;

    /**
     * initialize function.
     */
    public static function initialize() {

        if (self::$initialized)
            return;

        //load database instance
        self::$db = DB::getInstance();
        //set table name
        self::$table = "projects";
        //set upload directory
        self::$upload_dir = "../uploads/fichiersprojets/";

        //set allowed mimes types for download
        self::$mimes = array("application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

    }

    /**
     * get all projects
     * @return array
     */
    public static function getAllProjects() {
        self::initialize();
        //build sql query
        $sql ="SELECT * FROM ".self::$table." ";
        $sql .="ORDER BY projects.project_id ASC";

        $result = self::$db->run($sql);

        if($result) return array("done" => true,"msg" => "projets récupérés", "data" => $result);
        else return array("done" =>false,"msg" =>"probléme récupération projets", "data" => []);
    }

    /**
     * update a project
     * @param array $update
     * @return bool
     */

    public static function updateProject($update) {
        self::initialize();
        $bind = array(
            ":project_id" => $update['project_id']
        );
        //var_dump($update);
        return self::$db->update(self::$table, $update['info'], "project_id = :project_id", $bind);
    }

    /**
     * get a project by id
     * @param array $project_id
     * @return array
     */
    public static function getProjectbyid($project_id) {
        self::initialize();
        $bind = array(
            ":project_id" => $project_id
        );
        return self::$db->select(self::$table, "project_id = :project_id", $bind)[0];
    }

    /**
     * delete a project
     * @param array $delete
     * @return bool
     */
    public static function deleteProject($delete) {
        self::initialize();
        $bind = array(
            ":project_id" => $delete['project_id']
        );
        return self::$db->delete(self::$table,"project_id = :project_id", $bind);
    }

    /**
     * add a project
     * @param array $insert values
     * @return bool
     */
    public static function insertProject($insert) {
        self::initialize();

        $uploadedFiles = array();
        $errorFiles = array();

        //add project
        try {
            if(self::$db->insert(self::$table, $insert)) {
                $lastInsertId = self::$db->lastInsertId();
                // loop through the array of files
                if(!empty($_FILES)) {
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
                                if(in_array($file['type'],self::$mimes)) {
                                    try {
                                        // move the file
                                        if(move_uploaded_file($fileTempName, self::$upload_dir . $fileName)) {

                                            $insert = array(
                                                "project_id" => $lastInsertId,
                                                "uploaded_filename" => $fileName,
                                                "stored_filename" => $fileName
                                            );
                                            if(SDFilePDO::insertSDFile($insert)) {
                                                $uploadedFiles[]= $fileName;
                                            } else {
                                                //sleep(2);//for test purpose
                                                //delete uploaded file : no db trace
                                                if(unlink(self::$upload_dir . $fileName)) $errorFiles[]= $fileName;
                                            }
                                        } else {
                                            $errorFiles[]= $fileName;
                                        }
                                    } catch (Exception $e) {
                                        //self::logIt($e->getMessage());
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
            //self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"Erreur interne !");
        }

    }

}// END class