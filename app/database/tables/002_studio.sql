CREATE TABLE IF NOT EXISTS studio
(
  studio_id SERIAL PRIMARY KEY NOT NULL,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  established_date DATE
);