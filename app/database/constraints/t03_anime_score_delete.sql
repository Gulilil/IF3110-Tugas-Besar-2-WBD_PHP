CREATE TRIGGER anime_score_delete_trg
    AFTER DELETE ON anime_list
    FOR EACH ROW
EXECUTE FUNCTION anime_score_update();