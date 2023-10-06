CREATE TRIGGER anime_score_update_trg
    AFTER INSERT ON anime_list
    FOR EACH ROW
EXECUTE FUNCTION anime_score_update();