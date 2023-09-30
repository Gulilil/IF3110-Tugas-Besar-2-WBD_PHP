CREATE TABLE IF NOT EXISTS anime_list
(
    list_id SERIAL PRIMARY KEY NOT NULL,
    client_id SERIAL NOT NULL,
    anime_id SERIAL NOT NULL,
    user_score NUMERIC(2,2),
    progress VARCHAR(20),
    watch_status VARCHAR(20),
    review TEXT,
    FOREIGN KEY (client_id) REFERENCES client(client_id),
    FOREIGN KEY (anime_id) REFERENCES anime(anime_id)
);