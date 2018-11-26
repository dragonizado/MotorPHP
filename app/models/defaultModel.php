<?php 
/**
* Dragonizado 2018
*/
class defaultModel
{
	
	function __construct($db)
	{
		try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }

	}

 	public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

	public function addSong($artist, $track, $link)
    {
        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);
        return $query->execute($parameters);
    }

}
 ?>