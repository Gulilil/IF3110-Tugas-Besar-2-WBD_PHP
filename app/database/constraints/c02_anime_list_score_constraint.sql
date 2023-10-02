DO $$
    BEGIN
        IF NOT EXISTS (
            SELECT constraint_name
            FROM information_schema.check_constraints
            WHERE constraint_schema = 'public'
            AND constraint_name = 'anime_list_score_constraint'
        )
        THEN
            ALTER TABLE anime_list
            ADD CONSTRAINT anime_list_score_constraint
            CHECK (user_score BETWEEN 1 and 10);
        END IF;
    END;
$$;
