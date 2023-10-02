CREATE TABLE IF NOT EXISTS anime_list
(
    list_id SERIAL PRIMARY KEY NOT NULL,
    client_id INTEGER NOT NULL,
    anime_id INTEGER NOT NULL,
    user_score INTEGER CHECK (user_score BETWEEN 1 AND 10),
    progress INTEGER,
    watch_status VARCHAR(20) CHECK (watch_status IN ('WATCHING', 'COMPLETED', 'ON-HOLD', 'DROPPED', 'PLAN TO WATCH')),
    review TEXT,
    FOREIGN KEY (client_id) REFERENCES client(client_id),
    FOREIGN KEY (anime_id) REFERENCES anime(anime_id)
);