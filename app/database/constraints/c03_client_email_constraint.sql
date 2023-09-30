DO $$
    BEGIN
        IF NOT EXISTS (
            SELECT constraint_name
            FROM information_schema.check_constraints
            WHERE constraint_schema = 'public'
              AND constraint_name = 'client_email_constraint'
        )
        THEN
            ALTER TABLE client
            ADD CONSTRAINT client_email_constraint
            CHECK (email LIKE '%@%.%');
        END IF;
    END;
$$;
