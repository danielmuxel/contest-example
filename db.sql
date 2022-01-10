DROP DATABASE IF EXISTS contest;

CREATE DATABSE contest;

CREATE TABLE contest (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    description TEXT,
);

CREATE TABLE participant (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT,
);

CREATE TABLE prices (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    text TEXT,
    contest_id INTEGER,
    FORIEGN KEY (contest_id) REFERENCES contest(id)
);

CREATE TABLE question (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    text TEXT,
    contest_id INTEGER,
    FOREIGN KEY (contest_id) REFERENCES contest(id)
);

CREATE TABLE answer (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    text TEXT,
    question_id INTEGER,
    FOREIGN KEY (question_id) REFERENCES question(id)
);

CREATE TABLE participant_answer (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    participant_id INTEGER,
    answer_id INTEGER,
    FOREIGN KEY (participant_id) REFERENCES participant(id),
    FOREIGN KEY (answer_id) REFERENCES answer(id)
);

CREATE TABLE participant_contest (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    participant_id INTEGER,
    contest_id INTEGER,
    image TEXT,
    FOREIGN KEY (participant_id) REFERENCES participant(id),
    FOREIGN KEY (contest_id) REFERENCES contest(id)
);

CREATE TABLE feedback_questions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    text TEXT,
    min INTEGER,
    max INTEGER,
);

CREATE TABLE participant_feedback (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    participant_id INTEGER,
    feedback_question_id INTEGER,
    value INTEGER,
    FOREIGN KEY (participant_id) REFERENCES participant(id),
    FOREIGN KEY (feedback_question_id) REFERENCES feedback_questions(id)
);