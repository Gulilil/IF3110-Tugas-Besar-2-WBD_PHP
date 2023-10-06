CREATE TABLE IF NOT EXISTS relationship
(
  relationship_id SERIAL PRIMARY KEY NOT NULL,
  client_id_1 INTEGER NOT NULL,
  client_id_2 INTEGER NOT NULL,
  type VARCHAR(50) NOT NULL CHECK (type IN ('FRIEND', 'PENDING', 'BLOCKED')),
  FOREIGN KEY (client_id_1) REFERENCES client(client_id) ON DELETE CASCADE,
  FOREIGN KEY (client_id_2) REFERENCES client(client_id) ON DELETE CASCADE
);