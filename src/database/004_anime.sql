CREATE TABLE IF NOT EXISTS anime
(
    anime_id SERIAL PRIMARY KEY NOT NULL,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL,
    episodes INTEGER NOT NULL,
    rating VARCHAR(50) NOT NULL,
    score NUMERIC(2,2) NOT NULL DEFAULT 0,
    image VARCHAR(255),
    trailer VARCHAR(255),
    studio_id SERIAL NOT NULL,
    FOREIGN KEY (studio_id) REFERENCES studio(studio_id)
);