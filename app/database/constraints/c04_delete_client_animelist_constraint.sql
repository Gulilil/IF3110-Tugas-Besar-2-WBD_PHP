DO $$
    BEGIN
        IF NOT EXISTS (
            SELECT constraint_name
            FROM information_schema.check_constraints
            WHERE constraint_schema = 'public'
            AND constraint_name = 'delete_client_animelist'
        )
        THEN
            ALTER TABLE anime_list
            ADD CONSTRAINT delete_client_animelist
            FOREIGN KEY (client_id)
            REFERENCES client(client_id)
            ON DELETE CASCADE;
        END IF;
    END;
$$;
