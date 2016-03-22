CREATE DATABASE IF NOT EXISTS school_lessons;

USE school_lessons;

CREATE TABLE IF NOT EXISTS course_name (
  id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Course id',
  course_name VARCHAR(25) NOT NULL COMMENT 'Course name',
  CONSTRAINT pkId PRIMARY KEY (id)
)
  ENGINE=INNODB
  COLLATE='utf8_general_ci';

CREATE TABLE IF NOT EXISTS count_course (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Course number id',
  course_year CHAR(4) NOT NULL COMMENT 'Year',
  course_name_id SMALLINT UNSIGNED NOT NULL COMMENT 'Course id',
  course_month TINYINT NOT NULL COMMENT 'Mounth',
  count_courses SMALLINT UNSIGNED NOT NULL COMMENT 'The number of courses',
  CONSTRAINT pkId PRIMARY KEY (id),
  INDEX ixCourseNameId (course_name_id),
  CONSTRAINT fxCourseName FOREIGN KEY (course_name_id) REFERENCES course_name(id)
    ON DELETE CASCADE
)
  ENGINE=INNODB
  COLLATE='utf8_general_ci';

CREATE TABLE IF NOT EXISTS graph_types (
  id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Graph type id',
  nameGraphType VARCHAR(25) NOT NULL COMMENT 'Graph type name',
  CONSTRAINT pkId PRIMARY KEY (id)
)
  ENGINE=INNODB
  COLLATE='utf8_general_ci';

CREATE TABLE IF NOT EXISTS user_privilege (
  idPrivilege TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User privilegies id',
  namePrivilege VARCHAR(25) NOT NULL COMMENT 'User privilegies name',
  CONSTRAINT pkIdPrivilege PRIMARY KEY (idPrivilege)
)
  ENGINE=INNODB
  COLLATE='utf8_general_ci';

CREATE TABLE IF NOT EXISTS user_role (
  idRole TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User role id',
  nameRole VARCHAR(25) NOT NULL COMMENT 'User role name',
  idPrivilege TINYINT UNSIGNED NOT NULL COMMENT 'User privilegies id',
  CONSTRAINT pkIdRole PRIMARY KEY (idRole),
  INDEX ixIdPrivilege (idPrivilege),
  CONSTRAINT fxUserPrivilege FOREIGN KEY (idPrivilege) REFERENCES user_privilege(idPrivilege)
    ON DELETE CASCADE
)
  ENGINE=INNODB
  COLLATE='utf8_general_ci';

CREATE TABLE IF NOT EXISTS user_users (
  id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User id',
  login VARCHAR(32) NOT NULL COMMENT 'User login',
  password VARCHAR(100) NOT NULL COMMENT 'User password',
  salt VARCHAR(100) NOT NULL COMMENT 'Salt for password',
  iterationCount TINYINT UNSIGNED NOT NULL COMMENT 'The number of iteration for password hash',
  role TINYINT UNSIGNED NOT NULL COMMENT 'User role id',
  graph_type TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Graph type id',
  CONSTRAINT pkIdRole PRIMARY KEY (id),
  INDEX ixRole (role),
  CONSTRAINT fxUserRole FOREIGN KEY (role) REFERENCES user_role(idRole)
    ON DELETE CASCADE
)
  ENGINE=INNODB
  COLLATE='utf8_general_ci';

-- ---------------------------------------------------------

-- Insert values for users

INSERT INTO user_privilege (idPrivilege, namePrivilege) VALUES
  (1, 'Full access'),
  (2, 'Only search');

INSERT INTO user_role (idRole, nameRole, idPrivilege) VALUES
  (1, 'Admin', 1),
  (2, 'Manager', 2);

INSERT INTO user_users (id, login, password, salt, iterationCount, role, graph_type) VALUES
  (1, 'admin', '21ee475d1b635f080e94d27b1f7f8a05d1c67261539e2c456cc816dc9b3d33eb', '1531016381561272fc644561.88846557', 84, 1, 1),
  (2, 'alex', '21ee475d1b635f080e94d27b1f7f8a05d1c67261539e2c456cc816dc9b3d33eb', '1531016381561272fc644561.88846557', 84, 2, 2);

-- Insert course names

INSERT INTO course_name (id, course_name) VALUES
  (1, 'VN'),
  (2, 'PT'),
  (3, 'MA'),
  (4, 'MRI'),
  (5, 'PHL');

INSERT INTO graph_types (id, nameGraphType) VALUES
  (1, 'Lines'),
  (2, 'Circle');