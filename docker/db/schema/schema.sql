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
    FOREIGN KEY (user_details_id) REFERENCES user_details (id)
);

CREATE TABLE visits
(
    id        SERIAL PRIMARY KEY,
    doctor    INT,
    patient   INT,
    date_time TIMESTAMP,
    completed BOOLEAN,
    FOREIGN KEY (doctor) REFERENCES users (id),
    FOREIGN KEY (patient) REFERENCES users (id)
);

CREATE TABLE roles
(
    id   INT PRIMARY KEY,
    name VARCHAR(255)
);


CREATE TABLE user_roles
(
    user_id INT,
    role_id INT,
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (role_id) REFERENCES roles (id)
);

INSERT INTO roles (id, name)
VALUES (1, 'doctor'),
       (2, 'patient'),
       (3, 'admin')
ON CONFLICT (id) DO NOTHING;

