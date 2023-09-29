CREATE TABLE IF NOT EXISTS anime_genre
(
  anime_genre_id SERIAL PRIMARY KEY NOT NULL,
  anime_id SERIAL NOT NULL,
  genre_id SERIAL NOT NULL,
  FOREIGN KEY (anime_id) REFERENCES anime(anime_id),
  FOREIGN KEY (genre_id) REFERENCES genre(genre_id)
);