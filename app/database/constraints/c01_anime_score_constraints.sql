DO $$
    BEGIN
        IF NOT EXISTS (
            SELECT constraint_name
            FROM information_schema.check_constraints
            WHERE constraint_schema = 'public'
            AND constraint_name = 'anime_score_constraint'
        )
        THEN
            ALTER TABLE anime
            ADD CONSTRAINT anime_score_constraint
            CHECK (score BETWEEN 0 and 10);
        END IF;
    END;
$$;


