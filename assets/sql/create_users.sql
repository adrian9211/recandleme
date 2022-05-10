CREATE TABLE IF NOT EXISTS users (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    admin TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    active TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    user_name VARCHAR(20) NOT NULL,
    first_name VARCHAR(20),
    last_name VARCHAR(40),
    email VARCHAR(60) NOT NULL,
    pass VARCHAR(256) NOT NULL,
    phone VARCHAR(20),
    reg_date DATETIME NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE (email)
);