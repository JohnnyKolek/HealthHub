
CREATE TABLE user_details
(
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    phone VARCHAR(255)
);

CREATE TABLE users
(
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    id_user_details INT NOT NULL,
    FOREIGN KEY (id_user_details) REFERENCES user_details(id)
);