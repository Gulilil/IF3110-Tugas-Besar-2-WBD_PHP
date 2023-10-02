CREATE TABLE IF NOT EXISTS relationship
(
  relationship_id SERIAL PRIMARY KEY NOT NULL,
  client_id_1 SERIAL NOT NULL,
  client_id_2 SERIAL NOT NULL,
  type VARCHAR(50) NOT NULL CHECK (type IN ('FRIEND', 'PENDING 1_2', 'PENDING 2_1', 'BLOCKED')),
  FOREIGN KEY (client_id_1) REFERENCES client(client_id),
  FOREIGN KEY (client_id_2) REFERENCES client(client_id)
);