CREATE TABLE IF NOT EXISTS anime
(
    anime_id SERIAL PRIMARY KEY NOT NULL,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL CHECK (type IN ('TV', 'MOVIE', 'OVA')),
    status VARCHAR(50) NOT NULL CHECK (status IN ('ON-GOING', 'COMPLETE', 'HIATUS', 'UPCOMING')),
    release_date DATE,
    episodes INTEGER,
    rating VARCHAR(50) NOT NULL CHECK (rating IN ('G', 'PG-13', 'R(17+)', 'Rx')),
    score NUMERIC(2,2) CHECK (score BETWEEN 1 AND 10),
    image VARCHAR(255),
    trailer VARCHAR(255),
    studio_id INTEGER NOT NULL,
    FOREIGN KEY (studio_id) REFERENCES studio(studio_id)
);