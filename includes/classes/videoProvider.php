<?php
class videoProvider {

    public static function getUpNext ($con, $currentVideo) {
        $query = $con->prepare("SELECT * FROM videos
                                WHERE entityId=:entityId AND videoId != :videoId 
                                AND (
                                    ( season = :season AND episode > :episode ) OR season > :season
                                )
                                ORDER BY season, episode ASC LIMIT 1");
        $query->bindData(":entityId", $currentVideo->getEntityId());
        $query->bindData(":videoId", $currentVideo->getId());
        $query->bindData(":season", $currentVideo->getSeasonNumber());
        $query->bindData(":episode", $currentVideo->getEpisodeNumber());

        $query->execute();
        
        if($query->rowCount() == 0){
            $query->prepare("SELECT * FROM videos 
                            WHERE season <=1 AND episode <=1
                            AND videoId != :videoId
                            ORDER BY views LIMIT 1");

            $query->bindData(":episode", $currentVideo->getEpisodeNumber());
            $query->execute();
        }
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return  new Video ($con,$row);
    }

}
?>