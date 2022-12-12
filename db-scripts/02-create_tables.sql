USE tv_series;

CREATE TABLE tv_series
(
    id      varchar(37) UNIQUE,
    title   varchar(64) UNIQUE,
    channel varchar(16),
    PRIMARY KEY(id)
) ENGINE=INNODB;

CREATE TABLE tv_series_intervals
(
    id_tv_series varchar(37) UNIQUE,
    week_day     int,
    show_time    varchar(5),
    PRIMARY KEY (id_tv_series),
    FOREIGN KEY (id_tv_series) REFERENCES tv_series(id)
) ENGINE=INNODB;

DELIMITER &&
CREATE FUNCTION nextDatetime (week_day INTEGER, time TIME, date_time DATETIME)
    RETURNS DATETIME DETERMINISTIC
BEGIN
    DECLARE this_week DATETIME;
    SET this_week = CONCAT(DATE_SUB(DATE(date_time), INTERVAL WEEKDAY(date_time) - week_day DAY),' ', time);
    IF date_time <= this_week THEN
        RETURN this_week;
ELSE
        RETURN CONCAT(DATE_ADD(DATE(date_time), INTERVAL 7 - WEEKDAY(date_time) + week_day DAY),' ', time);
END IF;
END&&
