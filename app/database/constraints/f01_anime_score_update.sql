CREATE FUNCTION anime_score_update()
RETURNS TRIGGER
AS $$
BEGIN
    UPDATE anime
    SET score =
            (
                SELECT avg(user_score)
                FROM anime AS a
                         JOIN anime_list AS al ON a.anime_id = al.anime_id
                WHERE a.anime_id = NEW.anime_id AND NOT al.user_score IS NULL
                GROUP BY a.anime_id
            )
    WHERE NOT NEW.user_score IS NULL AND anime.anime_id = NEW.anime_id ;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;