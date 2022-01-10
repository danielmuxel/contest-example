DROP DATABASE IF EXISTS contest;

CREATE DATABASE contest;

USE contest;

CREATE TABLE contest (
    id INTEGER PRIMARY KEY auto_increment,
    name TEXT,
    description TEXT,
    has_image BOOLEAN,
);

CREATE TABLE participant (
    id INTEGER PRIMARY KEY auto_increment,
    name TEXT,
    email TEXT
);

CREATE TABLE price (
    id INTEGER PRIMARY KEY auto_increment,
    text TEXT,
    amount INTEGER
);

CREATE TABLE question (
    id INTEGER PRIMARY KEY auto_increment,
    text TEXT,
    contest_id INTEGER,
    FOREIGN KEY (contest_id) REFERENCES contest(id)
);

CREATE TABLE answer (
    id INTEGER PRIMARY KEY auto_increment,
    text TEXT,
    question_id INTEGER,
    correct BOOLEAN,
    FOREIGN KEY (question_id) REFERENCES question(id)
);

CREATE TABLE participant_answer (
    id INTEGER PRIMARY KEY auto_increment,
    participant_id INTEGER,
    answer_id INTEGER,
    FOREIGN KEY (participant_id) REFERENCES participant(id),
    FOREIGN KEY (answer_id) REFERENCES answer(id)
);

CREATE TABLE participant_contest (
    id INTEGER PRIMARY KEY auto_increment,
    participant_id INTEGER,
    contest_id INTEGER,
    image TEXT,
    FOREIGN KEY (participant_id) REFERENCES participant(id),
    FOREIGN KEY (contest_id) REFERENCES contest(id)
);

CREATE TABLE feedback_question (
    id INTEGER PRIMARY KEY auto_increment,
    text TEXT,
    min INTEGER,
    max INTEGER
);

CREATE TABLE participant_feedback (
    id INTEGER PRIMARY KEY auto_increment,
    participant_id INTEGER,
    feedback_question_id INTEGER,
    value INTEGER,
    FOREIGN KEY (participant_id) REFERENCES participant(id),
    FOREIGN KEY (feedback_question_id) REFERENCES feedback_question(id)
);

INSERT INTO contest (name, description, has_image) VALUES ('Contest 1', 'Description 1', false);
INSERT INTO contest (name, description, has_image) VALUES ('Contest 2', 'Description 2', true);

INSERT INTO price (text, amount) VALUES ('Price 1', 1);
INSERT INTO price (text, amount) VALUES ('Price 2', 2);
INSERT INTO price (text, amount) VALUES ('Price 3', 10);
INSERT INTO price (text, amount) VALUES ('Price 4', 20);

INSERT INTO question (text, contest_id) VALUES ('Question 1-1', 1);

INSERT INTO answer (text, question_id, correct) VALUES ('Answer 1-1-1', 1, false);
INSERT INTO answer (text, question_id, correct) VALUES ('Answer 1-1-2', 1, false);
INSERT INTO answer (text, question_id, correct) VALUES ('Answer 1-1-3', 1, true);
INSERT INTO answer (text, question_id, correct) VALUES ('Answer 1-1-4', 1, false);

INSERT INTO question (text, contest_id) VALUES ('Question 1-2', 2);

INSERT INTO answer (text, question_id, correct) VALUES ('Answer 1-2-1', 2, false);
INSERT INTO answer (text, question_id, correct) VALUES ('Answer 1-2-2', 2, false);
INSERT INTO answer (text, question_id, correct) VALUES ('Answer 1-2-3', 2, true);
INSERT INTO answer (text, question_id, correct) VALUES ('Answer 1-2-4', 2, false);

INSERT INTO feedback_question (text, min, max) VALUES ('Feedback 1', 1, 10);
INSERT INTO feedback_question (text, min, max) VALUES ('Feedback 2', 1, 10);
INSERT INTO feedback_question (text, min, max) VALUES ('Feedback 3', 1, 10);
INSERT INTO feedback_question (text, min, max) VALUES ('Feedback 4', 1, 10);
INSERT INTO feedback_question (text, min, max) VALUES ('Feedback 5', 1, 10);
