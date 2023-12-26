CREATE TABLE user_details
(
    id      SERIAL PRIMARY KEY,
    name    VARCHAR(255),
    surname VARCHAR(255),
    phone   VARCHAR(20)
);



CREATE TABLE users
(
    id              SERIAL PRIMARY KEY,
    user_details_id INT,
    email           VARCHAR(255),
    password        VARCHAR(255),
    enabled         BOOLEAN,
    created_at      TIMESTAMP,
    FOREIGN KEY (user_details_id) REFERENCES user_details (id)
);
